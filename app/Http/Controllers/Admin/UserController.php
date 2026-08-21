<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class UserController extends Controller
{
    private const ROLE_LABELS = [
        'super_admin' => 'Super Admin',
        'admin' => 'Administrator',
        'publikasi' => 'Petugas Publikasi',
        'pustakawan' => 'Pustakawan',
        'kegiatan' => 'Petugas Kegiatan',
        'layanan' => 'Petugas Layanan Informasi',
    ];

    private const OPERATIONAL_ROLES = [
        'publikasi',
        'pustakawan',
        'kegiatan',
        'layanan',
    ];

    private const SUPER_ADMIN_MANAGED_ROLES = [
        'admin',
        'publikasi',
        'pustakawan',
        'kegiatan',
        'layanan',
    ];

    public function index(Request $request): View
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);

        $isSuperAdmin = $currentUser->hasRole('super_admin');
        $allowedRoles = $this->allowedRolesFor($currentUser);
        $roles = $this->roleOptions($allowedRoles);

        $blockedRoles = $isSuperAdmin
            ? ['super_admin']
            : ['super_admin', 'admin'];

        $query = User::query()
            ->with('roles')
            ->where('id', '!=', $currentUser->getKey())
            ->whereHas('roles', function (Builder $query) use ($allowedRoles): void {
                $query->whereIn('name', $allowedRoles);
            })
            ->whereDoesntHave('roles', function (Builder $query) use ($blockedRoles): void {
                $query->whereIn('name', $blockedRoles);
            });

        if ($request->filled('q')) {
            $search = trim((string) $request->query('q'));

            $query->where(function (Builder $query) use ($search): void {
                $query
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $role = (string) $request->query('role');

        if (array_key_exists($role, $roles)) {
            $query->whereHas('roles', function (Builder $query) use ($role): void {
                $query->where('name', $role);
            });
        }

        $status = (string) $request->query('status');

        if ($status === 'active') {
            $query->where('is_active', true);
        }

        if ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $users = $query
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'roles', 'isSuperAdmin'));
    }

    public function create(Request $request): View
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);

        $isSuperAdmin = $currentUser->hasRole('super_admin');
        $roles = $this->roleOptions($this->allowedRolesFor($currentUser));

        return view('admin.users.create', compact('roles', 'isSuperAdmin'));
    }

    public function store(Request $request): RedirectResponse
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);

        $allowedRoles = $this->allowedRolesFor($currentUser);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'role' => ['required', 'string', Rule::in($allowedRoles)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $request, $currentUser): void {
            $user = User::query()->create([
                'name' => trim($validated['name']),
                'email' => strtolower(trim($validated['email'])),
                'password' => $validated['password'],
                'is_active' => $request->boolean('is_active'),
            ]);

            $user->syncRoles([$validated['role']]);

            ActivityLogger::record(
                $currentUser,
                'user.created',
                "Membuat akun {$user->name} sebagai {$this->roleLabel($validated['role'])}.",
                $user,
                $user->name,
                [
                    'role' => $validated['role'],
                    'is_active' => $user->is_active,
                ]
            );
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function edit(Request $request, User $user): View
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);
        $this->authorizeManagedUser($currentUser, $user);

        $roles = $this->roleOptions($this->allowedRolesFor($currentUser));

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);
        $this->authorizeManagedUser($currentUser, $user);

        $allowedRoles = $this->allowedRolesFor($currentUser);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->getKey()),
            ],
            'role' => ['required', 'string', Rule::in($allowedRoles)],
            'is_active' => ['required', 'boolean'],
        ]);

        $user->loadMissing('roles');

        $before = [
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->roles->first()?->name,
            'is_active' => $user->is_active,
        ];

        $isActive = $request->boolean('is_active');
        $newName = trim($validated['name']);
        $newEmail = strtolower(trim($validated['email']));
        $newRole = $validated['role'];

        DB::transaction(function () use (
            $currentUser,
            $user,
            $before,
            $newName,
            $newEmail,
            $newRole,
            $isActive
        ): void {
            $user->forceFill([
                'name' => $newName,
                'email' => $newEmail,
                'is_active' => $isActive,
                ...(! $isActive ? ['remember_token' => null] : []),
            ])->save();

            $user->syncRoles([$newRole]);

            if (! $isActive) {
                DB::table('sessions')
                    ->where('user_id', $user->getKey())
                    ->delete();
            }

            if ($before['name'] !== $newName || $before['email'] !== $newEmail) {
                ActivityLogger::record(
                    $currentUser,
                    'user.updated',
                    "Memperbarui data akun {$newName}.",
                    $user,
                    $newName,
                    [
                        'before' => [
                            'name' => $before['name'],
                            'email' => $before['email'],
                        ],
                        'after' => [
                            'name' => $newName,
                            'email' => $newEmail,
                        ],
                    ]
                );
            }

            if ($before['role'] !== $newRole) {
                ActivityLogger::record(
                    $currentUser,
                    'user.role_changed',
                    "Mengubah role {$newName} dari {$this->roleLabel($before['role'])} menjadi {$this->roleLabel($newRole)}.",
                    $user,
                    $newName,
                    [
                        'before' => $before['role'],
                        'after' => $newRole,
                    ]
                );
            }

            if ((bool) $before['is_active'] !== $isActive) {
                ActivityLogger::record(
                    $currentUser,
                    'user.status_changed',
                    $isActive
                        ? "Mengaktifkan akun {$newName}."
                        : "Menonaktifkan akun {$newName}.",
                    $user,
                    $newName,
                    [
                        'before' => (bool) $before['is_active'],
                        'after' => $isActive,
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun berhasil diperbarui.');
    }

    public function updatePassword(Request $request, User $user): RedirectResponse
    {
        $currentUser = $request->user();

        $this->authorizeManager($currentUser);
        $this->authorizeManagedUser($currentUser, $user);

        $validated = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        DB::transaction(function () use ($validated, $user, $currentUser): void {
            $user->forceFill([
                'password' => $validated['password'],
                'remember_token' => null,
            ])->save();

            DB::table('sessions')
                ->where('user_id', $user->getKey())
                ->delete();

            ActivityLogger::record(
                $currentUser,
                'user.password_reset',
                "Mereset password akun {$user->name}.",
                $user,
                $user->name
            );
        });

        return redirect()
            ->route('admin.users.edit', $user)
            ->with('success', 'Password akun berhasil direset.');
    }

    private function authorizeManager(User $currentUser): void
    {
        abort_unless(
            $currentUser->hasRole('super_admin') || $currentUser->hasRole('admin'),
            403
        );
    }

    private function authorizeManagedUser(User $currentUser, User $targetUser): void
    {
        abort_if($currentUser->is($targetUser), 403);

        if ($currentUser->hasRole('super_admin')) {
            abort_unless(
                $targetUser->hasAnyRole(self::SUPER_ADMIN_MANAGED_ROLES)
                && ! $targetUser->hasRole('super_admin'),
                403
            );

            return;
        }

        abort_unless(
            $currentUser->hasRole('admin')
            && $targetUser->hasAnyRole(self::OPERATIONAL_ROLES)
            && ! $targetUser->hasAnyRole(['super_admin', 'admin']),
            403
        );
    }

    private function allowedRolesFor(User $currentUser): array
    {
        return $currentUser->hasRole('super_admin')
            ? self::SUPER_ADMIN_MANAGED_ROLES
            : self::OPERATIONAL_ROLES;
    }

    private function roleOptions(array $allowedRoles): array
    {
        return array_intersect_key(
            self::ROLE_LABELS,
            array_flip($allowedRoles)
        );
    }

    private function roleLabel(?string $role): string
    {
        return self::ROLE_LABELS[$role] ?? $role ?? 'Tanpa Role';
    }
}