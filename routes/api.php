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

        // Realtime Posts
        Route::get('posts', 'PostController@all')->name('posts.all');
        Route::post('posts', 'PostController@create')->name('posts.create');
        Route::post('posts/ping', 'PostController@ping')->name('posts.ping');

        // Public facing directory pages
        Route::get('bounties', 'Frontend\PageController@bounties')->name('bounties');
        Route::get('campaigns', 'Frontend\PageController@campaigns')->name('campaigns');
        Route::get('members', 'Frontend\PageController@members')->name('members');
        Route::get('u/{id}', 'Frontend\PageController@profile')->name('members.profile');
        Route::get('u/{id}/posts', 'UserController@posts')->name('members.posts');

        // Get the currently logged in user
        Route::get('/user', 'UserController@current')->name('users.current');

        // Get a specific user based on the param passed
        Route::post('/user', 'UserController@show')->name('users.show');
        
        Route::post('/users', 'UserController@all')->name('users.all');
        Route::post('/users/random', 'UserController@random')->name('users.random');
        Route::post('/bounty/random', 'Member\BountyController@random')->name('bounty.random');


        // Auth'd API Routes
        Route::middleware(['auth:api', 'throttle'])->group(function () {
            // Logout
            Route::post('logout', 'Auth\LoginController@logout');

            // Uploads
            Route::post('/upload/avatar', 'UploadController@avatar');
            Route::post('/upload/cover', 'UploadController@cover');

            // User Settings
            Route::patch('/settings/profile', 'Settings\ProfileController@update');
            Route::patch('/settings/password', 'Settings\PasswordController@update');

            // Follow/Unfollow
            Route::post('/user/follow', 'UserController@follow');
            Route::post('/user/unfollow', 'UserController@unfollow');

            // Bounties
            Route::get('/bounty/dashboard', 'Member\BountyController@dashboard')->name('bounty.dashboard');
            Route::get('/bounty/claims/stats', 'Member\BountyClaimController@stats')->name('bounty.stats');
            Route::get('/bounty/claims/pending', 'Member\BountyClaimController@pending')->name('bounty.claims.pending');
            Route::get('/bounty/claims/approved', 'Member\BountyClaimController@approved')->name('bounty.claims.approved');
            Route::get('/bounty/claims/rejected', 'Member\BountyClaimController@rejected')->name('bounty.claims.rejected');
            Route::get('/bounty/{id}', 'Member\BountyController@show')->name('bounty.show');
            Route::get('/bounty/{id}/stats', 'Member\BountyController@stats')->name('bounty.stats');
            Route::get('/bounty/{id}/claims', 'Member\BountyClaimController@bounty')->name('bounty.claim.user_bounty');
            Route::get('/bounty/claim/{id}', 'Member\BountyClaimController@show')->name('bounty.claim.show');
            Route::post('/bounty/{id}/claim', 'Member\BountyClaimController@store')->name('bounty.claim.save');
            Route::post('/bounty/claim/{id}/edit', 'Member\BountyClaimController@update')->name('bounty.claim.edit.save');
            Route::delete('/bounty/claim/{id}/cancel', 'Member\BountyClaimController@destroy')->name('bounty.claim.cancel');
        });

    // });
});