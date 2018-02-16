<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'home', function()
{
    $data['datas'] = Data::all();

    return View::make('hello',$data);
}));

Route::get('/read', array('as' => 'read', 'uses' => 'HomeController@read'));

Route::get('/clean', array('as' => 'clean', 'uses' => 'HomeController@clean'));
