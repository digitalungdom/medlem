<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\EventType;

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
        Permission::firstOrCreate(array('name' => 'users'));

        EventType::firstOrCreate(array('name' => 'LAN-party'));
        EventType::firstOrCreate(array('name' => 'LAN-turnering'));
        EventType::firstOrCreate(array('name' => 'Online-turnering'));
        EventType::firstOrCreate(array('name' => 'Kodeklubb'));
        EventType::firstOrCreate(array('name' => 'Årsmøte'));
    }
}
