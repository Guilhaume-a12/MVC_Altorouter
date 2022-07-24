<?php
namespace App\Models;

abstract class ModelClass {

    private static $pdo;

    private static function setBdd() {
        $config = parse_ini_file(__DIR__ . "../../config.ini");
        self::$pdo = new \PDO("mysql:host=".$config['DB_HOST'].";dbname=".$config['DB_NAME'].";charset=utf8",$config['DB_USERNAME'],"");
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
    }

    protected function getBdd() {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }
}