<?php

namespace VFramework\Libraries;

use VFramework\Controllers\Posts;
use VFramework\Models\User;
use VFramework\Tools\Validator;

class Core
{
    public const CONTROLLERS_DIR = '/app/Controllers/';
    /**
     * @var mixed|string
     */
    protected $currentController = 'Pages';
    /**
     * @var mixed|string
     */
    protected $currentMethod = 'index';
    /**
     * @var array|false|string[]
     */
    protected $params = [];

    public function __construct()
    {
        // Get the URL
        $url = $this->getUrl();
        $urlShifted = array_shift($url);
        // Set Controller based on URL
        $url = $this->setController($url);
        // Name the Class to which the URL is targeting
        $className = 'VFramework\\Controllers\\' . ucfirst($this->currentController);
        // Instantiate the class
        $this->currentController = new $className(
            new Validator(new User())
        );
        // Set the Method based on URL
        $url = $this->setMethod($url);
        // Get params
        $this->params = $url ? array_values($url) : [];
        // Call a callback with array of params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    /**
     * @return false|string[]
     */
    public function getUrl()
    {
        // $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
        if (isset($_SERVER['REQUEST_URI'])) {
            // rtrim() Removes the desired char from the right side
            $url = rtrim($_SERVER['REQUEST_URI'], '/');
            // Sanitizes URL so that only URL chars remain
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // Separate URL's parameters in array by '/'
            $url = explode('/', $url);
            return $url;
        }
    }

    /**
     * @param array $url
     * @return array
     */
    public function setController(array $url): array
    {
        if (file_exists(ROOT_DIR . self::CONTROLLERS_DIR . ucwords($url[0]) . '.php')) {
            // If exists, set it as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
            return $url;
        }
        return [];
    }

    /**
     * @param array $url
     * @return array
     */
    public function setMethod(array $url): array
    {
        if (isset($url[1])) {
            // Check to see if method exists in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                // Unset 1 index
                unset($url[1]);
                return $url;
            }
        }
        return [];
    }
}
