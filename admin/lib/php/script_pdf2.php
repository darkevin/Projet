<?php
function first($str){return explode('_', $str)[0].'_1';}
include ('settings.php');
require __DIR__.'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

$DB = new VueCommandeDB($cnx);
$rs = $DB->getDetailCommande($_SESSION['pdf_var']);
unset($_SESSION['pdf_var']);

$TOTAL=0;
$html2pdf = new Html2Pdf();
$html2pdf->addFont('roboto-Bold', '', 'roboto-Bold');
$html2pdf->addFont('roboto-Bold', '', 'roboto-Medium');
$html2pdf->addFont('roboto', '', 'roboto');

$css ='
    <style>
        h1{
            text-align: center; 
            margin-top:20px;
            margin-bottom:50px;
            font-family: roboto;
            font-size: 40px;
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
$table_start ='<h1>Détail de la commande</h1>
<table align="center">
    <tr>
        <th style="width: 15%"></th>
        <th style="width: 30%"><strong>Description</strong></th>
        <th style="width: 15%">Quantite</th>
        <th style="width: 20%">Prix unitaire</th>
        <th style="width: 20%">Sous Total</th>
    </tr>';

$total=0;
$produits = array();
foreach($rs as $o){
    array_push($produits, produit(first($o['img_print']), $o['marque'], $o['description'], $o['quantite'], $o['prix']));
    $total += $o['quantite']* $o['prix'];
}

$table_end = '<tr>
    <td style="width: 15%"></td>
    <td style="width: 30%"></td>
    <td style="width: 15%"></td>
    <td style="width: 20%; font-family: roboto-Bold;">TOTAL : </td>
    <td style="width: 20%; font-family: roboto-Bold;">'.number_format((float)($total), 2, '.', '').'€</td>
</tr>
</table><br/>';

$date = date('YmdHis');
$filename = 'W4A_commande_'.$date.'.pdf';
$html2pdf->writeHTML($css.$table_start.implode(" ", $produits).$table_end);
$html2pdf->output($filename, 'D');

function produit($img, $marque, $sexe, $qte, $prix){
    return '<tr>
        <td style="width: 15%"><img src="../../../images/montres/'.$img.'.jpg" style="width:100px; height:100;"/></td>
        <td style="width: 30%">'.$marque.' '.$sexe.'</td>
        <td style="width: 15%">'.$qte.'x</td>
        <td style="width: 20%">'.$prix.'€</td>
        <td style="width: 20%">'.number_format((float)($qte*$prix), 2, '.', '').'€</td>
    </tr>';
}
