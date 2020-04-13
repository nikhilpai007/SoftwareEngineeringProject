<?php

function & dbconnect(){
   // Load configuration as an array. Use the actual location of your configuration file
    //$config = parse_ini_file(DOCROOT.'config.ini');
    //Note: on loki, you file should be located in the pwd folder (which should be in your user directory)
    //$config = parse_ini_file(DOCROOT.'pwd/config.ini');


    //create connection dsn
   $dsn = "mysql:host=loki.trentu.ca;dbname=apollosoftware;charset=utf8";

    //set options array for connection
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    //make database object
    try {
        $pdo = new PDO($dsn, "apollosoftware", "cois4000Y", $options);
    } catch (\PDOException $e) {
         throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    return $pdo;

}
