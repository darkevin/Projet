<?php
session_start();
include ('admin_liste_include.php');
$cnx = Connexion::getInstance($dsn, $user, $pass);

