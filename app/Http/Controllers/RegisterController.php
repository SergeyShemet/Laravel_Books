<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\Categories;

class RegisterController extends Controller
{
    public function show()
    {
        $cats = Categories::All();
        return view('auth.register', compact('cats'));
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        auth()->login($user);
        return redirect('/')->with('success', "Аккаунт зарегистрирован");
    }

}
