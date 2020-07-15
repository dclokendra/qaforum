<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('')->group(function(){
    Route::get('', 'VisitorController@index')->name('visitor.index');
});

Route::get('/welcome', function () {
    return view('layouts.backend');
});

//----visitor controller--//
Route::prefix('user')->group(function () {

    Route::get('register',                  'VisitorController@create')                ->name('visitor.register');
    Route::post('register',                 'VisitorController@store')                 ->name('visitor.register.store');
    Route::get('key={code}',                'VisitorController@verification')          ->name('visitor.register.verify');
    Route::get('forgot.html',               'PasswordResetController@forgot')           ->name('visitor.forgot.password');
    Route::post('forgot.html',              'PasswordResetController@sendMail')         ->name('visitor.forgot.send_reset');
    Route::get('reset={token}',             'PasswordResetController@reset')            ->name('visitor.reset');
    Route::post('resetpassword',            'PasswordResetController@resetpassword')    ->name('visitor.reset_password');
});
//----visitorLogin controller--//
Route::prefix('user')->group(function () {
    Route::get('login',       'Auth\VisitorLoginController@login')             ->name('visitor.auth.login');
    Route::post('login',      'Auth\VisitorLoginController@loginVisitor')     ->name('visitor.auth.login');
    Route::get('logout',     'Auth\VisitorLoginController@logout')            ->name('visitor.auth.logout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('/backend/')->middleware('auth')->group(function () {
    //listing page
    Route::get('category', 'CategoryController@index')->name('category.index');
    //insert form
    Route::get('category/create', 'CategoryController@create')->name('category.create');
    //data store
    Route::post('category', 'CategoryController@store')->name('category.store');
    //view details of category
    Route::get('category/{id}', 'CategoryController@show')->name('category.show');
    //edit for category
    Route::get('category/{id}/edit', 'CategoryController@edit')->name('category.edit');
    //update for category
    Route::put('category/{id}', 'CategoryController@update')->name('category.update');
    //delete for category
    Route::delete('category/{id}', 'CategoryController@destroy')->name('category.destroy');
});

Route::prefix('/user/')->group(function () {
    //list question
    Route::get('question', 'QuestionController@index')->name('question.index');
    //insert form
    Route::get('question/create', 'QuestionController@create')->name('question.create');
    //data store
    Route::post('question', 'QuestionController@store')->name('question.store');
    //edit for question
    Route::get('question/{id}/edit', 'QuestionController@edit')->name('question.edit');
    //update for question
    Route::put('question/{id}/update', 'QuestionController@update')->name('question.update');
    //delete for question
    Route::delete('question/{id}', 'QuestionController@destroy')->name('question.destroy');

    //list answer
    Route::get('answer', 'AnswerController@index')->name('answer.index');
    //insert form
    Route::get('answer/create', 'AnswerController@create')->name('answer.create');
    //data store
    Route::post('answer', 'AnswerController@store')->name('answer.store');
    //edit for answer
    Route::get('answer/{id}/edit', 'AnswerController@edit')->name('answer.edit');
    //update for answer
    Route::put('answer/{id}/update', 'AnswerController@update')->name('answer.update');
    //delete for answer
    Route::delete('answer/{id}', 'AnswerController@destroy')->name('answer.destroy');
});
