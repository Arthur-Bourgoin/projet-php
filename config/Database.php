<?php
namespace Config;

class Database {

    private static $server = "localhost";
    private static $db = "projectPHP";
    private static $login = "userProjectPHP";
    private static $pwd = "pwdproject";
    private static $linkpdo = null;

    private function __construct() {}

    public static function getInstance(): \PDO {
        if(self::$linkpdo === null)
            self::$linkpdo = new \PDO("mysql:host=" . self::$server . ";dbname=" . self::$db, self::$login, self::$pwd);
        return self::$linkpdo;
    }

}