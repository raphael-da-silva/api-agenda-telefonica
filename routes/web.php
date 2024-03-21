<?php

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

// Página de entrada com view / Teste PHP - Raphael da Silva
$router->get('/', function () use ($router) {
    return view('home');
});

// Insert dos dados
$router->post('/agenda', 'AgendaController@post');

// Update dos dados
$router->put('/agenda/{id}', 'AgendaController@update');

// Deletar via nome
$router->delete('/agenda/{name}', 'AgendaController@delete');

// Listagem de nomes
$router->get('/agenda/relatorio', function() use ($router){
    
});