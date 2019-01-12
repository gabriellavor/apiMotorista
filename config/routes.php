<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
   
    $routes->get('/api/motoristas', ['controller' => 'Api', 'action' => 'getMotoristas']);
    $routes->post('/api/motoristas', ['controller' => 'Api', 'action' => 'incluirMotorista']);
    $routes->put('/api/motoristas', ['controller' => 'Api', 'action' => 'alterarMotorista']);
    
    $routes->get('/api/tipo-veiculos', ['controller' => 'Api', 'action' => 'getTiposVeiculos']);
    $routes->get('/api/tipo-veiculos/:id', ['controller' => 'Api', 'action' => 'getTiposVeiculo']);
    
    $routes->get('/api/caminhoes-carregados', ['controller' => 'Api', 'action' => 'getCaminhoesCarregados']);
    $routes->get('/api/veiculos-proprios', ['controller' => 'Api', 'action' => 'getVeiculosProprios']);
    $routes->get('/api/origem-destino-por-tipo-veiculo', ['controller' => 'Api', 'action' => 'getOrigemDestinoPorTipo']);
    $routes->get('/api/origem-destino-por-motorista', ['controller' => 'Api', 'action' => 'getOrigemDestinoMotorista']);
    $routes->get('/api/motorista-sem-carga', ['controller' => 'Api', 'action' => 'getMotoristaSemCarga']);

    
    $routes->fallbacks(DashedRoute::class);
});