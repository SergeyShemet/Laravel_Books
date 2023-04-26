<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Http\Requests\StoreCategoriesRequest;
use App\Http\Requests\UpdateCategoriesRequest;


class CategoriesController extends Controller
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
    public function create()
    {

        $cats = Categories::All();
        return view('categories.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriesRequest $request)
    {
        $validated = $request->validated();
        $dbpost = new Categories();
        $dbpost->title = $request->input('title');
        //slug generates on db record create
        $dbpost->save();

        $cats = Categories::All();
        return view('categories.editlist', compact('cats'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $category)
    {
        $cats = Categories::All();            //Отправляем все категории для отображения в шаблоне
        $booklist = array();
        $b = $category->books;
        if (count($b) != 0) {
           $booklist = $b->toQuery()->paginate(10);
        }


        $cattitle = $category->title;
        $catid = $category->slug;
        return view('categories.show', compact('booklist', 'cattitle','cats','catid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {

        $cats = Categories::All();
        return view('categories.edit', compact('category', 'cats'));
    }

    public function editlist()
    {

        $cats = Categories::All();

        return view('categories.editlist', compact('cats'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriesRequest $request, Categories $category)
    {
        $validated = $request->validated();
        $category->title = $request->input('title');
        $category->update();

        $cats = Categories::All();
        return view('categories.editlist', compact('cats'));
        //return redirect('/tags/');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {

        $category->delete();


        return redirect('/categories/editlist');
    }
}
