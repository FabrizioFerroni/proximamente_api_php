<?php
require 'utils/dotenv.php';

class Connection
{
    static public function infodatabase()
    {
        $infodb = array(
            "host" => $_ENV['DB_HOST'],
            "port" => $_ENV['DB_PORT'],
            "user" => $_ENV['DB_USER'],
            "pass" => $_ENV['DB_PASS'],
            "db" => $_ENV['DB_DATABASE'],
        );

        return $infodb;
    }

    static public function connect()
    {
        try {
            $con = new PDO(
                "mysql:host=" . Connection::infodatabase()['host'] .
                    ";dbname=" . Connection::infodatabase()['db'],
                Connection::infodatabase()['user'],
                Connection::infodatabase()['pass']
            );

            $con->exec("set names utf8");
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }

        return $con;
    }
}
