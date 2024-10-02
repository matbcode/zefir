<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		DB::table('users')->insert([
			'name' => 'admin',
			'email' => 'test@zefir.io',
			'email_verified_at' => false,
			'password' => Hash::make(']J[{gp*cn+NW0YR'),
			'language_id' => '1'
		]);
    }
}
