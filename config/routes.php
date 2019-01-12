<?php
use Cake\Http\Middleware\CsrfProtectionMiddleware;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    // Register scoped middleware for in scopes.
    $routes->registerMiddleware('csrf', new CsrfProtectionMiddleware([
        'httpOnly' => true
    ]));

    $routes->applyMiddleware('csrf');

    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);

    $routes->connect('/api/motoristas', ['controller' => 'Api', 'action' => 'getMotoristas']);
    
    $routes->connect('/api/tipo-veiculos', ['controller' => 'Api', 'action' => 'getTiposVeiculos']);
    $routes->connect('/api/tipo-veiculos/:id', ['controller' => 'Api', 'action' => 'getTiposVeiculo']);
    
    $routes->connect('/api/caminhoes-carregados', ['controller' => 'Api', 'action' => 'getCaminhoesCarregados']);
    $routes->connect('/api/veiculos-proprios', ['controller' => 'Api', 'action' => 'getVeiculosProprios']);
    $routes->connect('/api/origem-destino-por-tipo-veiculo', ['controller' => 'Api', 'action' => 'getOrigemDestinoPorTipo']);
    $routes->connect('/api/origem-destino-por-motorista', ['controller' => 'Api', 'action' => 'getOrigemDestinoMotorista']);
    $routes->connect('/api/motorista-sem-carga', ['controller' => 'Api', 'action' => 'getMotoristaSemCarga']);

    
    $routes->fallbacks(DashedRoute::class);
});