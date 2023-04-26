<?php

namespace Database\Factories;

use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Books>
 */
class BooksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
                                                //Генерируем книгу
        $title = fake()->word();
        $author = fake()->name();
        $imgarr = array('01.png','02.png','03.png','04.png','05.png','-');
        $randbook = $imgarr[array_rand($imgarr, 1)];  //начальные обложки
        $cover = ($randbook != '-') ? $randbook : null; //Тестовая обложка либо её отсутствие
        $catIDs = DB::table('categories')->pluck('id');

        return [
            'author' => $author,
            'title' => $title,
            'slug' => Str::slug($author.'-'.$title),
            'rating' => fake()->numberBetween(0, 100),
            'description' => fake()->paragraph(),
            'cover' => $cover,
            'categories_id' => fake()->randomElement($catIDs),
            'created_at' => Now(),
        ];
    }
}
