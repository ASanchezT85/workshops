<?php

use App\Models\Course\Course;
use App\Models\Course\Barnner;
use App\Models\Course\Workshop;
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

                if ($course->state != 'INACTIVE'){
                    $course->workshops()->saveMany(
                        factory(Workshop::class, 5)
                            ->create()
                            ->each(function (Workshop $workshop){
                                $workshop->sponsors()->attach([
                                    rand(1,10),
                                    rand(11,20),
                                    rand(21,30),
                                    rand(31,40),
                                    rand(41,50),
                                ]);
                                 $workshop->users()->attach([
                                    rand(1,10),
                                    rand(11,20),
                                    rand(21,30),
                                    rand(31,40),
                                    rand(41,50),
                                    rand(51,60),
                                    rand(61,70),
                                    rand(71,80),
                                    rand(81,90),
                                    rand(91,100),
                                ]);
                            })
                    );
                }
            });

    }
}
