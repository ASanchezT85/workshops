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
            'name'          => 'Root',
            'description'   => 'Super Administrador',
            'special'       => 'all-access',
        ]);

        Role::create([
            'name'          => 'Restringido',
            'description'   => 'Usuario con acceso restringido',
            'special'       => 'no-access',
        ]);
    }
}
