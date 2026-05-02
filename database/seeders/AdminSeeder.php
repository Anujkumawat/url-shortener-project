<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Company;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $company = Company::firstOrCreate([
            'name' => 'Main Company'
        ]);

        $user = User::firstOrCreate(
            ['email' => 'superadmin@example.com'], // check condition
            [
                'name' => 'Super Admin',
                'password' => bcrypt('12345678'),
                'company_id' => $company->id
            ]
        );

        // Role assign only if not already assigned
        if (!$user->hasRole('superadmin')) {
            $user->assignRole('superadmin');
        }
    }
}
