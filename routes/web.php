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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
      return redirect('home');
    });
});

// Authentication Routes
Route::get('login', [
  'as' => 'login',
  'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
  'as' => '',
  'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
  'as' => 'logout',
  'uses' => 'Auth\LoginController@logout'
]);

// Registration Routes
Route::get('register', [
  'as' => 'register',
  'uses' => 'Auth\RegisterController@showRegistrationForm'
]);
Route::post('register', [
  'as' => '',
  'uses' => 'Auth\RegisterController@register'
]);

//Dashboard Routes
Route::get('home','HomeController@dashboard');

// Doctor Detail Routes
Route::post('update-doctor-details','DoctorController@updateDetails');
Route::post('update-doctor-bio','DoctorController@updateDoctorBio');
Route::post('add-doctor-experience','DoctorController@addDoctorExperience');
Route::get('delete-doctor-experience/{exp_id}','DoctorController@deleteDoctorExperience');

//Clinic Detail Routes
Route::post('add-clinic','ClinicController@addClinic');
Route::post('add-clinic-timing','ClinicController@addClinicTiming');
Route::get('delete-clinic-timings/{timing_id}','ClinicController@deleteClinicTimings');