<?php

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

Route::view('/', 'site.pages.homepage');

Route::view('/login', 'site.pages.homepage');

Auth::routes();


require 'admin.php';
/* code "require 'admin.php'" same as
Route::prefix('/')
        ->group(__DIR__ . '/admin.php');
*/

