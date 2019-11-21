<?php

use App\User;
use App\Models\Poll\Poll;
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
        factory(Course::class, 20)
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

                                $workshop->users()->saveMany(
                                    factory(User::class, rand(5 ,$workshop->quotas))
                                        ->create()
                                        ->each(function (User $user) {
                                            $user->assignRoles('customer');
                                            factory(Poll::class, 10)->create(['user_id' => $user->id]);
                                        })
                                );

                            })
                    );
                }
            }
        );
    }
}
