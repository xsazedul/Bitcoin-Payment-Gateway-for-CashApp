<?php

namespace App\Core;

class Router {
    private $routes = [];

    public function add($method, $path, $handler) {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch($method, $uri) {
        $uri = parse_url($uri, PHP_URL_PATH);
        
        // Handle subdirectory installations automatically
        $scriptPath = str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);
        if (!empty($scriptPath) && strpos($uri, $scriptPath) === 0) {
            $uri = substr($uri, strlen($scriptPath));
        }
        
        if (empty($uri)) $uri = '/';

        foreach ($this->routes as $route) {
            $pattern = str_replace('/', '\/', $route['path']);
            $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_\-]+)', $pattern);
            $pattern = '/^' . $pattern . '$/';

            if ($route['method'] === strtoupper($method) && preg_match($pattern, $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                return $this->callHandler($route['handler'], $params);
            }
        }
        
        http_response_code(404);
        echo "404 Not Found";
    }

    private function callHandler($handler, $params) {
        list($controller, $method) = explode('@', $handler);
        $controllerClass = "App\\Controllers\\$controller";
        $instance = new $controllerClass();
        return call_user_func_array([$instance, $method], [$params]);
    }
}
