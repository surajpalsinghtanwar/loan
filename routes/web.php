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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin_dashboard')->name('admin.dashboard')->middleware(['auth', 'admin']);
Route::resource('profile','ProfileController');
Route::resource('agents','SellerController');
Route::resource('agent','AgentController');
Route::get('agents/profile','SellerController@profile')->name('sellers.profile');
Route::post('/agents/profile_modal', 'SellerController@profile_modal')->name('sellers.profile_modal');
Route::post('/agents/approved', 'SellerController@updateApproved')->name('sellers.approved');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('dashboard','HomeController@dashboard');
Route::get('Accounts','SellerController@accounts')->name('agents.accounts');
Route::get('Accounts-Approved/{id}','SellerController@accountsapproved')->name('accounts.approved');
Route::get('Customer-instolment','AgentController@instolment')->name('agents.instolment');
