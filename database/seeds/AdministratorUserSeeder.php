<?php

use App\User;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class AdministratorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name'          => 'ADMINISTRATOR',
            'description'   => 'Administrador de la plataforma',
        ]);

        $permissions = Permission::whereNotIn('id', [1, 2, 3])->get();

        $slugs = array();
        foreach ($permissions as $value) {
            if (!in_array($value->slug, $slugs)) {
                $slugs[] = $value->slug;
            }
        }

        $role->syncPermissions($slugs);

        User::create([
            'name'              => 'Julio Chirinos',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => 'password', // password
            'type'              => User::ADMIN
        ])->assignRoles($role->slug);
    }
}
