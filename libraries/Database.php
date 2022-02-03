<?php
//constantes environnement
define("DBHOST", "localhost:8889");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "blogpoo");
 
class Database 
{
     /**
      * Retourne une connexion à la bdd
      * @return PDO
      */
    public static function getPdo():PDO
    {

        $dsn = $dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;
        
        $pdo = new PDO($dsn, DBUSER, DBPASS);

        $pdo->exec("SET NAMES utf8");

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    }
}


