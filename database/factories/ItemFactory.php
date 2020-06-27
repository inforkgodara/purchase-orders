<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Item;
use Faker\Generator as Faker;
use App\ItemGroup;
use App\ItemCategory;
use App\ItemUnit;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'item_group_id' => ItemGroup::inRandomOrder()->first()->id,
        'item_category_id' => ItemCategory::inRandomOrder()->first()->id,
        'name' => $faker->word,
        'bar_code' => $faker->randomNumber(8),
        'pack_unit_id' => ItemUnit::inRandomOrder()->first()->id,
        'standard_unit_id' => ItemUnit::inRandomOrder()->first()->id,
        'pack_size' => $faker->randomNumber(2),
        'specification' => $faker->text(100)
    ];
});
