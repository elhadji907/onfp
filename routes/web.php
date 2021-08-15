<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\CourrierController;
use App\Http\Controllers\RecueController;
use App\Http\Controllers\DepartController;
use App\Http\Controllers\InterneController;
use App\Http\Controllers\CommentController;

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

        
        Route::get('/postes/create', [PosteController::class, 'create'])->name('postes.create');
        Route::post('/postes', [PosteController::class, 'store'])->name('postes.store');
        Route::get('/postes/{poste}', [PosteController::class, 'show'])->name('postes.show');
        Route::get('/showFromNotification/{courrier}/{notification}', [CourrierController::class, 'showFromNotification'])->name('courriers.showFromNotification');
                
        Route::get('/courriers/list', [CourrierController::class, 'list'])->name('courriers.list');
        Route::get('/recues/list', [RecueController::class, 'list'])->name('recues.list');
        Route::get('/departs/list', [DepartController::class, 'list'])->name('departs.list');
        Route::get('/internes/list', [InterneController::class, 'list'])->name('internes.list');
        
        Route::post('/comments/{courrier}', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/commentReply/{comment}', [CommentController::class, 'storeCommentReply'])->name('comments.storeReply');
        
        Route::resource('/courriers', CourrierController::class);
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
        //$role=App\Models\Role::where('name', $rolename)->first();

        $role = \App\Models\Role::findByName($rolename);
        
        if ($role) {
            $user=$role->users()->first();
            Auth::login($user, true);
            return redirect()->route('home');
        }
    }
    return redirect()->route('login');
})->name('loginfor');
