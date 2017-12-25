<?php


class Connexion {
    private static $_instance = null;
    
    public static function getinstance($dsn,$user,$pass){
        if(!self::$_instance){
            try{
                self::$_instance = new PDO($dsn,$user,$pass);
                self::$_instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                print "Echec de connnexion ".$e->getMessage();
            }
        }
        return self::$_instance;
    }
}
