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

// add 'api'-prefix for routes
$router->group(['prefix' => 'api'], function () use ($router) {
    // localhost:80/api/register
    $router->post('register', 'AuthController@register');

    $router->post('login', 'AuthController@login');

    // localhost:80/api/test
    $router->get('test', 'AuthController@test');

    // routes that need an authorized user
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        $router->get('/secured', function () {
            return response()->json([
                'message' => 'Hello!',
            ]);
        });
    });
 });



$router->group(['prefix' => 'generate'], function () use ($router) {
    // localhost:80/generate/pdf
    $router->get('pdf', 'PdfController@pdfGenerieren');
})
?>