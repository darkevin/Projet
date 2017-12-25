<?php
include ('settings.php');
// récupère les données du formulaires
$data = filter_input_array(INPUT_POST); 
$montant = $_SESSION['TOTAL'];
$idcli = $_SESSION['USER'][0];
$DB = new CommandeDB($cnx);
$numfact = $DB->add(array($montant, $idcli));
foreach ($_SESSION['PANIER'] as $montre){
    $DB->add_ligne(array($numfact, $montre['id_montre'], $montre['quantite']));
}

echo json_encode(
        array(
            "num" => $numfact, 
            "montant" => $montant
        )
     );



