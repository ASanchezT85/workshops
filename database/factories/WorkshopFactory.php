<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\Course;
use Faker\Generator as Faker;
use App\Models\Course\Workshop;

$factory->define(Workshop::class, function (Faker $faker) {
    $price = $faker->numberBetween($min = 100, $max = 500);
    return [
        'course_id'     => Course::all()->random()->id,
        'start_date'    => $faker->date($format = 'Y-m-d', $max = null),
        'address'       => $faker->address,
        'sale'          => $faker->randomFloat($nbMaxDecimals = 2, $min = $price, $max = ($price*0.5)),
        'presale'       => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = $price),
        'duration'      => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'team'          => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'certification' => $faker->sentence($nbWords = 10, $variableNbWords = true),
    ];
});
