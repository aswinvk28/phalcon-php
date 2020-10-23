<?php

class DefaultController extends \Phalcon\Mvc\Controller {
    
    public function indexAction() {
        return $this->dispatcher->forward(array(
            'controller' => 'Another',
            'action' => 'index',
            'params' => array(1, 2, 3)
        ));
    }
    
}

?>