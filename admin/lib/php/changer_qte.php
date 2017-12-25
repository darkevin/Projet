<?php
include ('settings.php');
$data = filter_input_array(INPUT_POST);
$i = $data['indice'];
$n = $data['valeur'];

$_SESSION['PANIER'][$i]['quantite'] = $n;

$sum=0;
foreach ($_SESSION['PANIER'] as $montre) {
    $sum += $montre['quantite']*$montre['prix'];
}

$total = number_format($sum, 2, '.', '');
$_SESSION['TOTAL'] = $total;
if ($n>1){
    $subtotal = number_format($n * $_SESSION['PANIER'][$i]['prix'], 2, '.', '')."€";
} else {
    $subtotal = " ";
}
echo json_encode(
        array(
            "total" => $total."€", 
            "subtotal" => $subtotal
        )
     );
