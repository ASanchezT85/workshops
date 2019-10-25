<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    $type = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport']);

    $file = \Faker\Provider\Image::image(storage_path() . '/app/public/sponsors', 140, 140, $type, false);

    return [
        'name'          => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description'   => $faker->text($maxNbChars = 200),
        'file'          => $file,
        'state'         => $faker->randomElement(['ACTIVE', 'INACTIVE']),
    ];
});
