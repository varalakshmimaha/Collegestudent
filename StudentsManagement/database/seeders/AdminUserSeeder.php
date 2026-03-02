<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create Super Admin role
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        if (!$superAdminRole) {
            $superAdminRole = Role::create(['name' => 'Super Admin']);
        }

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('123'),
                'mobile' => '9999999999',
                'role_id' => $superAdminRole->id,
            ]
        );
    }
}
