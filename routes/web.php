<?php

use App\User;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

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
Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/search', 'HomeController@search')->name('search');
Route::get('/addComment', 'PictureDetailsController@addComment')->name('addComment');

//Google Login
Route::group(['prefix' => 'auth'], function () {
    Route::get('/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
});
//Controller to profile view
Route::get('/profile_details', 'Profile_DetailsController@details')->name('Pdetails');
//Return the profile of the user assigned to Id
Route::get('/profiles/{id}', 'Profile_DetailsController@profiles')->name('profiles');
//Controller to return the data of the user
Route::post('/profile_edit/{email}','Profile_EditController@edit')->name('Eprofile');
//controller to updating our data
Route::patch('/profile_update','Profile_EditController@update')->name('update.data');
//Controllers to upload images
Route::get('/upload','Upload_ImagesController@upload')->middleware('auth')->name('Upload');
//Controller to picture's details
Route::get('/picture_details/{id}', 'PictureDetailsController@showView')->name('picture_details');

Route::post('/save_image/', 'Upload_ImagesController@save')->name('save');
//controller to delete a picture
Route::delete('/delete_image/{id}', 'PictureDetailsController@delete')->name('delete');
//Route::post('/dropzone/store/{email}','ImageController@store')->name('dropzone.store');

//Assign roles and permissions to Administrator
Route::get('/createRoles', 'roles@createRoles');
Route::get('/darRoles', 'roles@darRoles');