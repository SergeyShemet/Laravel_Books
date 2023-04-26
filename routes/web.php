<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;



Route::get('/', [MainController::class, 'home'])->name('home');
Route::get('/importXls', [MainController::class, 'importXls'])->name('import');
Route::post('/importupdate', [MainController::class, 'importupdate'])->name('importupdate');

Route::get('/books/{catslug}/create', [BooksController::class, 'create'])->name('bookcreate');                  //создание книг

Route::resource('/books', BooksController::class);                  //Контроллер книг

Route::get('/categories/editlist', [CategoriesController::class, 'editlist'])->name('editlist');        //Редактор категорий
Route::resource('/categories', CategoriesController::class);        //Контроллер категорий

Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');              //удаляем пользователя
Route::post('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');              //редактор пользователя
Route::post('/users/{id}/update', [UsersController::class, 'update'])->name('users.update');              //Обновляем пользователя
Route::get('/users/{id}/makeU', [UsersController::class, 'makeU'])->name('makeU');        //Сделать пользователем
Route::get('/users/{id}/makeE', [UsersController::class, 'makeE'])->name('makeE');        //Сделать сотрудником

Route::resource('/users', UsersController::class);        //Контроллер пользователей



Route::post('/comments/{book_id}/{user_id}', [CommentsController::class, 'store'])->name('comment.custom.store');              //Пишем комментарии
Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comment.destroy');              //удаляем комментарий


                                                                    //Роуты регистрации и авторизации в middleware
Route::group(['middleware' => ['guest']], function() {

    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register',  [RegisterController::class, 'register'])->name('register.perform');

    Route::get('/login',  [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

});

Route::group(['middleware' => ['auth']], function() {

        Route::get('/logout', [LogoutController::class, 'perform'])->name('logout.perform');
});



