<?php

class Route {
    static function start() {

        // default controller & action
        $controller_name = 'Map';
        $action_name = 'index';

        $delete_get = explode('?', $_SERVER['REQUEST_URI']);
        $routes = explode('/', $delete_get[0]);

        // work with path to project in uri
        $path_to_project = explode('/', PROJECT_PATH);

        $length_of_path = count($path_to_project);
        
        $end_of_path = array_search($path_to_project[$length_of_path - 1], $routes);

        $request = array_slice($routes, $end_of_path + 1);
        
        // getting controller's name
        if(!empty($request[0])) {  
            $controller_name = $request[0];
        }

        // getting action's name
        if(!empty($request[1])) {
            $action_name = $request[1];
        }

        // add prefixes
        $model_name = 'Model_'.$controller_name;
        $controller_name = 'Controller_'.$controller_name;
        $action_name = 'action_'.$action_name;
        
        // connect file with molel class (if exist)
        $model_file = strtolower($model_name).'.php';
        $model_path = REAL_PATH."/models/".$model_file;

        if(file_exists($model_path)) {
            require_once $model_path;
        } else {
            Route::ErrorPage404();
            echo 'model nof found <br>';
        }

        // connect file with controller class (if exist)
        $controller_file = strtolower($controller_name).'.php';
        $controller_path = REAL_PATH."/controllers/".$controller_file;

        if(file_exists($controller_path)) {
            require_once $controller_path;
        } else {
            Route::ErrorPage404();
            //echo 'controller nof found <br>';
        }

        // create controller
        $controller = new $controller_name();
        $action = $action_name;
        
        // call action (if exist)
        if(method_exists($controller, $action)) {
            $controller->$action();
        } else {
            Route::ErrorPage404();
            echo 'action nof found <br>';
        }
    }

    function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}
