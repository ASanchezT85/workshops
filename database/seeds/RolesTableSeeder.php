<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //'name', 'slug', 'description', 'special'
        Role::create([
            'name'          => 'ROOT',
            'description'   => 'Super Administrador',
            'special'       => 'all-access',
        ]);

        Role::create([
            'name'          => 'RESTRICTED',
            'description'   => 'Usuario con acceso restringido',
            'special'       => 'no-access',
        ]);

        Role::create([
            'name'          => 'CUSTOMER',
            'description'   => 'Usuario de uso normal',
            'special'       => 'no-access',
        ]);
    }
}
