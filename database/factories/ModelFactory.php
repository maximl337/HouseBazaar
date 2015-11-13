<?php


$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Property::class, function (Faker\Generator $faker) {
    return [
        'user_id'       => factory('App\User')->create()->id,
        'street'        => $faker->streetAddress,
        'city'          => $faker->city,
        'zip'           => $faker->postcode,
        'state'         => $faker->state,
        'country'       => 'ca',
        'price'         => $faker->numberBetween(10000, 5000000),
        'description'   => $faker->text,
        'bedrooms'      => 2,
        'bathrooms'     => 1,
        'size_square_feet'  => 1200,
        'transaction_type'  => array_rand(["rent" => "rent", "sale" => "sale"]),
        'seller_type' => array_rand(["owner" => "owner", "professional" => "professional"]),
        'property_type' => array_rand(["apartment" => "apartment", "house" => "house", "room" => "room", "commercial" => "commercial"]),
        'sample'    => true,
        'published' => true
    ];
});

$factory->define(App\Photo::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->text,
        'path' => $faker->imageUrl($width=1100, $height=590, 'city', true, 'Faker'),
        'thumbnail_path' => $faker->imageUrl($width=200, $height=200, 'city', true, 'Faker')
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});