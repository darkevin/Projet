<?php
include ('settings.php');

// récupère les données du formulaires
$data = filter_input_array(INPUT_POST);

$nom = $data['nom'];//
$prenom = $data['prenom'];
$mail = $data['email'];
$mp = $data['pw1'];
$num = $data['numero'];
$adresse = $data['adresse'];
$cp = $data['cp'];
$localite = $data['localite'];

$CLIENTDB = new ClientDB($cnx);
$client = new Client( array($nom, $prenom, $mail, $mp, $num, $adresse,$cp, $localite));
$flag = $CLIENTDB->add($client);

if($flag){
    $st = $cnx->prepare("select * from verif_client(?,?)");
    $st->execute(array($mail, $mp));
    $result = $st->fetchAll();
    
    if(!empty($result)){
        $_SESSION['USER']=$result[0];
    }

}

echo $flag?"1":"0";

/*
demander confirmation dans un modal
 * oui -> ajout db
 *   oui -> retour index
 *   non -> message erreur
 *   non -> on reste sur la page d'inscription
 * 
 * 
 * 
 *  */

/*
'nom='+nom+
"&prenom="+prenom+
"&mail="+mail+
"&mp1"+mp1+
"&mp2"+mp2+
"&numero"+numero+
"&adresse"+adresse+
"&code_postal"+code_postal+
"&localite"+localite;
*/