<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $cats = Categories::All();
        return view('users.index', compact('cats', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $cats = Categories::All();
        return view('users.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request)
    {
        $validated = $request->validated();

        $target = new User;
        $target->name = $request->input('name');
        $target->username = $request->input('username');
        $target->email = $request->input('email');
        $target->password = bcrypt($request->input('password'));        //шифруем пароль
        $target->isAdmin = 1;                                       //всегда сотрудник
        $target->save();


        $users = User::all();
        $cats = Categories::All();
        return view('users.index', compact('cats', 'users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::Find($id);
        $cats = Categories::All();
        return view('users.edit', compact('user','cats'));
    }

    public function makeU($id)
    {
        $target_obj = User::Find($id);
        $target_obj->isAdmin = False;
        $target_obj->save();
        return back();
    }

    public function makeE($id)
    {
        $target_obj = User::Find($id);
        $target_obj->isAdmin = True;
        $target_obj->save();
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, $id)
    {

        $validated = $request->validated();
        $target = User::Find($id);

        $target->name = $request->input('name');
        $target->username = $request->input('username');
        $target->email = $request->input('email');

        if ($request->input('isAdmin') == 'on') {$target->isAdmin = 1;} else {$target->isAdmin = False;} //saving Checkbox Status
        $target->update();


        $users = User::all();
        $cats = Categories::All();
        return view('users.index', compact('cats', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $target_obj = User::Find($id);
        $target_obj->delete();

        return back();
    }
}
