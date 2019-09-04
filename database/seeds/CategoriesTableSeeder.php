<?php

use App\Category;
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
        $category = [
            ['RELEASES'],
            ['FORGE'],
            ['ENVOYER']
            ];

        foreach ($category as $value) {
            factory(Category::class)->create([
                'name' => $value[0],
                'slug' => Str::slug($value[0])
            ]);
        }
    }
}
