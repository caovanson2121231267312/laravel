<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Enums\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user1 = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        $user2 = User::create([
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123123123'),
        ]);

        $arr_roles = [
            ["name" => "Admin"],
            ["name" => "Accountant"],
            ["name" => "IT"],
        ];

        $arr_permissions = [
            [
                "name" => "dashboard.statistical",
                "title" => "Thống kê",
                "group_name" => PermissionGroup::ADMIN_PAGE,
            ],
            [
                "name" => "dashboard.chart",
                "title" => "Biểu đồ",
                "group_name" => PermissionGroup::ADMIN_PAGE,
            ],
            [
                "name" => "dashboard.login",
                "title" => "Đăng nhập trang quản trị",
                "group_name" => PermissionGroup::ADMIN_PAGE,
            ],
            [
                "name" => "users.index",
                "title" => "Xem tài khoản",
                "group_name" => PermissionGroup::USER_MANAGEMENT,
            ],
            [
                "name" => "users.create",
                "title" => "Thêm tài khoản",
                "group_name" => PermissionGroup::USER_MANAGEMENT,
            ],
            [
                "name" => "users.update",
                "title" => "Sửa tài khoản",
                "group_name" => PermissionGroup::USER_MANAGEMENT,
            ],
            [
                "name" => "users.delete",
                "title" => "Xóa tài khoản",
                "group_name" => PermissionGroup::USER_MANAGEMENT,
            ],
            [
                "name" => "users.lock",
                "title" => "Khóa tài khoản",
                "group_name" => PermissionGroup::USER_MANAGEMENT,
            ],

            [
                "name" => "report.users",
                "title" => "Báo cáo người dùng",
                "group_name" => PermissionGroup::REPORT,
            ],
        ];

        foreach ($arr_permissions as $value) {
            $permission = Permission::create($value);
        }

        foreach ($arr_roles as $value) {
            $role = Role::create($value);
        }

        $user1->assignRole(['Admin']);
        $user1->givePermissionTo(['dashboard.login', 'users.index']);
    }
}
