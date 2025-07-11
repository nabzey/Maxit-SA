<?php 

namespace App\Core;

class Router {
    private static array $routes = [];

    public static function get(string $uri, string $controller, string $action): void
    {
        self::$routes['GET'][$uri] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }

    public static function post(string $uri, string $controller, string $action): void
    {
        self::$routes['POST'][$uri] = [
            'controller' => $controller,
            'action' => $action,
        ];
    }
  public static function resolve(): void {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';
    $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';  
    
    if (substr($uri, 0, 1) !== '/') {
        $uri = '/' . $uri;
    }
    $uri = preg_replace('#/+#', '/', $uri);
    
    if (isset(self::$routes[$method][$uri])) {  
        $route = self::$routes[$method][$uri]; 
        
        if (isset($route['controller'], $route['action'])) {
            $controllerName = $route['controller'];
            $action = $route['action'];
            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $action)) {
                    $controller->$action();
                    return;
                }
            }
        }
    }
    
    http_response_code(404);
    require_once '../templates/404.html.php';
}
}
       


