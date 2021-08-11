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
Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->middleware(['auth'])->name('home');
Route::get('/profiles/{user}', 'ProfileController@show')->name('profiles.show');
Route::get('/profiles/{user}/edit', 'ProfileController@edit')->name('profiles.edit');
Route::patch('/profiles/{user}', 'ProfileController@update')->name('profiles.update');


Route::get('/courriers/list', 'CourrierController@list')->name('courriers.list');
Route::get('/recues/list', 'RecueController@list')->name('recues.list');
Route::get('/departs/list', 'DepartController@list')->name('departs.list');
Route::get('/internes/list', 'InterneController@list')->name('internes.list');

Route::resource('/courriers', 'CourrierController');
Route::resource('/recues', 'RecueController');
Route::resource('/departs', 'DepartController');
Route::resource('/internes', 'InterneController');

require __DIR__.'/auth.php';


//gestion des roles par niveau d'autorisation
Route::get('loginfor/{rolename?}',function($rolename=null){
    if(!isset($rolename)){
        return view('auth.loginfor');
    }else{
        $role=App\Models\Role::where('name',$rolename)->first();
        if($role){
            $user=$role->users()->first();
            Auth::login($user,true);
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
    })->name('loginfor');