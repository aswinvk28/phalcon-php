<?php

class AnotherController extends \Phalcon\Mvc\Controller {
    
    public function indexAction() {
        return json_encode($this->dispatcher->getParams());
    }
    
}

?>