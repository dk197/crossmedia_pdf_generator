<?php

use Illuminate\Support\Facades\Auth;

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
    $router->post('register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
    $router->get('/getvcard/{id}', 'PdfController@getDynamicVcard');

    $router->group(['middleware' => 'auth:api', 'prefix' => 'secured'], function () use ($router) {
        $router->get('/getcurrentuser', 'AuthController@getCurrentUser');
        $router->get('/getvcards', 'VCardController@getUsersVCards');
        $router->post('editvcard', 'VCardController@editVcard');
        $router->get('deletevcard/{id}', 'VCardController@deleteVCard');
    });
 });

$router->group(['prefix' => 'generate'], function () use ($router) {
    $router->post('pdf', 'PdfController@pdfGenerieren');
})
?>
