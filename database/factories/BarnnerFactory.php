<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\Course;
use Faker\Generator as Faker;
use App\Models\Course\Barnner;

$factory->define(Barnner::class, function (Faker $faker) {
    $type = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport']);

    $file = \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 1200, 700, $type, false);

    return [
        'course_id'     => Course::all()->random()->id,
        'file'          => $file, 
    ];
});
