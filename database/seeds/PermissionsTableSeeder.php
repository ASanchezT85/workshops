<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Interfaces
        Permission::create([
            'name'          => 'Clear cache', 
            'description'   => 'Ejecutar el comando php artisan cache:clear, este comando solo puede ser ejecutado desde la WEB, y solo un usuario con el role Root podra ejecutarlo.',
        ]);

        Permission::create([
            'name'          => 'Migration', 
            'slug'          => 'migration.fresh', 
            'description'   => 'Ejecutar el comando php artisan migrate:fresh --seed, este comando solo puede ser ejecutado desde la WEB, y solo un usuario con el role Root podra ejecutarlo.',
        ]);

        Permission::create([
            'name'          => 'Laravel Passport', 
            'slug'          => 'passpor.install', 
            'description'   => 'Ejecutar el comando php artisan passport:install --force, este comando solo puede ser ejecutado desde la WEB, y solo un usuario con el role Root podra ejecutarlo.',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Roles:List', 
            'slug'          => 'roles.index', 
            'description'   => 'Listar roles',
        ]);

        Permission::create([
            'name'          => 'Roles:Create View', 
            'slug'          => 'roles.create', 
            'description'   => 'Ver el formulario que permite la creacion de los roles', 
        ]);

        Permission::create([
            'name'          => 'Roles:Store', 
            'slug'          => 'roles.store', 
            'description'   => 'Guardar un nuevo role en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Roles:Show', 
            'slug'          => 'roles.show', 
            'description'   => 'Ver el detalle de un rol en especifico',
        ]);

        Permission::create([
            'name'          => 'Roles:Edit View', 
            'slug'          => 'roles.edit', 
            'description'   => 'Ver el formulario que permite la edición de los roles',
        ]);

        Permission::create([
            'name'          => 'Roles:Update', 
            'slug'          => 'roles.update', 
            'description'   => 'Permite actualizar la informacion de un rol en especifico',
        ]);

        Permission::create([
            'name'          => 'Roles:Destroy', 
            'slug'          => 'roles.destroy', 
            'description'   => 'Eliminar un rol de la base de datos.',
        ]);

        //Users
        Permission::create([
            'name'          => 'Users:List', 
            'slug'          => 'users.index', 
            'description'   => 'Listar usuarios',
        ]);

        Permission::create([
            'name'          => 'Users:Create View', 
            'slug'          => 'users.create', 
            'description'   => 'Ver el formulario que permite crear un usuario nuevo, este permiso solo esta disponible para un usuario con el rol Root o Administrador', 
        ]);

        Permission::create([
            'name'          => 'Users:Store', 
            'slug'          => 'users.store', 
            'description'   => 'Guardar un nuevo usuario en la base de datos, este permiso solo esta disponible para un usuario con el rol Root o Administrador',
        ]);

        Permission::create([
            'name'          => 'Users:Show', 
            'slug'          => 'users.show', 
            'description'   => 'Ver el detalle de un usuario en especifico',
        ]);

        Permission::create([
            'name'          => 'Users:Edit View', 
            'slug'          => 'users.edit', 
            'description'   => 'Ver el formulario que permite la edición de los usuarios',
        ]);

        Permission::create([
            'name'          => 'Users:Update', 
            'slug'          => 'users.update', 
            'description'   => 'Permite actualizar la informacion de un usuario en especifico',
        ]);

        Permission::create([
            'name'          => 'Users:Destroy', 
            'slug'          => 'users.destroy', 
            'description'   => 'Eliminar un usuario de la base de datos',
        ]);

        //Variables
        Permission::create([
            'name'          => 'Variables:List', 
            'slug'          => 'variables.index', 
            'description'   => 'Listar variables',
        ]);

        Permission::create([
            'name'          => 'Variables:Create View', 
            'slug'          => 'variables.create', 
            'description'   => 'Ver el formulario que permite crear una variable nueva.', 
        ]);

        Permission::create([
            'name'          => 'Variables:Store', 
            'slug'          => 'variables.store', 
            'description'   => 'Guardar una nueva variable en la base de datos.',
        ]);

        Permission::create([
            'name'          => 'Variables:Show', 
            'slug'          => 'variables.show', 
            'description'   => 'Ver el detalle de una variable en especifico',
        ]);

        Permission::create([
            'name'          => 'Variables:Edit View', 
            'slug'          => 'variables.edit', 
            'description'   => 'Ver el formulario que permite la edición de las variables',
        ]);

        Permission::create([
            'name'          => 'Variables:Update', 
            'slug'          => 'variables.update', 
            'description'   => 'Permite actualizar la informacion de una variable en especifico',
        ]);

        Permission::create([
            'name'          => 'Variables:Destroy', 
            'slug'          => 'variables.destroy', 
            'description'   => 'Eliminar una variable de la base de datos',
        ]);

        //Course
        Permission::create([
            'name'          => 'Course:List', 
            'slug'          => 'courses.index', 
            'description'   => 'Listar cursos',
        ]);

        Permission::create([
            'name'          => 'Course:Create View', 
            'slug'          => 'courses.create', 
            'description'   => 'Ver el formulario que permite la creacion de los cursos', 
        ]);

        Permission::create([
            'name'          => 'Course:Store', 
            'slug'          => 'courses.store', 
            'description'   => 'Guardar una nuevo curso en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Course:Show', 
            'slug'          => 'courses.show', 
            'description'   => 'Ver el detalle de un curso en especifico',
        ]);

        Permission::create([
            'name'          => 'Course:Edit View', 
            'slug'          => 'courses.edit', 
            'description'   => 'Ver el formulario que permite la edición de los cursos',
        ]);

        Permission::create([
            'name'          => 'Course:Update', 
            'slug'          => 'courses.update', 
            'description'   => 'Permite actualizar la informacion de un curso en especifico',
        ]);

        Permission::create([
            'name'          => 'Course:Destroy', 
            'slug'          => 'courses.destroy', 
            'description'   => 'Eliminar un curso de la base de datos.',
        ]);

        //Sponsor
        Permission::create([
            'name'          => 'Sponsor:List', 
            'slug'          => 'sponsors.index', 
            'description'   => 'Listar patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Create View', 
            'slug'          => 'sponsors.create', 
            'description'   => 'Ver el formulario que permite la creacion de las patrocinadores', 
        ]);

        Permission::create([
            'name'          => 'Sponsor:Store', 
            'slug'          => 'sponsors.store', 
            'description'   => 'Guardar una nuevo patrocinador en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Show', 
            'slug'          => 'sponsors.show', 
            'description'   => 'Ver el detalle de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Edit View', 
            'slug'          => 'sponsors.edit', 
            'description'   => 'Ver el formulario que permite la edición de las patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Update', 
            'slug'          => 'sponsors.update', 
            'description'   => 'Permite actualizar la informacion de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Sponsor:Destroy', 
            'slug'          => 'sponsors.destroy', 
            'description'   => 'Eliminar una patrocinador de la base de datos.',
        ]);

        //Workshop
        Permission::create([
            'name'          => 'Workshop:List', 
            'slug'          => 'workshops.index', 
            'description'   => 'Listar patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Workshop:Create View', 
            'slug'          => 'workshops.create', 
            'description'   => 'Ver el formulario que permite la creacion de las patrocinadores', 
        ]);

        Permission::create([
            'name'          => 'Workshop:Store', 
            'slug'          => 'workshops.store', 
            'description'   => 'Guardar una nuevo patrocinador en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Workshop:Show', 
            'slug'          => 'workshops.show', 
            'description'   => 'Ver el detalle de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Workshop:Edit View', 
            'slug'          => 'workshops.edit', 
            'description'   => 'Ver el formulario que permite la edición de las patrocinadores',
        ]);

        Permission::create([
            'name'          => 'Workshop:Update', 
            'slug'          => 'workshops.update', 
            'description'   => 'Permite actualizar la informacion de una patrocinador en especifico',
        ]);

        Permission::create([
            'name'          => 'Workshop:Destroy', 
            'slug'          => 'workshops.destroy', 
            'description'   => 'Eliminar una patrocinador de la base de datos.',
        ]);
    }
}
