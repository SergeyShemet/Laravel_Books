<?php

namespace App\Imports;

use App\Models\Books;
use App\Models\Categories;
use Maatwebsite\Excel\Concerns\ToModel;

class BooksImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $allcats = Categories::all();
        $srccat = $row[3];
        $destcat = $allcats->where('title', $srccat)->first()->id;

        return new Books([
            'author'=> $row[1],
            'title' => $row[0],
            'categories_id' => $destcat,
            'rating' => rand(0,100),
            'cover' => null,
            'description' => 'Импорт из XLS',
        ]);
    }
}
