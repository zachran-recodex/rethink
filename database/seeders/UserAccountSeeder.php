<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin User
        $superAdmin = User::create([
            'first_name' => 'Zachran',
            'last_name' => 'Razendra',
            'username' => 'zachranraze',
            'email' => 'zachranraze@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $superAdmin->assignRole('Super Admin');

        // Admin User
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $admin->assignRole('Admin');

        // Regular User
        $regularUser = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'john@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('user123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $regularUser->assignRole('User');

        // Guest User
        $guest = User::create([
            'first_name' => 'Guest',
            'last_name' => 'Visitor',
            'username' => 'guest',
            'email' => 'guest@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('guest123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $guest->assignRole('Guest');

        // Additional users for testing
        $manager = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Smith',
            'username' => 'janesmith',
            'email' => 'jane@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('manager123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $manager->assignRole('Admin');

        $developer = User::create([
            'first_name' => 'Mike',
            'last_name' => 'Wilson',
            'username' => 'mikewilson',
            'email' => 'mike@recodex.id',
            'email_verified_at' => now(),
            'password' => Hash::make('dev123'),
            'phone' => null,
            'address' => null,
            'avatar' => null,
            'birth_date' => null,
            'gender' => null,
            'is_active' => true,
        ]);
        $developer->assignRole('User');
    }
}
