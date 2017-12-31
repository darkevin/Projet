<?php
session_start();
include ('admin_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

function first($str){
    return explode('_', $str)[0].'_1';
}
