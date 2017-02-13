<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'init.request', 'prefix' => 'api/t'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'web'], function () {
            Route::post('user/refresh', 'AuthController@refresh');
            Route::post('user/login', 'AuthController@authenticate');
            Route::post('user/signup', 'AuthController@signup');
            Route::group(['middleware' => 'jwt.api.auth'], function () {
                Route::get('lessons', 'LessonController@index');
                Route::get('lesson', 'LessonController@query');
                Route::post('lesson', 'LessonController@create');
                Route::put('lesson', 'LessonController@update');
                Route::delete('lesson', 'LessonController@delete');
            });
        });
    });
});

//$api = app('Dingo\Api\Routing\Router');

//$api->version('v1', function ($api) {
//    $api->group(['namespace' => 'App\Api\Controllers', 'prefix' => 't/v1'], function ($api) {
//        $api->group(['prefix' => 'web'], function ($api) {
//            $api->post('user/login', 'AuthController@authenticate');
//            $api->post('user/register', 'AuthController@register');
//            $api->group(['middleware' => 'jwt.api.auth'], function ($api) {
////                    $api->get('user/me', 'AuthController@getAuthenticatedUser');
//                $api->get('lessons', 'LessonController@index');
//                $api->get('lessons/{id}', 'LessonController@show');
//                $api->post('lessons', 'LessonController@store');
//            });
//        });
//    });
//});
