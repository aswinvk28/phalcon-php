<?php

$config = new \Phalcon\Config(array(
    "database" => array(
        "adapter" => "Mysql",
        "host" => "localhost",
        "username" => "root",
        "password" => "",
        "dbname" => "drupal_sample"
    )
 ));

return $config;

?>