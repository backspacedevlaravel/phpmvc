<?php

/**
 * Class App
 * Core App controller
 */
class App {

    /**
     * @var string
     * Default Method of the framework
     */
    protected $defaultMethod = 'index';
    /**
     * @var string
     * Default home Controller of the framework
     */
    protected $defaultController = 'Home';
    /**
     * @var array
     * Parameters used in this framework
     */
    protected $parameters = [];

    /**
     * App constructor.
     */
    public function __construct()
    {
        $url = $this->processUrl();

        /**
         * Set the Default Controller from URL
         */
        if( file_exists('../app/controllers/' .$url[0]. '.php') ) {
            $this->defaultController = $url[0];
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->defaultController . '.php';

        $this->defaultController = new $this->defaultController;

        /**
         * Set the Default Method from URL
         */
        if(isset($url[1])) {
            if(method_exists($this->defaultController, $url[1])) {
                $this->defaultMethod = $url[1];
                unset($url[1]);
            }
        }

        $this->parameters = $url ? array_values($url) : [];

        /**
         * Call User function from the URL parameters
         */
        call_user_func_array([$this->defaultController, $this->defaultMethod], $this->parameters);
    }

    /**
     * @return array
     * Process URL and return the exploded values from URL into Array
     */
    public function processUrl()
    {
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}