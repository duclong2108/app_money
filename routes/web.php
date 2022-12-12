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

Route::namespace('Admin')->group(function(){
    Route::match(['get', 'post'], '/admin', 'AdminController@login');
    Route::group(['middleware'=>'admin'], function(){
        Route::get('/dashboard', 'AdminController@dashboard');
        Route::get('/logout', 'AdminController@logout');
        Route::post('/change-status', 'AdminController@changeStatus');
        Route::match(['get', 'post'], '/privacy-policy', 'AdminController@privacyPolicy');
        Route::match(['get', 'post'], '/rules', 'AdminController@rule');
        Route::match(['get', 'post'], '/question', 'AdminController@question');
        Route::match(['get', 'post'], '/feedback', 'AdminController@feedBack');
        Route::match(['get', 'post'], '/award-every-day', 'AdminController@awardDay');
        Route::match(['get', 'post'], '/award-share', 'AdminController@awardShare');
        Route::match(['get', 'post'], '/account', 'AdminController@account');
        Route::post('/check-password', 'AdminController@checkPassword');

        Route::get('/tasks', 'TaskController@index');
        Route::match(['get', 'post'], '/create/task', 'TaskController@create');
        Route::match(['get', 'post'], '/edit/task/{id}', 'TaskController@edit');
        Route::get('/delete/task/{id}', 'TaskController@delete');
        Route::post('/delete-all/tasks', 'TaskController@deleteAll');

        Route::get('/question_answer/task/{id}', 'QuestionAnswerController@index');
        Route::match(['get', 'post'], '/create/question_answer/task/{id}', 'QuestionAnswerController@create');
        Route::match(['get', 'post'], '/edit/question_answer/{question_answer_id}/task/{task_id}', 'QuestionAnswerController@edit');
        Route::get('/delete/question_answer/{id}', 'QuestionAnswerController@delete');
        Route::post('/delete-all/question_answers', 'QuestionAnswerController@deleteAll');

        Route::get('/banners', 'BannerController@index');
        Route::post('/create/banner', 'BannerController@create');
        Route::post('/edit/banner/{id}', 'BannerController@edit');
        Route::get('/delete/banner/{id}', 'BannerController@delete');
        Route::post('/delete-all/banners', 'BannerController@deleteAll');

        Route::get('/apps', 'AppController@index');
        Route::match(['get', 'post'],'/create/app', 'AppController@create');
        Route::match(['get', 'post'],'/edit/app/{id}', 'AppController@edit');
        Route::get('/delete/app/{id}', 'AppController@delete');
        Route::post('/delete-all/apps', 'AppController@deleteAll');

        Route::get('/adss', 'AdsController@index');
        Route::match(['get', 'post'],'/create/ads', 'AdsController@create');
        Route::match(['get', 'post'],'/edit/ads/{id}', 'AdsController@edit');
        Route::get('/delete/ads/{id}', 'AdsController@delete');
        Route::post('/delete-all/adss', 'AdsController@deleteAll');

        Route::get('/users', 'UserController@index');
        Route::post('/get-money', 'UserController@getMoney');
    });
});
