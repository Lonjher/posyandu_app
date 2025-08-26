<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = ['kader', 'user', 'pemdes'];

        foreach ($roles as $role) {
            DB::table('users')->insert([
                'name' => ucfirst($role),
                'email' => $role . '@gmail.com',
                'avatar' => null,
                'nik' => null,
                'jenis_kelamin' => null,
                'alamat' => null,
                'tanggal_lahir' => null,
                'password' => Hash::make('password'), // password default
                'role' => $role,
                'no_hp' => '6285156752475',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
