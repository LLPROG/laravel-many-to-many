<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Sport'
            ],
            [
                'name' => 'Tecnologia'
            ],
            [
                'name' => 'Arte'
            ],
            [
                'name' => 'Musica'
            ],
            [
                'name' => 'Moda'
            ],
            [
                'name' => 'Politica'
            ],
        ];

        foreach ($categories as  $category) {
            Category::create($category);
        }
    }
}
