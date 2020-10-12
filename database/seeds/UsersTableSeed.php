<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'email' => 'admin@admin.admin',
            'cellphone' => '12345678',
            'password' => bcrypt('admin'),
            'globaladmin' => 1,
            'firstname' => 'Super',
            'lastname' => 'admin'
        ]);
    }
}
