<?php

use App\Http\Controllers\EventsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Spatie\StripeWebhooks\StripeWebhooksController;


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
Route::get('{event}/signup', 'EventsController@signup')->name('events.signup');
Route::resource('admin/role', 'RoleController');
Route::resource('membershipType', 'MembershipTypeController');
Route::resource('events/{event}/tickettypes', 'EventTicketTypesController');
Route::resource('membership', 'MembershipController');
Route::get('membership/success/{id}', 'MembershipController@successMembership')->name('membership.success');
Route::get('membership/failed/{id}', 'MembershipController@failedMembership')->name('membership.failed');
Route::resource('users', 'UserController');
Route::resource('children', 'ChildrenController');
Route::post('children/changeuser', 'ChildrenController@changeuser')->name('children.changeuser');


/* Route::get('/medlemsskap', function() {
    return view('medlemsskap.index');
})->name('medlemsskap.index'); */

Route::get('/spillservere', function() {
    return view('spillservere.index');
})->name('spillservere.index');
Route::resource('test', 'TestController');
Route::get('/betaling', function (Request $request){
    return $request->user()->redirectToBillingPortal('https://medlemdev.digitalungdom.no/medlemsskap');
});
Route::post('deploy', 'DeployController@deploy');