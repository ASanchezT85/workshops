<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sponsor;
use Faker\Generator as Faker;

$factory->define(Sponsor::class, function (Faker $faker) {
    
    $type = $faker->randomElement(['abstract', 'animals', 'business', 'cats', 'city', 'food', 'nightlife', 'fashion', 'people', 'nature', 'sports', 'technics', 'transport']);

    //$file = \Faker\Provider\Image::image(storage_path() . '/app/public/sponsors', 250, 250, 'animals', false);

    $file =  $faker->image(storage_path() . '/app/public/sponsors', 250, 250, null, false);

    $extension = pathinfo(storage_path().'/app/public/sponsors/' . $file, PATHINFO_EXTENSION);
    $data = file_get_contents(storage_path().'/app/public/sponsors/' . $file);
    $dataEncoded = base64_encode($data);
    $base64 = 'data:image/' . $extension . ';base64,' . $dataEncoded;

    return [
        'name'          => $faker->sentence($nbWords = 3, $variableNbWords = true),
        'description'   => $faker->text($maxNbChars = 200),
        'file'          => $base64,
        'state'         => $faker->randomElement(['ACTIVE', 'INACTIVE']),
    ];
});
