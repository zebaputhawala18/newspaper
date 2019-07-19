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
Route::group([
    'namespace' => 'Admin',
    'prefix'    => 'admin',
    'as'        => 'admin.'
],
    function(){
        /*
         * Admin Authentication
         * */
        Route::group([
            'namespace' => 'Auth',
        ],
            function(){
                Route::get('login', 'LoginController@showLoginForm')->name('login');
                Route::post('login', 'LoginController@login')->name('login');
                Route::post('logout', 'LoginController@logout')->name('logout');
                /*
                 * Registration Routes
                 * */
                Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('register', 'RegisterController@register')->name('register');
                /*
                 * Password Reset Routes
                 * */
                Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
                /*
                 * Email Verification Routes
                 * */
                Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
                Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
                Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
            }
        );
        /*
         * Dashboard
         * */
        Route::get('/','MainController@index')->name('dashboard');
        /*
         * Users Management
         * */
        Route::group([
            'prefix'    => 'user',
            'as'        => 'user.'
        ],
            function(){
                Route::get('create', 'UsersController@create')->name('create');
                Route::post('store', 'UsersController@store')->name('store');
                Route::get('edit/{user_id}', 'UsersController@edit')->name('edit');
                Route::post('update/{user_id}', 'UsersController@update')->name('update');
                Route::post('destroy/{user_id}', 'UsersController@destroy')->name('destroy');
                Route::post('update/status/{user_id}', 'UsersController@updateStatus')->name('updateStatus');
            }
        );
        /*
         * News Management
         * */
        Route::group([
            'prefix'    => 'news',
            'as'        => 'news.'
        ],
            function(){
                Route::get('create', 'NewsController@create')->name('create');
                Route::post('store', 'NewsController@store')->name('store');
                Route::get('edit/{user_id}', 'NewsController@edit')->name('edit');
                Route::post('update/{user_id}', 'NewsController@update')->name('update');
                Route::post('destroy/{user_id}', 'NewsController@destroy')->name('destroy');
                Route::post('update/status/{user_id}', 'NewsController@updateStatus')->name('updateStatus');
            }
        );
        /*
         * Category Management
         * */
        Route::group([
            'prefix'    => 'category',
            'as'        => 'category.'
        ],
            function(){
                Route::get('create', 'CategoriesController@create')->name('create');
                Route::post('store', 'CategoriesController@store')->name('store');
                Route::get('edit/{user_id}', 'CategoriesController@edit')->name('edit');
                Route::post('update/{user_id}', 'CategoriesController@update')->name('update');
                Route::post('destroy/{user_id}', 'CategoriesController@destroy')->name('destroy');
                Route::post('update/status/{user_id}', 'CategoriesController@updateStatus')->name('updateStatus');
            }
        );
        /*
         * Tags Management
         * */
        Route::group([
            'prefix'    => 'tag',
            'as'        => 'tag.'
        ],
            function(){
                Route::get('create', 'TagsController@create')->name('create');
                Route::post('store', 'TagsController@store')->name('store');
                Route::get('edit/{user_id}', 'TagsController@edit')->name('edit');
                Route::post('update/{user_id}', 'TagsController@update')->name('update');
                Route::post('destroy/{user_id}', 'TagsController@destroy')->name('destroy');
                Route::post('update/status/{user_id}', 'TagsController@updateStatus')->name('updateStatus');
            }
        );
    }
);
Route::group([
    'namespace' => 'Front',
    'as'        => 'front.'
],
    function(){
        /*
         * Users Authentication
         * */
        Route::group([
            'namespace' => 'Auth',
        ],
            function(){
                Route::get('login', 'LoginController@showLoginForm')->name('login');
                Route::post('login', 'LoginController@login')->name('login');
                Route::post('logout', 'LoginController@logout')->name('logout');
                /*
                 * Registration Routes
                 * */
                Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
                Route::post('register', 'RegisterController@register')->name('register');
                /*
                 * Password Reset Routes
                 * */
                Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
                Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
                Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
                /*
                 * Email Verification Routes
                 * */
                Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
                Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
                Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
            }
        );
        Route::get('/','MainController@index')->name('home');
        Route::get('/category/{category_slug}','MainController@newsCategory')->name('newsCategory');
        Route::get('/tag/{tag_slug}','MainController@newsTag')->name('newsTag');
        Route::get('/news/{news_slug}','MainController@news')->name('news');
    }
);
