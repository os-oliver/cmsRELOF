<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Utils/translations.php';
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_ROOT', __DIR__);


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    # UI/page routes + ones in assetes/data/pages.json
    $r->addRoute('GET', '/test', 'PageController@test');
    $r->addRoute('GET', '/kontrolna-tabla/galerija', 'PageController@gallery');
    $r->addRoute('GET', '/kontrolna-tabla/promocija', 'PageController@promotion');
    $r->addRoute('GET', '/kontrolna-tabla/zalbe', 'PageController@complaints');
    $r->addRoute('GET', '/kontrolna-tabla', 'PageController@dashboard');
    $r->addRoute('GET', '/kontrolna-tabla/dokumenti', 'PageController@documents');
    $r->addRoute('GET', '/kontrolna-tabla/dogadjaji', 'PageController@events');
    $r->addRoute('GET', '/kontrolna-tabla/stranice', 'PageController@StaticPageEditor');
    $r->addRoute('GET', '/kontrolna-tabla/poruke', 'PageController@chats');
    $r->addRoute('GET', '/kontrolna-tabla/o-nama', 'PageController@aboutUS');
    $r->addRoute('GET', '/kontrolna-tabla/boje', 'PageController@colors');
    $r->addRoute('GET', '/kontrolna-tabla/{slug:.+}', 'PageController@editorDynamic');

    // Editor utility routes
    $r->addRoute('GET', '/editor/getModal', 'ModalController@get');
    // Endpoint for dynamic editor submissions (AJAX form post)
    $r->addRoute('POST', '/editor/insert', 'ContentController@createFromRequest');
    // Endpoint to list generic elements for the editor (search + pagination)
    $r->addRoute('GET', '/editor/list', 'ContentController@listFromRequest');
    // Get a single generic element (for editing)
    $r->addRoute('GET', '/editor/item', 'ContentController@getItemFromRequest');
    // Delete a generic element
    $r->addRoute('POST', '/editor/delete', 'ContentController@deleteFromRequest');

    $r->addRoute('GET', '/sadmin/stil-stranica', 'PageController@adminStyle');
    $r->addRoute('GET', '/sadmin/korisnici', 'PageController@userStyle');
    $r->addRoute('GET', '/sadmin/kategorije', 'PageController@categoryStyle');

    $r->addRoute('GET', '/pretraga', 'PageController@search');
    $r->addRoute('POST', '/save-component', 'UserUpdateController@saveComponent');

    # API/action routes - should stay in english
    $r->addRoute('GET', '/', 'PageController@home');
    $r->addRoute('GET', '/buildingWizard', 'PageController@buildWizard');
    $r->addRoute('GET', '/style', 'PageController@style');
    $r->addRoute('POST', '/savePage', 'PageController@savePage');
    $r->addRoute('POST', '/deletePage', 'PageController@deletePage');
    $r->addRoute('GET', '/loadComponent', 'ComponentController@loadComponent');
    $r->addRoute('POST', '/saveComponent', 'ComponentController@saveComponent');
    $r->addRoute('POST', '/saveLandigPageComponent', 'ComponentController@saveLandigPageComponent');
    $r->addRoute('GET', '/template', 'PageController@template');
    $r->addRoute('GET', '/component', 'ComponentController@loadComponent');

    $r->addRoute('POST', '/contact', 'ContactController@create');
    $r->addRoute('DELETE', '/contact/{id:\d+}', 'ContactController@delete');

    $r->addRoute('POST', '/document', 'DocumentController@newDocument');
    $r->addRoute('GET', '/document', 'DocumentController@list');
    $r->addRoute('PUT', '/document/{id:\d+}', 'DocumentController@update');
    $r->addRoute('DELETE', '/document/{id:\d+}', 'DocumentController@delete');

    #change this one for URL to be in serbian if needed
    $r->addRoute('GET', '/login', 'PageController@login');

    // ColorsController rute
    $r->addRoute('GET', '/colors', 'ColorsController@index');        // Dohvatanje trenutnih boja
    $r->addRoute('POST', '/colors-change', 'ColorsController@index'); // Čuvanje izmena boja

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

    $r->addRoute('POST', '/users', 'UserController@create');
    $r->addRoute('PUT', '/users/{id:\d+}', 'UserController@update');
    $r->addRoute(httpMethod: 'DELETE', route: '/users/{id:\d+}', handler: 'UserController@delete');
    $r->addRoute('GET', '/sadrzaj', 'PageController@renderElement');


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

    // Also register routes from DB (userdefinedpages) so pages created via UI are routable
    try {
        $db = new \App\Database();
        $pdo = $db->GetPDO();
        $stmt = $pdo->query("SELECT href FROM userdefinedpages WHERE href IS NOT NULL AND href != ''");
        $dbPages = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        foreach ($dbPages as $dbHref) {
            if ($dbHref === '/')
                continue;
            // avoid duplicating routes already added
            $r->addRoute('GET', $dbHref, 'PageController@renderJsonPage');
        }
    } catch (Throwable $e) {
        // ignore DB errors here — fallback to JSON-only routing
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
        call_user_func_array([$controller, $action], array_values($vars));
        break;
}