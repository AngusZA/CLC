<?php
    namespace CLC\Handlers;
    use CLC\Controllers\UserController;
    use CLC\Controllers\HomeController;
    
    class Router {
        private $routes = [];

        
        public function addRoute($method, $pattern, $controller) {
            $this->routes[] = [
                'method' => $method,
                'pattern' => $pattern,
                'controller' => $controller,
            ];
        }

        
        public function route($requestMethod, $requestUri) {
            foreach ($this->routes as $route) {
                if ($route['method'] === $requestMethod) {
                    $pattern = $this->convertPatternToRegex($route['pattern']);
                    if (preg_match($pattern, $requestUri, $matches)) {
                        array_shift($matches); // Remove the full match
                        $controller = $route['controller'];
                        $this->callControllerMethod($controller, $matches);
                        return;
                    }
                }
            }
            // Handle 404 Not Found
            $this->handleNotFound();
        }

        
        private function convertPatternToRegex($pattern) {
            $pattern = preg_replace('/\//', '\\/', $pattern);
            $pattern = '/^' . $pattern . '$/';
            return $pattern;
        }

        
        private function callControllerMethod($controller, $params) {
            list($class, $method) = explode('@', $controller);
            $class = new $class();
            call_user_func_array([$class, $method], $params);
        }

        
        private function handleNotFound() {
            http_response_code(404);
            echo "404 Not Found";
        }
    }