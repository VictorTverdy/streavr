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

Route::middleware(['auth'])->group(function () {
    /**
     * Dashboard
     */
    Route::get('/', 'Backend\DashboardController@show');

    /**
     * Video
     */
    Route::get('videos', 'Backend\VideoController@showVideos');
    Route::get('video/new', 'Backend\VideoController@newVideo');
    Route::get('video/edit/{id}', 'Backend\VideoController@editVideo')->where('id', '[0-9]+');
    Route::post('video/save', 'Backend\VideoController@saveVideo');
    Route::post('video/delete/{id}', 'Backend\VideoController@deleteVideo')->where('id', '[0-9]+');
    Route::post('video/upload', 'Backend\VideoController@uploadVideo');
    Route::get('video/delete_video', 'Backend\VideoController@deleteVideoFile');
    Route::get('video/get_videos_by_user', 'Backend\VideoController@getVideosByUser');

    /**
     * Video category
     */
    Route::get('video/categories', 'Backend\VideoCategoryController@showCategories');
    Route::post('video/category/save', 'Backend\VideoCategoryController@saveCategory');
    Route::post('video/category/delete/{id}', 'Backend\VideoCategoryController@deleteCategory')->where('id', '[0-9]+');
    Route::get('video/category/edit/{id}', 'Backend\VideoCategoryController@editCategory')->where('id', '[0-9]+');
    Route::post('video/category/reorder', 'Backend\VideoCategoryController@reorderCategory');

    /**
     * User
     */
    Route::get('user/new', 'Backend\UserController@newUser');
    Route::post('user/save', 'Backend\UserController@saveUser');
    Route::get('users', 'Backend\UserController@showUsers');
    Route::get('user/get_users', 'Backend\UserController@getUsers');
    Route::get('user/edit/{id}', 'Backend\UserController@editUser')->where('id', '[0-9]+');
    Route::post('user/delete/{id}', 'Backend\UserController@deleteUser')->where('id', '[0-9]+');
    Route::get('user/profile', 'Backend\UserController@userProfile');

    /**
     * Event
     */
    Route::get('events', 'Backend\EventController@showEvents');
    Route::get('event/new', 'Backend\EventController@newEvent');
    Route::get('event/edit/{id}', 'Backend\EventController@editEvent')->where('id', '[0-9]+');
    Route::post('event/save', 'Backend\EventController@saveEvent');
    Route::post('event/delete/{id}', 'Backend\EventController@deleteEvent')->where('id', '[0-9]+');
    Route::get('event/get_events', 'Backend\EventController@getEvents');
    Route::get('event/attendees/{id}', 'Backend\EventController@attendeesEvent')->where('id', '[0-9]+');
    Route::get('event/get_attendees/{id}', 'Backend\EventController@getAttendees')->where('id', '[0-9]+');

});



Route::group([], function () {
    // Authentication Routes...
    Route::get('login', 'Backend\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Backend\Auth\LoginController@login');
    Route::get('logout', 'Backend\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'Backend\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Backend\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Backend\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Backend\Auth\ResetPasswordController@reset');
});
