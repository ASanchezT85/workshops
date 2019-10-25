<?php

use App\Models\Course\Course;
use App\Models\Course\Barnner;
use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Course
        Permission::create([
            'name'          => 'Course:List', 
            'slug'          => 'categories.index', 
            'description'   => 'Listar cursos',
        ]);

        Permission::create([
            'name'          => 'Course:Create View', 
            'slug'          => 'categories.create', 
            'description'   => 'Ver el formulario que permite la creacion de los cursos', 
        ]);

        Permission::create([
            'name'          => 'Course:Store', 
            'slug'          => 'categories.store', 
            'description'   => 'Guardar una nuevo curso en la base de datos',
        ]);

        Permission::create([
            'name'          => 'Course:Show', 
            'slug'          => 'categories.show', 
            'description'   => 'Ver el detalle de un curso en especifico',
        ]);

        Permission::create([
            'name'          => 'Course:Edit View', 
            'slug'          => 'categories.edit', 
            'description'   => 'Ver el formulario que permite la edición de los cursos',
        ]);

        Permission::create([
            'name'          => 'Course:Update', 
            'slug'          => 'categories.update', 
            'description'   => 'Permite actualizar la informacion de un curso en especifico',
        ]);

        Permission::create([
            'name'          => 'Course:Destroy', 
            'slug'          => 'categories.destroy', 
            'description'   => 'Eliminar un curso de la base de datos.',
        ]);

        factory(Course::class, 10)
            ->create()
            ->each(function (Course $course) {
                $course->barnners()->saveMany(factory(Barnner::class, 3)->create());
            });

    }
}
