<?php
namespace config;

class Database {

    const SERVER = "localhost";
    const DB = "projetPHP";
    const LOGIN = "root";
    const PWD = "iutinfoROOT";
    
    private static $linkpdo = null;

    private function __construct() {}

    public static function getInstance(): \PDO {
        if(self::$linkpdo === null) {
            self::$linkpdo = new \PDO("mysql:host=" . self::SERVER . ";dbname=" . self::DB, self::LOGIN, self::PWD);
            self::$linkpdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            self::$linkpdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        }
        return self::$linkpdo;
    }

}