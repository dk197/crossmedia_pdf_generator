<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
 });

$router->group(['prefix' => 'generate'], function () use ($router) {
    // localhost:80/generate/pdf
    $router->post('pdf', 'PdfController@pdfGenerieren');
    // localhost:80/generate/pdfTest
    $router->get('pdfTest', 'PdfController@pdfTestGenerieren');
})
?>
