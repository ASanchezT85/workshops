<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use App\Models\Course\Course;
use Faker\Generator as Faker;
use App\Models\Course\Workshop;

$factory->define(Workshop::class, function (Faker $faker) {
    $price = $faker->numberBetween($min = 100, $max = 500);

    $start_date = $faker->randomElement([
        '2019-10-30', '2019-10-31', '2019-11-1', '2019-11-2', '2019-11-3', '2019-11-4', '2019-11-5', '2019-11-6', '2019-11-7', '2019-11-8', '2019-11-9',
        '2019-11-10', '2019-11-11', '2019-11-12', '2019-11-13', '2019-11-14', '2019-11-15', '2019-11-16', '2019-11-17', '2019-11-18', '2019-11-19', '2019-11-20',
        '2019-11-21', '2019-11-22', '2019-11-23', '2019-11-24', '2019-11-25', '2019-11-26', '2019-11-27', '2019-11-28', '2019-11-29', '2019-11-30', '2019-12-1',
        $faker->date($format = 'Y-m-d', $max = 'now'), $faker->date($format = 'Y-m-d', $max = 'now'), $faker->date($format = 'Y-m-d', $max = 'now')
    ]);

    $hoy = Carbon::now()->format('Y-m-d');

    return [
        'course_id'         => Course::all()->random()->id,
        'start_date'        => $start_date,
        'address'           => $faker->address,
        'sale'              => $faker->randomFloat($nbMaxDecimals = 2, $min = $price, $max = ($price*0.5)),
        'presale'           => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = $price),
        'duration'          => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'team'              => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'certification'     => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'quotas'            => rand(5, 30),
        'state'             => ($start_date < $hoy) ? 'INACTIVE' : 'ACTIVE',
    ];
});
