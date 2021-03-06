<?php

use App\User;
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

Route::resource('/posts','PostController');
Route::get('/insert', function () {

    DB::insert("insert into posts(title,content) values (?,?)",array('ttile ','c'));
    return 'Done';
});


Route::get('/read', function () {

    $results = DB::select("select * from  posts where id = ?",array(1));
    return $results;
});


Route::get('/update', function () {

    $results = DB::update("update posts set title ='updated' where id = ?",array(1));
    return $results;
});

Route::get('/delete', function () {

    $results = DB::delete("delete from posts  where id = ?",array(1));
    return $results;
});

Route::get('/readorm', function () {

    $results = \App\Post::all();
    $results = \App\Post::find(2);
    return $results;
});

Route::get('/insertorm', function () {

    $post = new \App\Post();
    $post->title = "nothing ";
    $post->content = "broken";
    return $post->save();
});


Route::get('/createorm', function () {


    return \App\Post::create(array('title'=>'XXX','content'=>'YYY'));
});

Route::get('/updateorm', function () {


    return \App\Post::where('id',2)->update(array('title'=>'updated right now'));
});


Route::get('/deleteorm', function () {


    return \App\Post::where('id',2)->delete();
});

Route::get('/destroyorm', function () {


    return \App\Post::destroy([4]);
});

Route::get('/softorm', function () {


    return \App\Post::destroy([4]);
});

Route::get('/retrievesoftorm', function () {


    return \App\Post::onlyTrashed()->get();
});




Route::get('/restoreorm', function () {


    return \App\Post::onlyTrashed()->restore();
});

Route::get('/forcedelete', function () {


    return \App\Post::onlyTrashed()->forceDelete();
});


//Relation ships
Route::get('/user/{id}/post', function ($id) {

    return User::find($id)->post;
});


//Inverse 1 to 1 relationships

Route::get('/post/{id}/user', function ($id) {

    return \App\Post::find($id)->user;
});

//Inverse 1 to many relationships

Route::get('/user/{id}/post', function ($id) {

    return User::find($id)->posts;
});

//many to many relationships

Route::get('/user/{id}/role', function ($id) {

    return User::find($id)->roles;
});

//many to many relationships

Route::get('/role/{id}/user', function ($id) {

    return \App\Role::find($id)->users;
});


//Querying relationships

Route::get('/role/pivot', function () {
    $roles = \App\Role::find(1);
    foreach ($roles->users as $user){
        return $user->pivot;
    }
});

//has many through relationships
Route::get('/country/hmt', function () {
    $countries = \App\Country::find(1);
    foreach ($countries->posts as $post){
        return $post->title;
    }
});

//polymorphism relationships
Route::get('/user/photos', function () {
    $user = \App\User::find(1);
    foreach ($user->photos as $photo){
        return $photo->path;
    }
});

//polymorphism relationships
Route::get('/user/photos', function () {
    $user = \App\User::find(1);
    foreach ($user->photos as $photo){
        return $photo->path;
    }
});

//polymorphism relationships
Route::get('/post/photos', function () {
    $post = \App\Post::find(1);
    foreach ($post->photos as $photo){
        return $photo->path;
    }
});

//polymorphism relationships inverse
Route::get('/photos/{id}', function ($id) {
    $photo = \App\Photo::find($id);
    return $photo->imageable;
});

//polymorphism relationships many to many
Route::get('/tags/{id}', function ($id) {
    $tag = \App\Tag::find($id);
    return $tag->videos;
});

//polymorphism relationships many to many
Route::get('/videos/{id}', function ($id) {
    $video = \App\Video::find($id);
    return $video->tags;
});

//polymorphism relationships many to many
Route::get('/post/tag', function () {
    $video = \App\Post::find(1);
    return $video->tags;
});





