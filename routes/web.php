<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    $query = http_build_query([
        'client_id' => '3',
        'redirect_uri' => 'http://laravel-passport.app/callback',
        'response_type' => 'code',
        'scope' => ''
    ]);

    return redirect("http://laravel-passport.app/oauth/authorize?$query");

});

Route::get('/callback', function(\Illuminate\Http\Request $request){
    $code = $request->get('code');

    $http = new \GuzzleHttp\Client();

    $response = $http->post('http://laravel-passport.app/oauth/token', [
        'form_params' => [
            'client_id' => '3',
            'client_secret' => 'vmIyZrRgDsD1UAEvkvmoxxOBaH71EVMaL373Louj',
            'redirect_uri' => 'http://laravel-passport.app/callback',
            'code' => $code,
            'grant_type' => 'authorization_code'
        ]
    ]);

    dd(json_decode($response->getBody(), true));
});

Auth::routes();

Route::get('/home', 'HomeController@index');
