<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DefinitionController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\WordTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
//Route::get('/users/{id}',
//    [\App\Http\Controllers\UserController::class, 'show']
//)->name('users.show');
/**
 * Routes for Ratings
 * GET POST UPDATE DESTROY INFO
 */
//Route::get('/ratings',
//    [\App\Http\Controllers\RatingController::class, 'index']
//)->name('ratings.index');
//
//// http(s)://domain.com/ratings/2
//Route::get('/ratings/{id}',
//    [\App\Http\Controllers\RatingController::class, 'show']
//)->name('ratings.show');


/* --------------------------------------------- */
Route::get('/home', [StaticPageController::class, 'home'])->name('static.home');
Route::get('/privacy', [StaticPageController::class, 'privacyPolicy'])->name('static.privacy');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('static.contact');
Route::get('/color', [StaticPageController::class, 'color'])->name('static.color');
Route::get('/icons', [StaticPageController::class, 'icons'])->name('static.icons');
Route::get('/terms-and-conditions', [StaticPageController::class, 'conditions'])->name('static.terms-and-conditions');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//user router
//Route::resource('user', UserController::class)->except(['show', 'edit', 'update', 'delete']);
//Route::get('/users',
//    [\App\Http\Controllers\UserController::class, 'index']
//)->name('users.index');

// http(s)://domain.com/ratings/2
//route for word
Route::middleware('auth')->group(function () {
    Route::get('/words/add', [WordController::class, 'create'])->name('words.add');
    Route::get('/words/create', [WordController::class, 'create'])->name('words.create');
    Route::get('/words/{word}/edit', [WordController::class, 'edit'])->name('words.edit');
    Route::get('/words/{word}/delete', [WordController::class, 'delete'])->name('words.delete');
    Route::post('/words', [WordController::class, 'store'])->name('words.store');
    Route::delete('/words/{word}', [WordController::class, 'destroy'])->name('words.destroy');
    Route::patch('/words/{word}', [WordController::class, 'update'])->name('words.update.patch');
    Route::put('/words/{word}', [WordController::class, 'update'])->name('words.update.put');
});
Route::get('/words/{word}', [WordController::class, 'show'])->name('words.show');
Route::get('/words', [WordController::class, 'index'])->name('words.index');
/**
 * Routes for Word Types
 *
 */
Route::group(['middleware' => ['auth']], function () {
    Route::resource('wordtypes', WordTypeController::class)->except(['index', 'show', 'edit']);
// 单独为index和show方法创建路由
    Route::get('/wordtypes', [WordTypeController::class, 'index'])->name('wordtypes.index');
    Route::get('/wordtypes/{wordType}', [WordTypeController::class, 'show'])->name('wordtypes.show');
    Route::get('/wordtypes/{wordType}/edit', [WordTypeController::class, 'edit'])->name('wordtypes.edit');

// 为delete方法创建单独的路由
    Route::get('/wordtypes/{wordType}/delete', [WordTypeController::class, 'delete'])->name('wordtypes.delete');
    Route::delete('/wordtypes/{wordType}', [WordTypeController::class, 'destroy'])->name('wordtypes.destroy');
});
//Route::delete('/wordtypes/{wordType}', [WordController::class, 'destroy'])->name('wordtypes.destroy');
//Route::patch('/wordtypes/{wordType}', [WordController::class, 'update'])->name('wordtypes.update.patch');
//Route::put('/wordtypes/{wordType}', [WordController::class, 'update'])->name('wordtypes.update.put');

//Route::get('/wordtypes/create', [WordTypeController::class, 'create'])->name('wordtypes.create');
//Route::resource('wordtypes', WordTypeController::class)->except(['index','show']);
//Route::get('/wordtypes/{wordtype}/delete',[WordTypeController::class,'delete'])->name('wordtypes.delete');
//Route::patch('/wordtypes/{wordtype}', [WordTypeController::class, 'update'])->name('wordtypes.update.patch');
//Route::get('/wordtypes',
//    [\App\Http\Controllers\WordTypeController::class, 'index']
//)->name('wordtypes.index');
//
//Route::get('/wordtypes/{wordType}',
//    [\App\Http\Controllers\WordTypeController::class, 'show']
//)->name('wordtypes.show');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
//    Route::resource('users', UserController::class);
});


//route for user
Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/add', [UserController::class, 'create'])->name('users.add');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('users.delete');

    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update.patch');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update.put');
});
//route for definition
//Route::get('/definitions', [DefinitionController::class, 'index'])->name('definitions.index');
//Route::get('/definitions/add', [DefinitionController::class, 'create'])->name('definitions.add');
//Route::get('/definitions/create', [DefinitionController::class, 'create'])->name('definitions.create');
//
//Route::get('/definitions/{definition}', [DefinitionController::class, 'show'])->name('definitions.show');
//Route::get('/definitions/{definition}/edit', [DefinitionController::class, 'edit'])->name('definitions.edit');
//Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])->name('definitions.delete');
//
//Route::post('/definitions', [DefinitionController::class, 'store'])->name('definitions.store');
//Route::delete('/definitions/{definition}', [DefinitionController::class, 'destroy'])->name('definitions.destroy');
//Route::patch('/definitions/{definition}', [DefinitionController::class, 'update'])->name('definitions.update.patch');
//Route::put('/definitions/{definition}', [DefinitionController::class, 'update'])->name('definitions.update.put');


Route::middleware('auth')->group(function () {
    Route::resource('definitions', DefinitionController::class)->except(['index', 'show']);
    Route::get('/definitions/{definition}/add', [DefinitionController::class, 'add'])->name('definitions.add');
    Route::post('/definitions/{definition}/add', [DefinitionController::class, 'store'])->name('definitions_add.store');
    Route::get('/definitions/{definition}/delete', [DefinitionController::class, 'delete'])->name('definitions.delete');
    Route::patch('/definitions/{definition}', [DefinitionController::class, 'update'])->name('definitions.update.patch');
});
Route::resource('definitions', DefinitionController::class)->only(['index', 'show']);

// GET: Index, Add/Create
//Route::get('/ratings', [RatingController::class, 'index'])->name('ratings.index');

//Route::get('/ratings/create', [RatingController::class, 'create'])->name('ratings.create');
//
//// GET: Show, Edit, Delete {all require an "ID", ie "rating"} - Delete is NON-standard
//Route::get('/ratings/{rating}', [RatingController::class, 'show'])->name('ratings.show');
//Route::get('/ratings/{rating}/edit', [RatingController::class, 'edit'])->name('ratings.edit');
//Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');
//Route::resource('ratings', RatingController::class);


Route::middleware('auth')->group(function () {

    Route::get('/ratings/add', [RatingController::class, 'create'])->name('ratings.add');
    Route::resource('ratings', RatingController::class)->except(['index', 'show']);
    Route::get('/ratings/{rating}/delete', [RatingController::class, 'delete'])->name('ratings.delete');
    Route::patch('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update.patch');
});
Route::resource('ratings', RatingController::class)->only(['index', 'show']);

// Action routes
// POST: stores the rating
// PATCH/PUT: update the rating details
// DELETE: Destroys the rating
//Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');
//Route::delete('/ratings/{rating}', [RatingController::class, 'destroy'])->name('ratings.destroy');
//Route::patch('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update.patch');
//Route::put('/ratings/{rating}', [RatingController::class, 'update'])->name('ratings.update.put');
//可以简写为以下：
//Route::resource('ratings',RatingController::class);
//Route::get('ratings/{rating}/delete',[RatingController::class,'delete'])->name('ratings.delete');

require __DIR__ . '/auth.php';
Route::get('/force-styles', function () {
    return view('force-styles');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
