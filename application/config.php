<?php
class Config {
    static function set() {
        define('PROJECT_PATH', '/map.dev');
        define('REAL_PATH', dirname(__FILE__));

        //echo PROJECT_PATH, "<br>";
        //echo REAL_PATH, "<br>";
        
        require_once (REAL_PATH.'/core/model.php');
        require_once (REAL_PATH.'/core/view.php');
        require_once (REAL_PATH.'/core/controller.php');

        require_once (REAL_PATH.'/core/mysql.php');
        $host_sql = array('host' => "localhost",
            'user' => "root",
            'pass' => "",
            'db' => "map");
        DataBase::get_instance($host_sql);

        require_once (REAL_PATH.'/core/route.php');
    }
}