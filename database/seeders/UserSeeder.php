<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'Admin',
            'email'             => 'adm@product.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin@123'),
            'type'              => 1,
            'created_at'        => now()
        ]);

    }
}
