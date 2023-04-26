<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Http\Requests\StoreBooksRequest;
use App\Http\Requests\UpdateBooksRequest;
use App\Models\Comments;
use Illuminate\Support\Facades\File;
use Image;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $cats = Categories::All();

        $cat = $cats->keyBy('slug');        //get current category object by slug
        $curcat = $cat->get($id);
        //$curcat = Categories::Find($id);

        return view('books.create', compact('cats','curcat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBooksRequest $request)
    {

        $catid = Categories::All()->keyBy('slug')->get($request->input('slug'));     //getting selected category

        $validated = $request->validated();

        $dbpost = new Books();


        $file = $request->image;
        if ($file != null) {                    //Если прикрепили картинку
            $filename=$file->getClientOriginalName();
            $namegen = time().'_'.$filename;
            $img = Image::make($file)->resize(400,576)->save(public_path('storage/covers/'.$namegen));        //Меняем размер и сохраняем
            $dbpost->cover = $namegen;
        }

        $dbpost->categories_id = $catid->id;

        $dbpost->author = $request->input('author');
        $dbpost->title = $request->input('title');
        $dbpost->description = $request->input('description');
        $dbpost->rating = rand(0,100);

        //slug генерируется при сохранении в базу данных


        $dbpost->save();

        return redirect('/categories/'.$request->input('slug'));           //Возврат в категорию
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book)
    {

        $comments = $book->comment()->with('users')->get();

        $category = $book->category();
        $cats = Categories::All();            //Отправляем все категории для отображения в шаблоне

        return view('books.show', compact('book','comments', 'category','cats'));  //Передаём объекты текущей книги, комментарии, текушую категорию и все категории (для шапки)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $book)
    {
        $cats = Categories::All();





        return view('books.edit', compact('cats', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBooksRequest $request, Books $book)
    {

        $validated = $request->validated();




        $file = $request->image;
        if ($file != null) {                    //Если прикрепили картинку
            $filename=$file->getClientOriginalName();
            $namegen = time().'_'.$filename;
            $img = Image::make($file)->resize(400,576)->save(public_path('storage/covers/'.$namegen));        //Меняем размер и сохраняем
            $book->cover = $namegen;
        }

        $book->author = $request->input('author');
        $book->title = $request->input('title');
        $book->description = $request->input('description');
        $book->rating = rand(0,100);
        //slug генерируется при сохранении в базу данных


        $book->update();

        $cats = Categories::All();
        $b = $cats->where('id', $book->categories_id)->first()->slug;
        return redirect('/categories/'.$b);

        //Возврат в категорию
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $book)
    {


        // $image = public_path($book->cover);
        // if (File::exists($image)) {                      //Можно включить удаление файлов при удалении книги
        //     File::delete($image);
        // }

        $book->delete();

        return back();
    }
}
