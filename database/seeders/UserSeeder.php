<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan role 'superAdmin' sudah ada atau buat jika belum ada
        $role = Role::firstOrCreate(['name' => 'superAdmin']);

        // Buat user pertama dengan role superAdmin
        $user1 = User::create([
            'name' => 'Super Admin 1',
            'username' => 'superadmin1',
            'email' => 'superadmin1@gmail.com', // Menggunakan domain @gmail.com
            'password' => bcrypt('password1'), // Password terenkripsi
        ]);

        // Tetapkan role superAdmin ke user pertama
        $user1->assignRole($role);

        // Buat user kedua dengan role superAdmin
        $user2 = User::create([
            'name' => 'Super Admin 2',
            'username' => 'superadmin2',
            'email' => 'superadmin2@gmail.com', // Menggunakan domain @gmail.com
            'password' => bcrypt('password2'), // Password terenkripsi
        ]);

        // Tetapkan role superAdmin ke user kedua
        $user2->assignRole($role);
    }
}
