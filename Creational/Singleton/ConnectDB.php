<?php

/**
 * The Singleton class defines the `GetInstance` method that serves as an
 * alternative to constructor and lets clients access the same instance of this
 * class over and over.
 */
class ConnectDB
{
    private static $instance = null;
    private $conn;
    private $host = '127.0.01';
    private $user = 'root';
    private $pass = '';
    private $name = 'test';

    /**
     * The Singleton's constructor should always be private to prevent direct
     * construction calls with the `new` operator.
     */
    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host}; dbname={$this->name}", $this->user,$this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }


    /**
     * This is the static method that controls the access to the singleton
     * instance. On the first run, it creates a singleton object and places it
     * into the static field. On subsequent runs, it returns the client existing
     * object stored in the static field.
     *
     * This implementation lets you subclass the Singleton class while keeping
     * just one instance of each subclass around.
     */
    public static function getInstance()
    {
        if(!self::$instance) self::$instance = new ConnectDB();
        return self::$instance;
    }

    public function getConnection()
    {
        
        return $this->conn;
    }
}


/**
 * The client code.
 */
function clientCode()
{
    $instance = ConnectDB::getInstance();
    $conn = $instance->getConnection();
    var_dump($conn);


    $instance = ConnectDB::getInstance();
    $conn = $instance->getConnection();
    var_dump($conn);


    $instance = ConnectDB::getInstance();
    $conn = $instance->getConnection();
    var_dump($conn);
}

clientCode();