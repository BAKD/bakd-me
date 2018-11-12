<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| BAKD API v1 Routes
|--------------------------------------------------------------------------
*/

// OAuth
Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');

Route::name('api.')->group(function () {
    // Route::prefix('v1')->group(function () {

        // Guest only API Routes
        Route::middleware(['guest:api', 'throttle'])->group(function () {
            Route::post('login', 'Auth\LoginController@login');
            Route::post('register', 'Auth\RegisterController@register');
            Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
            Route::post('password/reset', 'Auth\ResetPasswordController@reset');
        });

        // Public facing directory pages
        Route::get('bounties', 'Frontend\PageController@bounties')->name('bounties');
        Route::get('campaigns', 'Frontend\PageController@campaigns')->name('campaigns');
        Route::get('members', 'Frontend\PageController@members')->name('members');
        Route::get('u/{id}', 'Frontend\PageController@profile')->name('members.profile');

        // Get the currently logged in user
        Route::get('/user', 'UserController@current')->name('users.current');

        // Get a specific user based on the param passed
        Route::post('/user', 'UserController@show')->name('users.show');
        
        Route::post('/users', 'UserController@all')->name('users.all');
        Route::post('/bounty/random', 'Member\BountyController@random')->name('bounty.random');

        // Auth'd API Routes
        Route::middleware(['auth:api', 'throttle'])->group(function () {
            // Logout
            Route::post('logout', 'Auth\LoginController@logout');

            // User Settings
            Route::patch('settings/profile', 'Settings\ProfileController@update');
            Route::patch('settings/password', 'Settings\PasswordController@update');

            // Bounties
            Route::get('/bounty', 'Member\BountyController@index')->name('bounty.home');
            Route::get('/bounty/{id}', 'Member\BountyController@show')->name('bounty.show');

            // Claims for All Bounties Related to Auth'd User
            Route::get('/claims', 'Member\BountyClaimController@all')->name('claims.all');

            // Claims For Specific Bounties
            Route::get('/bounty/{id}/claims', 'Member\BountyClaimController@index')->name('bounty.claims');
            Route::get('/bounty/{id}/claim', 'Member\BountyClaimController@create')->name('bounty.claim');
            Route::get('/bounty/claim/{id}', 'Member\BountyClaimController@show')->name('bounty.claim.show');
            Route::post('/bounty/{id}/claim', 'Member\BountyClaimController@store')->name('bounty.claim.save');
            Route::post('/bounty/claim/{id}/edit', 'Member\BountyClaimController@update')->name('bounty.claim.edit.save');
            Route::delete('/bounty/claim/{id}/cancel', 'Member\BountyClaimController@destroy')->name('bounty.claim.cancel');
        });

    // });
});