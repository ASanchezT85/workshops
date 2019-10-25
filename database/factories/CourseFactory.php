<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Course\Course;
use Faker\Generator as Faker;
use App\Models\Category\Category;
use App\Models\Variables\Language;

$factory->define(Course::class, function (Faker $faker) {
    $lang = Language::all()->random();

    $category = Category::all()->random();
    
    $type = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport']);

    $file = \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 400, 1000, $type, false);
    return [
        'lang_id'           => $lang->id,
        'category_id'       => $category->id,
        'name'              => '[lang => '.$lang->name.'] - ' . $faker->sentence($nbWords = 10, $variableNbWords = true),
        'description'       => '[lang => '.$lang->name.'] - ' . $faker->text($maxNbChars = 200),
        'headed_to'         => '[lang => '.$lang->name.'] - ' . $faker->text($maxNbChars = 200),
        'deception'         => '[lang => '.$lang->name.'] - ' . $faker->text($maxNbChars = 200),
        'file'              => $file,
        'state'             => $faker->randomElement(['ACTIVE', 'INACTIVE']),
        'space_available'   => $faker->randomNumber($nbDigits = 2, $strict = false)
    ];
});
