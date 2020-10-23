<?php

$router = new \Phalcon\Mvc\Router();

$router->addGet('/default/route', array(
    'controller' => 'default',
    'action' => 'index'
));

$router->handle();

?>