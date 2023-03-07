<?php


use App\Http\Controllers\Admin\Banner;
use App\Http\Controllers\Admin\News;
use App\Http\Controllers\Admin\Clients;
use App\Http\Controllers\Admin\Roles;
use App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Admin\Dashboard;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::middleware(['web'])->group(function () {




     //banner routes
     Route::get('/banners', [Banner::class, 'index'])->name('banners.list')->middleware(['auth']);
     Route::post('/banners', [Banner::class, 'create'])->name('banners.create')->middleware(['auth']);
     Route::post('/banners/upload', [Banner::class, 'upload'])->name('banners.upload')->middleware(['auth']);
     Route::get('/banners/{id}', [Banner::class, 'by_id'])->name('banners.by_id')->middleware(['auth']);
     Route::delete('/banners/{id}', [Banner::class, 'delete'])->name('banners.delete')->middleware(['auth']);
     Route::put('/banners', [Banner::class, 'update'])->name('banners.update')->middleware(['auth']);

    //News routes
    Route::get('/news', [News::class, 'index'])->name('news.list')->middleware(['auth']);
    Route::post('/news', [News::class, 'create'])->name('news.create')->middleware(['auth']);
    Route::post('/news/upload', [News::class, 'upload'])->name('news.upload')->middleware(['auth']);
    Route::get('/news/{id}', [News::class, 'by_id'])->name('news.by_id')->middleware(['auth']);
    Route::delete('/news/{id}', [News::class, 'delete'])->name('news.delete')->middleware(['auth']);
    Route::put('/news', [News::class, 'update'])->name('news.update')->middleware(['auth']);

          



    Route::get('/', [Dashboard::class, 'index'])->name('index')->middleware(['auth']);
    Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard')->middleware(['auth']);
    //client routes
    Route::get('/clients', [Clients::class, 'index'])->name('clients.list')->middleware(['auth']);
    Route::post('/clients', [Clients::class, 'create'])->name('clients.create')->middleware(['auth']);
    Route::get('/clients/{id}', [Clients::class, 'by_id'])->name('clients.by_id')->middleware(['auth']);
    Route::delete('/clients/{id}', [Clients::class, 'delete'])->name('clients.delete')->middleware(['auth']);
    Route::put('/clients', [Clients::class, 'update'])->name('clients.update')->middleware(['auth']);
    Route::put('/clients/assign-resource', [Clients::class, 'assign_resource'])->name('clients.assign-resource')->middleware(['auth']);

    //Users
    Route::get('/users', [Users::class, 'index'])->name('users.list')->middleware(['auth']);
    Route::post('/users', [Users::class, 'create'])->name('users.create')->middleware(['auth']);
    Route::post('/users/upload', [Users::class, 'upload'])->name('users.upload')->middleware(['auth']);
    Route::get('/users/{id}', [Users::class, 'by_id'])->name('users.by_id')->middleware(['auth']);
    Route::delete('/users/{id}', [Users::class, 'delete'])->name('users.delete')->middleware(['auth']);
    Route::put('/users', [Users::class, 'update'])->name('users.update')->middleware(['auth']);
    Route::put('/users/update-password', [Users::class, 'update_password'])->name('users.update_password')->middleware(['auth']);


    //Payment Methods
    Route::get('/roles', [Roles::class, 'index'])->name('roles.list')->middleware(['auth']);
    Route::post('/roles', [Roles::class, 'create'])->name('roles.create')->middleware(['auth']);
    Route::post('/roles/upload', [Roles::class, 'upload'])->name('roles.upload')->middleware(['auth']);
    Route::get('/roles/{id}', [Roles::class, 'by_id'])->name('roles.by_id')->middleware(['auth']);
    Route::delete('/roles/{id}', [Roles::class, 'delete'])->name('roles.delete')->middleware(['auth']);
    Route::put('/roles', [Roles::class, 'update'])->name('roles.update')->middleware(['auth']);
});




//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


require __DIR__ . '/auth.php';
