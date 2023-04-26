<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use DB;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comments>
 */
class CommentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {


            //Привязываем комментарий к книге и пользователю
            $booksIDs = DB::table('books')->pluck('id');
            $usersIDs = DB::table('users')->pluck('id');

            return [
                'books_id' => fake()->randomElement($booksIDs),
                'users_id' => fake()->randomElement($usersIDs),
                'comment' => fake()->paragraph(),
                'created_at' => Now(),
            ];

    }
}
