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

//http://10.0.0.244:8080/mongo/getAllTodo
$router->group(['prefix' => 'mongo'],function () use ($router){
    $router->get('getAllTodo','MongoController@getAllTodo');
    $router->post('insertTodo/','MongoController@insertTodo');
   // $router->put('updateTodo/{id}','MongoController@updateTodo');
    $router->post('updateTodo','MongoController@updateTodo');
    $router->post('deleteTodo','MongoController@deleteTodo');
});


