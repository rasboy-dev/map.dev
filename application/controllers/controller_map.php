<?php

class Controller_Map extends Controller {
    
    function __construct() {
        $this->model = new Model_Map();
        $this->view = new View();
    }

    //default action
    function action_index() {   
        
        $data = null;
        //view generating
        $this->view->generate('map_view.php', 'template_view.php', $data);
    }
}
