<?php

function first($str){return explode('_', $str)[0].'_1';}
include ('settings.php');
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;


$DB = new VueCommandeDB($cnx);

function produit($img, $marque, $sexe, $qte, $prix){
    return '<tr>
        <td style="width: 15%"><img src="../../../images/montres/'.$img.'.jpg" style="width:100px; height:100;"/></td>
        <td style="width: 30%">'.$marque.' '.$sexe.'</td>
        <td style="width: 15%">'.$qte.'x</td>
        <td style="width: 20%">'.$prix.'€</td>
        <td style="width: 20%">'.number_format((float)($qte*$prix), 2, '.', '').'€</td>
    </tr>';
}

// ADRESSE_DE_LIVRAISON >>> START
$tab = $_SESSION['USER'];
$numcli = $tab[0];
$nom = $tab[1];
$prenom = $tab[2];
$mail = $tab[3];
$adresse1 = $tab[4] . " " . $tab[5];
$adresse2 = $tab[6] . " " . $tab[7];
$info = 
'<div class="para">
    <h6 class="fat">Adresse de livraison : </h6>
    <div class="tab">
        '.$prenom.' '.$nom.'<br>'
        .$adresse1.'<br>'
        .$adresse2.'<br>'
        .$mail.'<br>
    </div>
</div>';
// ADRESSE_DE_LIVRAISON >>> END

//STYLE CSS >>> START
$css ='
    <style>
        h6, .tab{
            font-family: roboto;
            font-size: 25px;
            margin-left:5px;
            text-align:right;
        }
        .fat{
           font-family:  roboto-Medium;
        }
        .tab{
            margin-right:15px;
        }
        .para{
            margin-right : 50px;
        }
        h1{
            text-align: center; 
            margin-top:20px;
            font-family: roboto;
            font-size: 40px;
            margin-bottom: 50px;
        }
        .details{
            margin-bottom: 20px;
            text-align:right;
            margin-right:50px;
        }
        table {
            border-collapse: collapse;
            text-align: center; 
            width: 90%
        }
        th{
            font-size: 18px;
            border-bottom: 1px solid silver;
            padding-bottom:10px;
            font-family: roboto-Medium;
        }
        td {
            border-bottom: 1px solid silver;
            padding-bottom:15px;
            padding-top:15px;
            font-family: roboto;
            font-size:16px
        }
    </style>';
//STYLE CSS >>> END
mkdir('mes_commandes', 0777);
$source = $DB->getListeIdCommandes($numcli);
foreach($source as $num){
    $html2pdf = new Html2Pdf();
    $html2pdf->addFont('roboto-Bold', '', 'roboto-Bold');
    $html2pdf->addFont('roboto-Medium', '', 'roboto-Medium');
    $html2pdf->addFont('roboto', '', 'roboto');
    $rs = $DB->getDetailCommande($num);
    $tm_date = $DB->getDateCommande($num);
    
    $details ='<div class="details"> Commande n°'.$num.' effectuée sur watchforall.com le '.$tm_date.'</div>';
    $table_start ='<h1>Détail de la commande n°'.$num.'</h1>
    <table align="center">
        <tr>
            <th style="width: 15%"></th>
            <th style="width: 30%"><strong>Description</strong></th>
            <th style="width: 15%">Quantité</th>
            <th style="width: 20%">Prix unitaire</th>
            <th style="width: 20%">Sous Total</th>
        </tr>';
    
    $total=0;
    $produits = array();
    foreach($rs as $o){
        array_push($produits, produit(first($o['img_print']), $o['marque'], $o['description'], $o['quantite'], $o['prix']));
        $total += $o['quantite']* $o['prix'];
    }
    
    $table_end = 
        '<tr>
            <td style="width: 15%"></td>
            <td style="width: 30%"></td>
            <td style="width: 15%"></td>
            <td style="width: 20%; font-family: roboto-Bold;">TOTAL : </td>
            <td style="width: 20%; font-family: roboto-Bold;">'.number_format((float)($total), 2, '.', '').'€</td>
        </tr>
        </table><br/>';
    
    $filename = 'mes_commandes/W4A_commande_'.$num.'.pdf';
    $html2pdf->writeHTML($css.$table_start.implode(" ", $produits).$table_end.$details.$info);
    $html2pdf->output($filename, 'F');
}

//$zip = new ZipArchive;
//if ($zip->open('test_new.zip', ZipArchive::CREATE) === TRUE)
//{
//    // Add files to the zip file
//    $zip->addFile('test.pdf');
//    $zip->close();
//} else {
//    echo "Problem";
//}


$zipArchive = new ZipArchive();
if ($zipArchive->open('mes_commandes.zip', ZIPARCHIVE::CREATE)){
    $zipArchive->addGlob("mes_commandes/*.pdf");
}
$zipArchive->close();

header('Content-type: application/zip');
header('Content-Disposition: attachment; filename="mes_commandes.zip"');
readfile('mes_commandes.zip');

unlink('mes_commandes.zip');
array_map('unlink', glob("mes_commandes/*.pdf"));
rmdir('mes_commandes');
