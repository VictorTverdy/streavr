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
    Route::get('video/language/{id}', 'Backend\VideoController@editVideoLanguage')->where('id', '[0-9]+');
    Route::post('video/language/save', 'Backend\VideoController@saveVideoLanguage');

    /**
     * Video category
     */
    Route::get('video/categories', 'Backend\VideoCategoryController@showCategories');
    Route::post('video/category/save', 'Backend\VideoCategoryController@saveCategory');
    Route::post('video/category/delete/{id}', 'Backend\VideoCategoryController@deleteCategory')->where('id', '[0-9]+');
    Route::get('video/category/edit/{id}', 'Backend\VideoCategoryController@editCategory')->where('id', '[0-9]+');
    Route::post('video/category/reorder', 'Backend\VideoCategoryController@reorderCategory');
    Route::get('video/category/language/{id}', 'Backend\VideoCategoryController@editCategoryLanguage')->where('id', '[0-9]+');
    Route::post('video/category/language/save', 'Backend\VideoCategoryController@saveCategoryLanguage');

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
    Route::get('user/attending/{id}', 'Backend\UserController@attendingUser')->where('id', '[0-9]+');

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
    Route::post('event/activate/{id}', 'Backend\EventController@activateEvent')->where('id', '[0-9]+');
    Route::post('event/inactivate/{id}', 'Backend\EventController@inactivateEvent')->where('id', '[0-9]+');
    Route::get('event/qr-codes/{id}', 'Backend\EventController@qrCodes')->where('id', '[0-9]+');
    Route::get('event/generate-qr-codes-form/{id}', 'Backend\EventController@generateQRCodesForm')->where('id', '[0-9]+');
    Route::post('event/generate-qr-codes/', 'Backend\EventController@generateQRCodes')->where('id', '[0-9]+');
    Route::get('event/send-qr-codes/{id}', 'Backend\EventController@sendQRCodes')->where('id', '[0-9]+');
    Route::get('event/language/{id}', 'Backend\EventController@editEventLanguage')->where('id', '[0-9]+');
    Route::post('event/language/save', 'Backend\EventController@saveEventLanguage');


    /**
     * Attendee
     */
    Route::get('attendee/ticket/{id}', 'Backend\AttendeeController@attendeeTicket')->where('id', '[0-9]+');

    /**
     * Distributors
     */
    Route::get('distributors', 'Backend\DistributorController@index');
    Route::get('distributor/new', 'Backend\DistributorController@newDistributor');
    Route::get('distributor/edit/{id}', 'Backend\DistributorController@editDistributor')->where('id', '[0-9]+');
    Route::post('distributor/save', 'Backend\DistributorController@saveDistributor');
    Route::post('distributor/delete/{id}', 'Backend\DistributorController@deleteDistributor')->where('id', '[0-9]+');
    Route::get('distributors/get_distributors', 'Backend\DistributorController@getDistributors');


    /**
     * Payment Methods
     */
    Route::get('settings/payment-methods', 'Backend\PaymentMethodController@index');

    /**
     * Payment Sources
     */
    Route::get('settings/payment-sources', 'Backend\PaymentSourceController@index');

    /**
     * Payment Statuses
     */
    Route::get('settings/payment-statuses', 'Backend\PaymentStatusController@index');

    /**
     * Registration Statuses
     */
    Route::get('settings/registration-statuses', 'Backend\RegistrationStatusController@index');
    /**
     * Email settings
     */
    Route::get('settings/email-template', 'Backend\SettingsController@email');
    Route::post('settings/email-template/save', 'Backend\SettingsController@emailSave');

    /**
     * Language settings
     */
    Route::get('settings/languages', 'Backend\LanguageController@index');
    Route::get('settings/language/edit/{id}', 'Backend\LanguageController@editLanguage')->where('id', '[a-z]+');
    Route::post('settings/language/save', 'Backend\LanguageController@saveLanguage');


    /**
     * Variable
     */
    Route::get('settings/variables', 'Backend\VariableController@showVariables');
    Route::get('settings/variable/new', 'Backend\VariableController@newVariable');
    Route::get('settings/variable/edit/{id}', 'Backend\VariableController@editVariable')->where('id', '[0-9]+');
    Route::post('settings/variable/save', 'Backend\VariableController@saveVariable');
    Route::post('settings/variable/delete/{id}', 'Backend\VariableController@deleteVariable')->where('id', '[0-9]+');
    Route::get('settings/variable/get_variables', 'Backend\VariableController@getVariables');
    Route::get('settings/variable/language/{id}', 'Backend\VariableController@editVariableLanguage')->where('id', '[0-9]+');
    Route::post('settings/variable/language/save', 'Backend\VariableController@saveVariableLanguage');


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
