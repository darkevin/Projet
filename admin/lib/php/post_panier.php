<?php
function first($str){return explode('_', $str)[0].'_1';}
include ('settings.php');
!isset($_SESSION['PANIER']) AND $_SESSION['PANIER']=array();
$panier = & $_SESSION['PANIER'];

$liste_id=array();
foreach($panier as $montre){
    array_push($liste_id, $montre['id_montre']);
}

$data = filter_input_array(INPUT_POST);
$valeur = $data['img_print'];

foreach($_SESSION['MONTRES'] as $montre){
    if($valeur == $montre['img_print']){
        if(!in_array($montre['id_montre'], $liste_id)){
            array_push($panier, $montre);
            $msg = "Produit ajouté au panier !&&";
        } else{
            unset($panier[array_search($montre, $panier)]);
            $panier = array_values($panier);
            $msg = "Produit retiré du panier !&&";
        }
        echo $msg;
        echo '<img src="images/montres/'.first($montre['img_print']).'.jpg" style="width:150px;"/>';
        echo $montre['nom'].' '.$montre['prix'].'€';
        return;
    }
}
//print_r($_SESSION['PANIER']);