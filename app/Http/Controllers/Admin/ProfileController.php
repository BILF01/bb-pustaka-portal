<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogger;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    private const ROLE_LABELS = [
        'super_admin' => 'Super Admin',
        'admin' => 'Administrator',
        'publikasi' => 'Petugas Publikasi',
        'pustakawan' => 'Pustakawan',
        'kegiatan' => 'Petugas Kegiatan',
        'layanan' => 'Petugas Layanan Informasi',
    ];

    public function edit(Request $request): View
    {
        $user = $request->user()->loadMissing('roles');
        $roleName = $user->roles->first()?->name;
        $roleLabel = self::ROLE_LABELS[$roleName] ?? $roleName ?? 'Tanpa Role';

        return view('admin.profile.edit', compact('user', 'roleLabel'));
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->getKey()),
            ],
        ]);

        $before = [
            'name' => $user->name,
            'email' => $user->email,
        ];

        $newName = trim($validated['name']);
        $newEmail = strtolower(trim($validated['email']));

        DB::transaction(function () use ($user, $before, $newName, $newEmail): void {
            $user->update([
                'name' => $newName,
                'email' => $newEmail,
            ]);

            if ($before['name'] !== $newName || $before['email'] !== $newEmail) {
                ActivityLogger::record(
                    $user,
                    'profile.updated',
                    'Memperbarui profil sendiri.',
                    $user,
                    $newName,
                    [
                        'before' => $before,
                        'after' => [
                            'name' => $newName,
                            'email' => $newEmail,
                        ],
                    ]
                );
            }
        });

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'different:current_password',
            ],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.different' => 'Password baru harus berbeda dari password saat ini.',
        ]);

        DB::transaction(function () use ($validated, $request, $user): void {
            $user->forceFill([
                'password' => $validated['password'],
                'remember_token' => null,
            ])->save();

            if (config('session.driver') === 'database') {
                DB::table((string) config('session.table', 'sessions'))
                    ->where('user_id', $user->getKey())
                    ->where('id', '!=', $request->session()->getId())
                    ->delete();
            }

            ActivityLogger::record(
                $user,
                'profile.password_changed',
                'Mengubah password akun sendiri.',
                $user,
                $user->name
            );
        });

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Password berhasil diperbarui.');
    }
}