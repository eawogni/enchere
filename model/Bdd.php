<?php
/**
 * Created by PhpStorm.
 * User: awogn
 * Date: 22/11/2018
 * Time: 23:49
 */


class  Bdd
{
    private static $dbname;
    private static $host;
    private static $user;
    private static $passwd;
    private static $pdo = null;


    public static function getPDO()
    {
        if (self::$pdo == null) {
            try {
                self::setPDOdata();
                $dsn = "mysql:dbname=" . self::$dbname . ";host=" . self::$host . ";charset=utf8";
                self::$pdo = new PDO($dsn, self::$user, self::$passwd);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $err) {
                echo($err->getMessage());
                exit;

            }
        }

        return self::$pdo;
    }

    /**
     * configure les infos pour la connexion à la bdds
     */
    private static function setPDOdata()
    {
        $params = require C_ROOT . '/configBdd/config.php';
        self::$dbname = $params['dbname'];
        self::$host = $params['host'];
        self::$user = $params['username'];
        self::$passwd = $params['passwd'];
    }


}