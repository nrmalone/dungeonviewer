<?php

class Controller
{
    // grab the view (HTML output) associated with the controller specified in URL
    function view($view, $data = [])
    {
        if(file_exists('../app/views/' . $view . '.php'))
        {
            include '../app/views/' . $view . '.php';
        } else {
            $_SESSION['error'] = "Couldn't find the necessary display for " . $view;
            include '../app/views/error.php';
        }
    }

    //call the model for user interactions that will require storing and/or manipulation of data
    function loadModel($model)
    {
        if(file_exists('../app/models/' . $model . '.php'))
        {
            include '../app/models/' . $model . '.php';
            print_r("");
        } else {
            $_SESSION['error'] = "Unable to load data for " . $model;
            include '../app/views/error.php';
        }
    }
}