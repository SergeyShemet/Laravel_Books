<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Books;
use App\Models\Comments;
//use App\Models\Comme;
use DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        DB::table('users')->insert([
            'name' => 'Администратор',
            'username' => 'admin',
            'email' => 'admin@domain.com',
            'password' => Hash::make('password'),
            'isAdmin' => true,       //Первый пользователь admin
            'created_at' => Now(),
        ]);

        User::factory()->count(20)->create();   //Создаём остальных пользователей

        //Создаём заранее заданные категории
        DB::table('categories')->insert([ 'title' => 'Детективы', 'slug' => 'detectives','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Историческое', 'slug' => 'history','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Научная фантастика', 'slug' => 'science_fiction','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Романы', 'slug' => 'romance','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Фэнтези', 'slug' => 'fantasy','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Психология', 'slug' => 'psychology','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Юмор', 'slug' => 'humor','created_at' => Now() ]);
        DB::table('categories')->insert([ 'title' => 'Технологии', 'slug' => 'tech','created_at' => Now() ]);


        //Можно создать книги при создании категорий, используя связи, но задавая категории вручную - проще генерировать книги отдельно.


        //Создаём книги
        Books::factory()->count(200)->create();

        //Создаём комментарии к книгам
        Comments::factory()->count(500)->create();


    }

}
