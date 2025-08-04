<?php

require __DIR__ . '/../vendor/autoload.php';
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_ROOT', __DIR__);


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    $r->addRoute('GET', '/', 'PageController@home');
    $r->addRoute('GET', '/search', 'PageController@search');
    $r->addRoute('GET', '/buildingWizard', 'PageController@buildWizard');
    $r->addRoute('GET', '/style', 'PageController@style');
    $r->addRoute('POST', '/savePage', 'PageController@savePage');
    $r->addRoute('GET', '/loadComponent', 'ComponentController@loadComponent');
    $r->addRoute('POST', '/saveComponent', 'ComponentController@saveComponent');
    $r->addRoute('POST', '/saveLandigPageComponent', 'ComponentController@saveLandigPageComponent');

    $r->addRoute('GET', '/template', 'PageController@template');
    $r->addRoute('GET', '/component', 'ComponentController@loadComponent');
    $r->addRoute('GET', '/dashboard/gallery', 'PageController@gallery');
    $r->addRoute('GET', '/dashboard/promotion', 'PageController@promotion');
    $r->addRoute('GET', '/dashboard/complaints', 'PageController@complaints');
    $r->addRoute('GET', '/dashboard', 'PageController@dashboard');
    $r->addRoute('GET', '/dashboard/dokumenti', 'PageController@documents');
    $r->addRoute('GET', '/dashboard/dogadjaji', 'PageController@events');
    $r->addRoute('GET', '/dashboard/poruke', 'PageController@chats');
    $r->addRoute('GET', '/dashboard/o-nama', 'PageController@aboutUS');

    $r->addRoute('GET', '/sadmin/style', 'PageController@adminStyle');
    $r->addRoute('GET', '/sadmin/users', 'PageController@userStyle');
    $r->addRoute('GET', '/sadmin/categories', 'PageController@categoryStyle');

    $r->addRoute('POST', '/contact', 'ContactController@create');

    $r->addRoute('POST', '/document', 'DocumentController@newDocument');
    $r->addRoute('GET', '/document', 'DocumentController@list');
    $r->addRoute('PUT', '/document/{id:\d+}', 'DocumentController@update');
    $r->addRoute('DELETE', '/document/{id:\d+}', 'DocumentController@delete');
    $r->addRoute('GET', '/login', 'PageController@login');
    $r->addRoute('POST', '/login', 'AuthController@auth');
    $r->addRoute('GET', '/logout', 'AuthController@logout');

    $r->addRoute('GET', '/events', 'EventController@list');
    $r->addRoute('GET', '/events/{id:\d+}', 'EventController@show');
    $r->addRoute('POST', '/events', 'EventController@create');
    $r->addRoute('PUT', '/events/{id:\d+}', 'EventController@update');
    $r->addRoute('DELETE', '/events/{id:\d+}', 'EventController@delete');
    $r->addRoute('PUT', '/aboutus/{id:\d+}', 'AboutUSController@aboutUs');
    $r->addRoute('POST', '/employees', 'AboutUSController@employees');
    $r->addRoute('PUT', '/employees/{id:\d+}', 'AboutUSController@employees');
    $r->addRoute('DELETE', '/employees/{id:\d+}', 'AboutUSController@employees');

    $r->addRoute('GET', '/gallery', 'GalleryController@list');
    $r->addRoute('GET', '/gallery/{id:\d+}', 'GalleryController@show');
    $r->addRoute('POST', '/gallery', 'GalleryController@newImage');
    $r->addRoute('PUT', '/gallery/{id:\d+}', 'GalleryController@update');
    $r->addRoute('DELETE', '/gallery/{id:\d+}', 'GalleryController@delete');
    $r->addRoute('DELETE', '/contact/{id:\d+}', 'ContactController@delete');



    $r->addRoute('POST', '/users', 'UserController@create');
    $r->addRoute('PUT', '/users/{id:\d+}', 'UserController@update');
    $r->addRoute('DELETE', route: '/users/{id:\d+}', handler: 'UserController@delete');

    $pages = json_decode(
        file_get_contents(__DIR__ . '/assets/data/pages.json'),
        true
    );
    foreach ($pages as $page) {
        if ($page['href'] === '/') {
            continue;
        }
        $r->addRoute('GET', $page['href'], 'PageController@renderJsonPage');
    }


});

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        include PUBLIC_ROOT . '/pages/404.php';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        header('Allow: ' . implode(', ', $routeInfo[1]));
        echo 'Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        [, $handler, $vars] = $routeInfo;
        list($controllerName, $action) = explode('@', $handler, 2);

        $headers = getallheaders();


        $fqcn = "\\App\\Controllers\\{$controllerName}";
        $controller = new $fqcn();
        call_user_func_array([$controller, $action], $vars);
        break;
}