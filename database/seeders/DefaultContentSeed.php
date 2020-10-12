<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DefaultContentSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Seed Permissions assignable
        Permission::firstOrCreate(array('name' => 'roles'));
        Permission::firstOrCreate(array('name' => 'events'));
        Permission::firstOrCreate(array('name' => 'membershipType'));
    }
}
