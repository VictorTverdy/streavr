<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get video file in video edit page
Route::get('video/uploaded/{id}', 'Api\VideoController@uploadedVideo')->where('id', '[0-9]+');

// Sign up
Route::post('user/signup', 'Api\UserController@signup');

// Login
Route::post('user/login', 'Api\UserController@login');

// Get video categories
Route::post('video/get_categories', 'Api\VideoCategoryController@getCategories');

// Get videos by category and user
Route::get('video/get_videos', 'Api\VideoController@getVideosByCategoryAndUser');

// Get user's favorite videos
Route::get('video/get_favorite_videos', 'Api\VideoController@getFavoriteVideos');

// Get video by id
Route::get('video/get_video', 'Api\VideoController@getVideo')->where('id', '[0-9]+');

// Add favorite to video
Route::post('video/add_favorite', 'Api\VideoController@addFavorite');

// Remove favorite
Route::post('video/remove_favorite', 'Api\VideoController@removeFavorite');

// Get events
Route::get('event/get_events', 'Api\EventController@getEvents');
Route::get('event/get_attendee', 'Api\EventController@getEventUserAttendee');
Route::post('event/add_attendee', 'Api\EventController@addAttendee');
Route::post('event/add_stripe_payment', 'Api\EventController@addStripePayment');

