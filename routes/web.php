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
// Guest Routes
Route::get('/', function () {
    $posts = \App\Post::latest()->simplePaginate(5);
    return view('guest.index', compact('posts'));
});
Route::get('/post/{id}/view', function ($id) {
    $post = \App\Post::find($id);
    $comments = $post->comment;
    return view('guest.postShow', compact(['post', 'comments']));
})->name('postShow');
Route::get('/about', 'UserController@about');
Route::get('/blogs', 'UserController@blogs');
Route::get('/projects', 'UserController@projects');
Route::get('/login', 'UserController@showLogin')->name('login.show');
Route::post('/login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/register', 'UserController@showRegister');
Route::post('/register', 'UserController@register');
Route::get('/verify/{token}', 'UserController@verify');

//User Routes
Route::post('/comment', 'CommentController@create')->middleware('userAuth');
Route::get('/comment/{id}/delete', 'CommentController@delete')->middleware('userAuth');

// Admin Routes
Route::group(['prefix'=> 'admin'], function(){
    Route::group(['middleware' => 'adminAuth'], function(){
        Route::get('/dashboard', 'AdminDashboardController@index')->name('admin.dashboard');
        Route::get('/users', 'AdminDashboardController@showUser')->name('admin.user');
        Route::post('/roleChange', 'AdminDashboardController@changeRole');
        Route::get('/{id}/disable', 'AdminDashboardController@disable');
        Route::get('/{id}/enable', 'AdminDashboardController@enable');
        Route::get('/post/create', 'AdminDashboardController@createPostShow');
        Route::post('/post/create', 'AdminDashboardController@createPost');
        Route::get('/posts', 'AdminDashboardController@showPost');
        Route::get('/posts/{id}/edit', 'AdminDashboardController@showEditPost')->name('admin.postEditShow');
        Route::post('/posts/{id}/edit', 'AdminDashboardController@editPost')->name('admin.postEdit');
        Route::get('/posts/{id}/delete', 'AdminDashboardController@deletePost')->name('admin.postDelete');
        Route::get('/imageUpload', 'AdminDashboardController@showImage');
        Route::post('/imageUpload', 'AdminDashboardController@uploadImage');
        Route::get('/imageUpdate/{id}', 'AdminDashboardController@showOneImage');
        Route::post('/imageUpdate/{id}', 'AdminDashboardController@updateImage');
    });
});
