<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Models\Poll\Poll;
use Faker\Generator as Faker;
use App\Models\Course\Workshop;
use App\Models\Poll\Questionnaire;

$factory->define(Poll::class, function (Faker $faker) {
    return [
        'user_id'           => User::all()->random()->id,
        'workshop_id'       => Workshop::all()->random()->id,
        'questionnaire_id'  => Questionnaire::all()->random()->id,
        'punctuation'       => rand(1,5),
    ];
});
