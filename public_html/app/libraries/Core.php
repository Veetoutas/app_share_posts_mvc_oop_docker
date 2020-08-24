<?php

//    App Core Class
//    Creates URL & loads core controller
//    URL FORMAT - /controller/method/params

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];


        public function __construct() {
            $url = $this->getUrl();
            $url1 = array_shift($url);
            // Look in controllers for first value of URL
            if (file_exists(ROOT_DIR . '/app/controllers/' . ucwords($url[0]). '.php')) {
                // If exists, set it as controller
                $this->currentController = ucwords($url[0]);
                // Unset 0 Index
                unset($url[0]);
            }


            // Require the controller
            require_once ROOT_DIR . '/app/controllers/' . $this->currentController . '.php';
            // Instantiate controller class
            $this->currentController = new $this->currentController;

            // Check for second part of URL
            if (isset($url[1])) {
                // Check to see if method exists in controller
                if(method_exists($this->currentController, $url[1])) {
                    $this->currentMethod = $url[1];
                    // Unset 1 index
                    unset($url[1]);
                }
            }
            // Get params
            $this->params = $url ? array_values($url) : [];
            // Call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

        }

        public function getUrl() {
            // $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
            if(isset($_SERVER['REQUEST_URI'])) {

            // rtrim() Removes the desired char from the right side
            $url = rtrim($_SERVER['REQUEST_URI'], '/');

            // Sanitizes URL so that only URL chars remain
            $url = filter_var($url, FILTER_SANITIZE_URL);

            // Separate URL's parameters in array by '/'
            $url = explode('/', $url);
            return  $url;
            };
        }
    }
