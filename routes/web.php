<?php

use App\Http\Controllers\EventsController;
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

Route::get('/', function () {
    return view('mainpage');
})->name('home');

Auth::routes(['verify' => true]);

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('events', 'EventsController');
Route::get('admin/events', 'EventsController@adminindex')->name('events.admin');
Route::resource('admin/role', 'RoleController');
Route::resource('membershipType', 'MembershipTypeController');


Route::get('/medlemsskap', function() {
    return view('medlemsskap.index');
})->name('medlemsskap.index');

Route::get('/spillservere', function() {
    return view('spillservere.index');
})->name('spillservere.index');
