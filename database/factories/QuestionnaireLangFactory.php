<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Poll\Questionnaire;
use App\Models\Variables\Language;
use App\Models\Poll\QuestionnaireLang;

$factory->define(QuestionnaireLang::class, function (Faker $faker) {
    $lang = Language::all()->random();
    $questionnaire_id = Questionnaire::all()->random();
    return [
        'questionnaire_id'  => $questionnaire_id->id,
        'lang_id'           => $lang->id,
        'question'          => $faker->sentence($nbWords = 5, $variableNbWords = true),
        'description'       => $faker->text($maxNbChars = 200),
    ];
});
