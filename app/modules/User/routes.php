<?php

Route::group(array('module'=>'User','namespace' => 'App\Modules\User\Controllers'), function() {

    Route::get('user','UserController@index');
    Route::get('user/create','UserController@create');
    Route::post('user','UserController@store');
    Route::get('user/user-by-email','UserController@user_by_email');
    
    Route::get('auth/logout','AuthController@logout');
    Route::get('auth/login','AuthController@login');
    Route::post('auth/authenticate','AuthController@authenticate');

});