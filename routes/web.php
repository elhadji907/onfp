<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\RecueController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\InterneController;

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


Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
    ], function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::get('/profiles/{user}', [ProfileController::class, 'show'])->name('profiles.show');
        Route::get('/profiles/{user}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
        Route::patch('/profiles/{user}', [ProfileController::class, 'update'])->name('profiles.update');

        
        Route::get('postes/create', [PosteController::class, 'create'])->name('postes.create');
        Route::post('postes', [PosteController::class, 'store'])->name('postes.store');
        Route::get('postes/{poste}', [PosteController::class, 'show'])->name('postes.show');
                
        Route::get('courriers/list', [CourrierController::class, 'list'])->name('courriers.list');
        Route::get('courriers/index', [CourrierController::class, 'index'])->name('courriers.index');
        Route::get('courriers/create', [CourrierController::class, 'create'])->name('courriers.create');
        Route::get('/recues/list', [RecueController::class, 'list'])->name('recues.list');
        Route::get('/recues/index', [RecueController::class, 'index'])->name('recues.index');
        Route::get('/departs/list', [DepartController::class, 'list'])->name('departs.list');
        Route::get('/internes/list', [InterneController::class, 'list'])->name('internes.list');
        
        //Route::resource('/courriers', 'App\Http\Controllers\CourrierController');
        Route::resource('/recues', RecueController::class);
        Route::resource('/departs', DepartController::class);
        Route::resource('/internes', InterneController::class);
    });

require __DIR__.'/auth.php';


//gestion des roles par niveau d'autorisation
Route::get('loginfor/{rolename?}', function ($rolename=null) {
    if (!isset($rolename)) {
        return view('auth.loginfor');
    } else {
        $role=App\Models\Role::where('name', $rolename)->first();
        if ($role) {
            $user=$role->users()->first();
            Auth::login($user, true);
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
})->name('loginfor');
