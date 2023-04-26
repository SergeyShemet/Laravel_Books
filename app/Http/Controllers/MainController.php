<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Books;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home() {
        return view('home', ['cats' => Categories::all()]);     //передаём список категорий на главную страницу
    }

    public function about() {
        return view('about');
    }

    public function dev() {
        return view('develop');
    }

}
