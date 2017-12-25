<?php
function first($str){return explode('_', $str)[0].'_1';}
include ('settings.php');
!isset($_SESSION['PANIER']) AND $_SESSION['PANIER']=array();
$panier = & $_SESSION['PANIER'];
if(empty($panier)){?>
    <a class="dropdown-item" href="#">Votre panier est vide !</a> 
<?php } else {
foreach($panier as $montre){
    ?>
    <a class="dropdown-item" href="#"><img src="images/montres/<?= first($montre['img_print'])?>.jpg" style="width:75px;"/>
    <?= $montre['nom']." ".$montre['prix']."€"?></a>
<?php } ?> <a class="dropdown-item text-center" href="index.php?page=panier.php">Consulter mon panier.</a> <?php
}