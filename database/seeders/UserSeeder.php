<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private const DEFAULT_EMAIL = 'me@biduwe.com';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exists = DB::table('users')->where('email', self::DEFAULT_EMAIL)->exists();

        if (empty($exists)) {
            DB::table('users')->insert([
                'name' => 'Benjamin Iduwe',
                'email' => self::DEFAULT_EMAIL,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
