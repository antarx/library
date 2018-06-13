<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    protected $categories = [
        'Демо',
        'Аудит, бухгалтерський, кадровий облік',
        'Фінанси',
        'Економіка',
        'Менеджмент',
        'Маркетинг',
        'Правова література',
        'Гуманітарні науки',
        'Природничі та технічні науки'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            DB::table('categories')->insert([
                'name'       => $category,
                'h1'         => $category,
                'slug'       => str_slug($category),
                'meta_title' => $category,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
