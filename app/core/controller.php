<?php

class Controller
{
    const errorPath = '../app/views/error.php';
    // 
    function view($view, $data = [])
    {
        if(file_exists('../app/views/' . $view . '.php'))
        {
            include '../app/views/' . $view . '.php';
        } else {
            include $errorPath;
        }
    }

    //call the model to 
    function loadModel($model)
    {
        if(file_exists('../app/models/' . $model . '.php'))
        {
            include '../app/models/' . $model . '.php';
            print_r("");
        } else {
            include $errorPath;
        }
    }
}