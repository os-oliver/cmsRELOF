<?php

require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../core/Utils/translations.php';
use FastRoute\RouteCollector;
use function FastRoute\simpleDispatcher;
use App\Database; // Ensure this is available, assuming you have an App\Database class
// use PDO; // Ensure PDO is available

define('PROJECT_ROOT', dirname(__DIR__));
define('PUBLIC_ROOT', __DIR__);


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = rawurldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$dispatcher = simpleDispatcher(function (RouteCollector $r) {
    // Tracking already registered routes to prevent duplicates
    $registeredRoutes = [];

    // Helper function to register a route and mark it as registered
    $registerRoute = function ($method, $route, $handler) use ($r, &$registeredRoutes) {
        $routeKey = $method . ':' . $route;
        if (!isset($registeredRoutes[$routeKey])) {
            $r->addRoute($method, $route, $handler);
            $registeredRoutes[$routeKey] = true;
        }
    };

    # UI/page routes + ones in assetes/data/pages.json
    $registerRoute('GET', '/kontrolna-tabla/galerija', 'PageController@gallery');
    $registerRoute('GET', '/kontrolna-tabla/promocija', 'PageController@promotion');
    $registerRoute('GET', '/kontrolna-tabla/zalbe', 'PageController@complaints');
    $registerRoute('GET', '/kontrolna-tabla', 'PageController@dashboard');
    $registerRoute('GET', '/kontrolna-tabla/dokumenti', 'PageController@documents');
    $registerRoute('GET', '/kontrolna-tabla/dogadjaji', 'PageController@events');
    $registerRoute('GET', '/kontrolna-tabla/stranice', 'PageController@StaticPageEditor');
    $registerRoute('GET', '/kontrolna-tabla/poruke', 'PageController@chats');
    $registerRoute('GET', '/kontrolna-tabla/o-nama', 'PageController@aboutUS');
    $registerRoute('GET', '/kontrolna-tabla/boje', 'PageController@colors');
    // The dynamic route must be registered, but its registration is complex due to the wildcard,
    // so we handle it outside the helper for simplicity if it might overlap.
    // However, for routes with slugs, the check might not be reliable, but let's assume specific ones are checked.
    $r->addRoute('GET', '/kontrolna-tabla/{slug:.+}', 'PageController@editorDynamic');


    // Editor utility routes
    $registerRoute('GET', '/editor/getModal', 'ModalController@get');
    $registerRoute('POST', '/editor/insert', 'ContentController@createFromRequest');
    $registerRoute('GET', '/editor/list', 'ContentController@listFromRequest');
    $registerRoute('GET', '/editor/item', 'ContentController@getItemFromRequest');
    $registerRoute('POST', '/editor/delete', 'ContentController@deleteFromRequest');

    $registerRoute('GET', '/sadmin/stil-stranica', 'PageController@adminStyle');
    $registerRoute('GET', '/sadmin/korisnici', 'PageController@userStyle');
    $registerRoute('GET', '/sadmin/kategorije', 'PageController@categoryStyle');

    $registerRoute('GET', '/pretraga', 'PageController@search');
    $registerRoute('POST', '/save-component', 'UserUpdateController@saveComponent');

    # API/action routes
    $registerRoute('GET', '/', 'PageController@home'); // Registered via helper
    $registerRoute('GET', '/buildingWizard', 'PageController@buildWizard');
    $registerRoute('GET', '/style', 'PageController@style');
    $registerRoute('POST', '/savePage', 'PageController@savePage');
    $registerRoute('POST', '/deletePage', 'PageController@deletePage');
    $registerRoute('GET', '/loadComponent', 'ComponentController@loadComponent');
    $registerRoute('POST', '/saveComponent', 'ComponentController@saveComponent');
    $registerRoute('POST', '/saveLandigPageComponent', 'ComponentController@saveLandigPageComponent');
    $registerRoute('GET', '/template', 'PageController@template');

    // Route with a specific slug template
    $registerRoute(
        'GET',
        '/{templateSlug:informacije-od-javnog-znacaja}',
        'PageController@templateBySlug'
    );
    $registerRoute('GET', '/component', 'ComponentController@loadComponent');

    $registerRoute('POST', '/contact', 'ContactController@create');
    $registerRoute('DELETE', '/contact/{id:\d+}', 'ContactController@delete');

    $registerRoute('POST', '/document', 'DocumentController@newDocument');
    $registerRoute('GET', '/document', 'DocumentController@list');
    $registerRoute('PUT', '/document/{id:\d+}', 'DocumentController@update');
    $registerRoute('DELETE', '/document/{id:\d+}', 'DocumentController@delete');

    $registerRoute('GET', '/login', 'PageController@login'); // Registered via helper

    // ColorsController rute
    $registerRoute('GET', '/colors', 'ColorsController@index');
    $registerRoute('POST', '/colors-change', 'ColorsController@index');

    $registerRoute('POST', '/login', 'AuthController@auth');
    $registerRoute('GET', '/logout', 'AuthController@logout');

    $registerRoute('GET', '/events', 'EventController@list');
    $registerRoute('GET', '/events/{id:\d+}', 'EventController@show');
    $registerRoute('POST', '/events', 'EventController@create');
    $registerRoute('PUT', '/events/{id:\d+}', 'EventController@update');
    $registerRoute('DELETE', '/events/{id:\d+}', 'EventController@delete');

    $registerRoute('PUT', '/aboutus/{id:\d+}', 'AboutUSController@aboutUs');
    $registerRoute('POST', '/employees', 'AboutUSController@employees');
    $registerRoute('POST', '/employees/{id:\d+}', 'AboutUSController@employees');
    $registerRoute('DELETE', '/employees/{id:\d+}', 'AboutUSController@employees');
    $registerRoute('PUT', '/settings', 'AboutUSController@settings');
    $registerRoute('GET', '/settings', 'AboutUSController@settings');
    $registerRoute('POST', '/settings', 'AboutUSController@settings');

    $registerRoute('GET', '/gallery', 'GalleryController@list');
    $registerRoute('GET', '/gallery/{id:\d+}', 'GalleryController@show');
    $registerRoute('POST', '/gallery', 'GalleryController@newImage');
    $registerRoute('POST', '/gallery/{id:\d+}', 'GalleryController@update');
    $registerRoute('PUT', '/gallery/{id:\d+}', 'GalleryController@update');
    $registerRoute('DELETE', '/gallery/{id:\d+}', 'GalleryController@delete');

    $registerRoute('POST', '/users', 'UserController@create');
    $registerRoute('PUT', '/users/{id:\d+}', 'UserController@update');
    $registerRoute('DELETE', '/users/{id:\d+}', 'UserController@delete');
    $registerRoute('GET', '/sadrzaj', 'PageController@renderElement');

    // --- NEW LOGIC: Load pages from JSON file with duplicate check ---
    $pages = json_decode(
        @file_get_contents(__DIR__ . '/assets/data/pages.json'),
        true
    );

    if (!empty($pages) && is_array($pages)) {
        foreach ($pages as $page) {
            if (empty($page['href']) || $page['href'] === '/') {
                continue;
            }

            $routeKey = 'GET:' . $page['href'];

            // Skip if route already registered
            if (isset($registeredRoutes[$routeKey])) {
                continue;
            }

            $r->addRoute('GET', $page['href'], 'PageController@renderJsonPage');
            $registeredRoutes[$routeKey] = true;
        }
    }
    // --- END NEW LOGIC ---

    // Load pages from database
    try {
        $db = new Database(); // Changed to use the imported class
        $pdo = $db->GetPDO();
        $stmt = $pdo->query("SELECT DISTINCT href FROM userdefinedpages WHERE href IS NOT NULL AND href != '' AND href != '/'");
        // Ensure PDO::FETCH_COLUMN is available, using its full name for clarity
        $dbPages = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        foreach ($dbPages as $dbHref) {
            $routeKey = 'GET:' . $dbHref;

            // Skip if route already registered
            if (isset($registeredRoutes[$routeKey])) {
                continue;
            }

            $r->addRoute('GET', $dbHref, 'PageController@renderJsonPage');
            $registeredRoutes[$routeKey] = true;
        }
    } catch (Throwable $e) {
        // Ignore DB errors - fallback to JSON-only routing
        error_log("Error loading routes from database: " . $e->getMessage());
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

        // Assuming App\Controllers namespace is correct
        $fqcn = "\\App\\Controllers\\{$controllerName}";
        $controller = new $fqcn();
        // Use an empty array for arguments if $vars is not available or if it's an empty array
        call_user_func_array([$controller, $action], array_values($vars ?? []));
        break;
}