<?php

use App\Models\Post;
use App\Http\Controllers\AuthController;
/** @var \Laravel\Lumen\Routing\Router $router */

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

// $router->get('/getAllPosts','PostController@getAllPost') ;

$router->group(['prefix'=>'api'], function () use ($router){
    $router->get('/getAllPosts','PostController@getAllPosts') ;
});

$router->group(['prefix'=>'api'], function () use ($router){
    $router->post('/addPost','PostController@addPost') ;
});

// $router->post('/addPost','PostController@addPost') ;


////////////////////FOR AUTH JWT/////////////////////////
$router->post('/login', 'AuthController@postLogin');

$router->post('/register', 'AuthController@register');


$router->group([
    'middleware'=>'auth:api'
],
function($router){
    $router->post('chechMe', 'AuthController@chechMe');
}
);


////////////////////////// MAIL ///////////

// $router->post('/send_mail', 'EmailController@send_mail');


// $router->post('/send_mail_to_all_user', 'EmailController@send_mail_to_all_user');

////////////////////////// QUEUE ///////////

$router->post('/send_mail', 'QueueController@send_mail');


$router->post('/send_mail_to_all_user', 'QueueController@send_mail_to_all_user');



