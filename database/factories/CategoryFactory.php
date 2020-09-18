<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name'          =>  $faker->unique()->word,
        'description'   =>  $faker->realText(100),
        'parent_id'     =>  1,
        'menu'          =>  1,
    ];
});
/*$factory->state(Category::class, 'child', function ($faker) {
    return [
        'name'          =>  $faker->unique()->word,
        'description'   =>  $faker->realText(100),
        'parent_id'     =>  $faker->numberBetween($min = 2, $max = 10),
        'menu'          =>  1,
    ];
});*/
?>
