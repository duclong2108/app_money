<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
function url_query($to, array $params = [], array $additional = []) {
    return Str::finish(url($to, $additional), '?') . Arr::query($params);
}
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace('Api')->group(function () {
    Route::post('/login', 'UserController@login');
    Route::post('/register', 'UserController@register');
    /////////////////
    Route::get('/apps', 'AppController@index');
    Route::post('/create/app', 'AppController@create');
    Route::match(['get', 'post'], '/edit/app', 'AppController@edit');
    Route::get('/delete/app', 'AppController@delete');
    Route::get('/get-coupon', 'AppController@getCoupon');
    ////////////////////////
    // Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/logout', 'UserController@logout');
    Route::get('/users', 'UserController@users');
    Route::get('/rules', 'UserController@rule');
    Route::get('/privacy-policy', 'UserController@privacyPolicy');
    Route::match(['get', 'post'], 'make-task/{id}/user/{token}', 'UserController@makeTask');
    Route::post('/get-money-every-day', 'UserController@getMoney');
    Route::post('/get-email', 'UserController@getEmail');
    Route::post('/save-token', 'UserController@saveToken');
    Route::get('/money-share', 'UserController@moneyShare');

    ////////////////////
    Route::get('/tasks', 'TaskController@index');
    Route::match(['get','post'],'/edit/task', 'TaskController@edit');
    // Route::get('/task/{task_id}/user/{token}/doing', 'TaskController@taskUserDoing');
    Route::post('/click-task', 'TaskController@taskUserDoing');
    Route::get('/tasks/complete', 'TaskController@tasksUserComplete');
    Route::get('/all-task-click', 'TaskController@userClickTask');
    // Route::match(['get', 'post'], '/click-task/{task_id}/user/{token}', 'TaskController@userClickTask');
    Route::match(['get', 'post'], '/finish-task', 'TaskController@userFinishTask');
    Route::get('/question_answer', 'QuestionAnswerController@questionAnswer');
    Route::get('/question_answer/task/{id}', 'QuestionAnswerController@index');
    Route::get('/edit/question_answer/{question_answer_id}/task/{task_id}', 'QuestionAnswerController@edit');
    // Route::match(['get', 'post'],'/create/question_answer/task/{id}', 'QuestionAnswerController@create');
    // Route::match(['get', 'post'], '/edit/question_answer/{question_answer_id}/task/{task_id}', 'QuestionAnswerController@edit');
    // Route::get('/delete/question_answer/{id}', 'QuestionAnswerController@delete');
    ////////////////////
    Route::get('/banners', 'BannerController@index');
    ////////////////////

    // });
    Route::get('/user/{token}', 'UserController@user');
    Route::get('/home','UserController@home');
    // Route::get($url, 'UserController@home');
    Route::get('/setting', 'UserController@setting');
    Route::post('/send-code-point-for-task', 'TaskController@sendCodePointTask');
});
