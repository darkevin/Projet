<?php
include ('../settings.php');
// récupère les données du formulaire
$data = filter_input_array(INPUT_POST); 

$email = $data['email'];
$password = $data['password'];

$st = $cnx->prepare("select * from verif_client(?,?)");
$st->execute(array($email, $password));
$result = $st->fetchAll();


if(empty($result)){
    echo "0";
} else {
    echo "1";
    $_SESSION['USER']=$result[0];
}