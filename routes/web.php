<?php

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

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});
$groupData = [
  'namespace' => 'Blog\Admin',
  'prefix' => 'admin/blog',
];
Route::get('/admin/blog/posts/{post}/restore', 'Blog\Admin\PostController@restore')->name('blog.admin.posts.restore');
Route::get('/admin/blog/posts/export', 'Blog\Admin\PostController@exportPosts')->name('blog.admin.posts.export');
Route::group($groupData, function (){
  $methods = ['index', 'edit', 'store', 'update', 'create'];
  // BlogCategory
  Route::resource('categories', 'CategoryController')
      ->only($methods)
      ->names('blog.admin.categories');

  // BlogPost
  Route::resource('posts', 'PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});

Route::group(['prefix' => 'digging_deeper'], function (){
   Route::get('collections', 'DiggingDeeperController@collections')
       ->name('digging_deeper.collections');
});
