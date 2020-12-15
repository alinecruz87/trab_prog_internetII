<?php
use Slim\Factory\AppFactory;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

include_once('DiaristaController.php');
include_once('VoluntarioController.php');

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->group('/api/diaristas', function($app){
    $app->get('', 'DiaristaController:listar');
    $app->post('', 'DiaristaController:inserir');

    $app->get('/{id}', 'DiaristaController:buscarPorId');    
    $app->put('/{id}', 'DiaristaController:atualizar');
    $app->delete('/{id}', 'DiaristaController:deletar');
});

$app->group('/api/voluntarios', function($app){
    $app->get('', 'VoluntarioController:listar');
    $app->post('', 'VoluntarioController:inserir');

    $app->get('/{id}', 'VoluntarioController:buscarPorId');    
    $app->put('/{id}', 'VoluntarioController:atualizar');
    $app->delete('/{id}', 'VoluntarioController:deletar');
});

$app->run();
?>