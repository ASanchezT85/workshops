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

    $file = \Faker\Provider\Image::image(storage_path() . '/app/public/courses', 400, 600, $type, false);
    $extension = pathinfo(storage_path().'/app/public/courses/' . $file, PATHINFO_EXTENSION);
    $data = file_get_contents(storage_path().'/app/public/courses/' . $file);
    $dataEncoded = base64_encode($data);
    $base64 = 'data:image/' . $extension . ';base64,' . $dataEncoded;

    return [
        'lang_id'           => $lang->id,
        'category_id'       => $category->id,
        'name'              => $faker->sentence($nbWords = 10, $variableNbWords = true),
        'description'       => $faker->text($maxNbChars = 200),
        'headed_to'         => $faker->text($maxNbChars = 200),
        'deception'         => $faker->text($maxNbChars = 200),
        'file'              => $base64,
        'state'             => $faker->randomElement(['ACTIVE', 'INACTIVE']),
    ];
});
