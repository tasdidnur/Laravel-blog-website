<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\RecycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SettingController;

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
//website
Route::get('/', [WebsiteController::class, 'index']);
Route::get('/about', [WebsiteController::class, 'about']);
Route::get('/contact', [WebsiteController::class, 'contact']);
Route::post('/contactmessage', [WebsiteController::class, 'contactmessage']);
Route::get('/privacy-policy', [WebsiteController::class, 'privacy']);
Route::get('/post/{slug}', [WebsiteController::class, 'post']);
Route::get('/category/{slug}', [WebsiteController::class, 'category']);
Route::get('/tag/{slug}', [WebsiteController::class, 'tag']);
Route::get('/search', [WebsiteController::class, 'search']);
//website
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
//dashboard
Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('dashboard/profile', [DashboardController::class, 'profile']);
Route::post('dashboard/profile/update', [DashboardController::class, 'profileUp']);
//dashboard
//user
Route::get('dashboard/users', [UserController::class, 'index']);
Route::get('dashboard/user/add', [UserController::class, 'add']);
Route::get('dashboard/user/edit/{id}', [UserController::class, 'edit']);
Route::get('dashboard/user/view/{id}', [UserController::class, 'view']);
Route::post('dashboard/user/submit', [UserController::class, 'insert']);
Route::post('dashboard/user/update', [UserController::class, 'update']);
Route::get('dashboard/user/softdelete', [UserController::class, 'softdelete']);
Route::get('dashboard/user/restore', [UserController::class, 'restore']);
Route::post('dashboard/user/delete', [UserController::class, 'delete']);
//user
//pages
Route::get('dashboard/aboutus', [PageController::class, 'aboutUs']);
Route::get('dashboard/contact', [PageController::class, 'contact']);
Route::get('dashboard/privacy-policy', [PageController::class, 'privacy']);
Route::post('dashboard/page/update', [PageController::class, 'update']);
//pages
//post
Route::get('dashboard/posts', [PostController::class, 'index']);
Route::get('dashboard/post/add', [PostController::class, 'add']);
Route::get('dashboard/post/edit/{slug}', [PostController::class, 'edit']);
Route::get('dashboard/post/view/{slug}', [PostController::class, 'view']);
Route::post('dashboard/post/submit', [PostController::class, 'insert']);
Route::post('dashboard/post/update', [PostController::class, 'update']);
Route::get('dashboard/post/satus/{slug}', [PostController::class, 'status']);
Route::post('dashboard/post/softdelete', [PostController::class, 'softdelete']);
Route::post('dashboard/post/restore', [PostController::class, 'restore']);
Route::post('dashboard/post/delete', [PostController::class, 'delete']);
//post
//category
Route::get('dashboard/categorys', [CategoryController::class, 'index']);
Route::get('dashboard/category/add', [CategoryController::class, 'add']);
Route::get('dashboard/category/edit/{slug}', [CategoryController::class, 'edit']);
Route::get('dashboard/category/view/{slug}', [CategoryController::class, 'view']);
Route::post('dashboard/category/submit', [CategoryController::class, 'insert']);
Route::post('dashboard/category/update', [CategoryController::class, 'update']);
Route::post('dashboard/category/softdelete', [CategoryController::class, 'softdelete']);
Route::post('dashboard/category/restore', [CategoryController::class, 'restore']);
Route::post('dashboard/category/delete', [CategoryController::class, 'delete']);
//category
//tag
Route::get('dashboard/tags', [TagController::class, 'index']);
Route::get('dashboard/tag/add', [TagController::class, 'add']);
Route::get('dashboard/tag/edit/{slug}', [TagController::class, 'edit']);
Route::get('dashboard/tag/view/{slug}', [TagController::class, 'view']);
Route::post('dashboard/tag/submit', [TagController::class, 'insert']);
Route::post('dashboard/tag/update', [TagController::class, 'update']);
Route::post('dashboard/tag/softdelete', [TagController::class, 'softdelete']);
Route::post('dashboard/tag/restore', [TagController::class, 'restore']);
Route::post('dashboard/tag/delete', [TagController::class, 'delete']);
//tag

//recycle
Route::get('dashboard/recycle', [RecycleController::class, 'index']);
Route::get('dashboard/recycle/category', [RecycleController::class, 'category']);
Route::get('dashboard/recycle/tag', [RecycleController::class, 'tag']);
Route::get('dashboard/recycle/post', [RecycleController::class, 'post']);
//recycle
//setting
Route::get('dashboard/setting',[SettingController::class, 'index']);
Route::post('dashboard/setting/update',[SettingController::class, 'update']);
Route::get('dashboard/messeges',[SettingController::class, 'message']);
Route::get('dashboard/messege/{slug}',[SettingController::class, 'messageview']);
Route::post('dashboard/deleteMessage',[SettingController::class, 'deleteMessage']);
//setting
//laravel default routes
require __DIR__.'/auth.php';
