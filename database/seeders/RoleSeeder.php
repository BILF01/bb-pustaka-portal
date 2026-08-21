<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.view',
            'news.manage',
            'collections.manage',
            'agendas.manage',
            'hero-slides.manage',
            'feedback.view',
            'contact-messages.manage',
            'users.manage',
            'admins.manage',
            'activity-log.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $superAdmin = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => 'web',
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $publikasi = Role::firstOrCreate([
            'name' => 'publikasi',
            'guard_name' => 'web',
        ]);

        $pustakawan = Role::firstOrCreate([
            'name' => 'pustakawan',
            'guard_name' => 'web',
        ]);

        $kegiatan = Role::firstOrCreate([
            'name' => 'kegiatan',
            'guard_name' => 'web',
        ]);

        $layanan = Role::firstOrCreate([
            'name' => 'layanan',
            'guard_name' => 'web',
        ]);

        $superAdmin->syncPermissions($permissions);

        $admin->syncPermissions([
            'dashboard.view',
            'news.manage',
            'collections.manage',
            'agendas.manage',
            'hero-slides.manage',
            'feedback.view',
            'contact-messages.manage',
            'users.manage',
        ]);

        $publikasi->syncPermissions([
            'dashboard.view',
            'news.manage',
            'hero-slides.manage',
        ]);

        $pustakawan->syncPermissions([
            'dashboard.view',
            'collections.manage',
        ]);

        $kegiatan->syncPermissions([
            'dashboard.view',
            'agendas.manage',
        ]);

        $layanan->syncPermissions([
            'dashboard.view',
            'feedback.view',
            'contact-messages.manage',
        ]);

        $superAdminUser = User::query()->firstOrCreate(
            ['email' => 'superadmin@bbpustaka.go.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $superAdminUser->syncRoles([$superAdmin]);

        $adminUser = User::query()->firstOrCreate(
            ['email' => 'admin@bbpustaka.go.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_active' => true,
            ]
        );

        $adminUser->syncRoles([$admin]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}