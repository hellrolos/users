<?php
//login functions
Route::get('/','Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//resetPasswordsForgotten
Route::get('password-reset', 'PasswordsController@showForm')->name('passform');
Route::post('passwordreset', 'PasswordsController@sendResetLink')->name('resetlink');
Route::get('reset-password/{token}', 'PasswordsController@showResetForm')->name('resetform');
Route::post('reset-password', 'PasswordsController@resetPassword')->name('resetpass');
//Paginas de navegación
Route::get('dashboard', 'DashboardController@index')->name('dashboard');
//Paginas de Registro
Route::get('register', 'RegisterController@showForm')->name('regform');
Route::post('recording', 'RegisterController@sendInfo')->name('register');
Route::get('record/{token}', 'RegisterController@showRecord')->name('record');
Route::get('register-pdf/{token}', 'RegisterController@showPDFRecord')->name('regpdf');