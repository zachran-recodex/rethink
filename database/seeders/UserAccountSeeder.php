<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
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

        // Assign Super Admin role
        $user->assignRole('Super Admin');
    }
}
