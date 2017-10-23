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

use Carbon\Carbon;
use App\Entry;

Route::get('/', 'EntryController@index')->name('home');

Route::get('entries', function() {
    return Entry::all();
});

Route::post('/entry/start', 'EntryController@store')->name('start');

Route::post('/entry/{id}/resume', 'EntryController@resume')->name('resume');
Route::post('/entry/{id}/stop', 'EntryController@stop')->name('stop');

Route::get('/templates', function ()
{
    return view('mocks', ['title' => 'BadJob®']);
});

Route::resource('projects', 'ProjectController');