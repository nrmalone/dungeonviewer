<?php

class Application
{
    //URL: https://SERVER_NAME/public/$controller/$method/$params

    //controller acts as the middle man between the user and web server
    protected $controller = 'home';

    //method calls the proper  function housed in the controller
    //index() is the default method & also loads the appropriate view
    protected $method = 'index';

    //params houses any relevant input variables for the method
    protected $params = [];


    //__construct() runs when the Application is created in the public/index.php
    public function __construct()
    {
        $url = $this->parseURL();

        //check if controller exists & require it... defaults to home if invalid
        if (isset($url[0]) && file_exists('../app/controllers/' . strtolower($url[0]) . '.php'))
        {
            $this->controller = strtolower($url[0]);
            unset($url[0]);
        }
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        //run the specified method from 2nd part of URL if it exists
        if (isset($url[1]))
        {
            if (method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    //function to create an array out of the URL's parts
    public function parseURL()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}