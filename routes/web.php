<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->get('/api', function () {
	$app = [
		'status' => 'success',
		'message' => 'Hello Brother'
	];
    return response()->json($app);
});

$router->group(['prefix' => 'api/'], function ($router) {
	$router->post('login/','UserController@authenticate');
	$router->post('register/','UserController@register');

	$router->group(['middleware' => 'auth'], function ($router) {
		// User
		$router->get('user/','UserController@current_user');

		// Phonebook
		$router->get('phone-number/{number}','PhonebookController@show');
		$router->post('phone-number/','PhonebookController@store');

		// Review
		$router->get('review/{number}','ReviewController@show');
		$router->post('review/','ReviewController@store');
		
		// Block
		$router->post('block/','BlockController@store');
		
		// Report
		$router->post('report/','ReportController@store');
	});
});
