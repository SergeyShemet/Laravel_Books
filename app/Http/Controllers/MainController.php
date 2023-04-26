<?php

namespace App\Http\Controllers;

use App\Imports\BooksImport;
use App\Models\Categories;
use App\Models\Books;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
    public function home() {
        return view('home', ['cats' => Categories::all()]);     //передаём список категорий на главную страницу
    }

    public function importXls() {
        return view('import', ['cats' => Categories::all()]);
    }

    public function dev() {
        return view('develop');
    }


    public function importupdate(Request $request) {

        if ($request->file('file') == null) {
            return back()->with('success', 'Выберите файл!');
        }

        //dd($request->file('file'));
        Excel::import(new BooksImport, $request->file('file')->store('temp'));

        return back()->with('success', 'Файл успешно импортирован!');

    }

}
