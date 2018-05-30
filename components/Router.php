<?php
    class Router {
        private $routes;

        public function __construct() {
            $this->routes = include (ROOT.'/config/routes.php');
        }

        private function getUri() {
            if(!empty($_SERVER['REQUEST_URI'])) {
                return trim($_SERVER['REQUEST_URI'], '/');
            }
        }

        public function run() {
            $uri = $this->getUri();
            foreach ($this->routes as $uriPatern => $path) {
                if(preg_match("-$uriPatern-", $uri)) {
                    $internalUri = preg_replace("-$uriPatern-", $path, $uri);

                    $arr = explode('/', $internalUri);

                    $controllerName = ucfirst(array_shift($arr))."Controller";
                    $actionName = "action".ucfirst(array_shift($arr));

                    include_once (ROOT."/controllers/".$controllerName.".php");

                    $controller = new $controllerName;
                    $result = call_user_func_array(array($controller, $actionName), $arr);
                    if($result) {
                        break;
                    }
                }
            }
        }
    }