<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'dealership_id' => null,
            'admin' => 1,
            'password' => Hash::make('jc2391991sn'),
            'email' => 'test@example.com',
        ]);
    }
}
