<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'          => 'Root',
            'description'   => 'this is the root category, don\'t delete this one',
            'parent_id'     => null,
            'menu'          => 0,
        ]);

        factory(App\Models\Category::class, 10)->create();
        //factory(App\Models\Category::class, 10)->states('child')->create();
    }
}
