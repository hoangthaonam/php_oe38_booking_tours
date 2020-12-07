<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'image' => $faker->name,
        'role' => $faker->numberBetween(0,1),
        'remember_token' => str_random(10),
    ];
});

// Category
$factory->define(\App\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => $faker->numberBetween(0,10),
    ];
});

//Tour
$factory->define(\App\Models\Tour::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    $slug = str_slug($name);
    return [
        'name' => $name,
        'image' => $faker->name,
        'slug' => $slug,
        'place_from' => $faker->country,
        'place_to' => $faker->country,
        'place_tobe' => $faker->country,
        'duration' => $faker->numberBetween(1,5),
        'price' => $faker->numberBetween(10000,50000),
        'hotel_star' => $faker->numberBetween(1,5),
        'des' => $faker->text(100),
        'quantity_people' => $faker->numberBetween(1,5),
        'booking_number' => $faker->randomDigit(),
        'category_id' => $faker->numberBetween(1,10),
    ];
});

//Rating
$factory->define(\App\Models\Rating::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,10),
        'tour_id' => $faker->numberBetween(1,10),
        'rating' => $faker->numberBetween(0,5),
    ];
});

//CommentReview
$factory->define(\App\Models\CommentReview::class, function (Faker\Generator $faker) {
    $type = $faker->numberBetween(1,2);
    return [
        'user_id' => $faker->numberBetween(1,10),
        'tour_id' => $faker->numberBetween(1,10),
        'content' => $faker->text(100),
        'type' => $type,
        'parent_id' => $type == 1 ? $faker->numberBetween(1,10) : null,
        'title' => $type == 2 ? $faker->sentence(6, true) : null,
    ];
});

//Like
$factory->define(\App\Models\Like::class, function (Faker\Generator $faker) {
    return [
        'review_id' => $faker->numberBetween(1,10),
        'user_id' => $faker->numberBetween(1,10),
    ];
});

//Booktour
$factory->define(\App\Models\BookTour::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,10),
    ];
});

//Payment
$factory->define(\App\Models\Payment::class, function (Faker\Generator $faker) {
    $payment_method = $faker->randomElement(['banking', 'normal']);
    return [
        'payment_method' => $payment_method,
        'booktour_id' => $faker->numberBetween(1,10),
        'payment_status' => $payment_method == 'normal' ? $faker->numberBetween(0,1) : 1,
    ];
});

//BooktourDetails
$factory->define(\App\Models\BookTourDetails::class, function (Faker\Generator $faker) {
    return [
        'tour_id' => $faker->numberBetween(1,10),
        'booktour_id' => $faker->numberBetween(1,10),
        'tour_name' => $faker->name,
        'quantity_people' => $faker->numberBetween(1,10),
        'price' => $faker->numberBetween(1000,5000),
    ];
});

