<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Poll\Questionnaire;

$factory->define(Questionnaire::class, function (Faker $faker) {
    return [
        'state'         => $faker->randomElement(['ACTIVE', 'INACTIVE']),
    ];
});
