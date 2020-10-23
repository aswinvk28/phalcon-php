<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NewConsole extends \Phalcon\DI\FactoryDefault\CLI {
    
    public function handle($args) {
        $className = ucfirst($args['controller']) . 'Controller';
        $action = ucfirst($args['action']) . 'Action';
                
        return (new $className)->{$action}();
    }
    
}

try {
    
    defined('APPLICATION_PATH')
     || define('APPLICATION_PATH', realpath(dirname(__FILE__)));
    
    $loader = new \Phalcon\Loader();
    $loader->registerDirs(array(
        APPLICATION_PATH . '/controllers/',
        APPLICATION_PATH . '/models/'
    ))->register();
    
    $loader->registerNamespaces(array(
       'Home\Controller' => 'controllers/',
       'Home\Model' => 'models/',
       'Home\Task' => 'tasks/'
    ))->register();
    
    $di = new \Phalcon\DI\FactoryDefault\CLI();
    
    $di->set('modelsManager', function() {
        return new \Phalcon\Mvc\Model\Manager();
    });
    
    if(is_readable(APPLICATION_PATH . '/config/config.php')) {
        $config = include APPLICATION_PATH . '/config/config.php';
        $di->set('config', $config);
    }
    
    $console = new NewConsole();
    
    $console->setDi($di);
    
    /**
    * Process the console arguments
    */
    $arguments = array();
    $params = array();

    foreach($argv as $k => $arg) {
        if($k == 1) {
            $arguments['controller'] = $arg;
        } elseif($k == 2) {
            $arguments['action'] = $arg;
        } elseif($k >= 3) {
           $params[] = $arg;
        }
    }
    if(count($params) > 0) {
        $arguments['params'] = $params;
    }
    
//    require_once APPLICATION_PATH . '/config/routes.php';
    
    try {
        echo $console->handle($arguments);
    }
    catch (\Phalcon\Exception $e) {
        echo $e->getMessage();
        exit(255);
    }
    
} catch (Exception $e) {
    print $e->getMessage();
}

?>