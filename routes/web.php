<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'ImageUploadController@getImages')->name('images');

//view single image

Route::get('/images/{id}', 'ImageUploadController@getImage')->name('image');

//view user images

Route::get('/images', 'ImageUploadController@getMyImages')->name('images');

//crud profile

Route::resource('/profile', 'userdataController');

//post upload

Route::post('/upload', 'ImageUploadController@postUpload')->name('uploadfile');

//form image upload

Route::get('/home', 'HomeController@index')->name('home');
