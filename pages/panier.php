<div id="recap_panier" class="py-5 container">
    <div class="card shopping-cart">
        <div class="card-header ">
            <h1 class="display-4 font-35" >Liste des produits de votre panier :</h1>
        </div>
        <div class="card-body">
           <?php 
           if(!isset($_SESSION['USER'])){
               $str ="auth";
           }else{
               $str="order";
           }
            $total=0;
           if(empty($_SESSION['PANIER']) || !isset($_SESSION['PANIER'])){
               echo '<div>Votre panier est vide !<a href="index.php?page=produits.php" class="btn btn-outline-secondary pull-right">Retour aux produits</a></div>';
           }else{
                foreach ($_SESSION['PANIER'] as $montre) {
                    $total += $montre['quantite']*$montre['prix'];
                }
                $_SESSION['TOTAL'] = number_format($total, 2, '.', '');
           
           function first($str){return explode('_', $str)[0].'_1';}
           $sum=0;
           $q=0;
           foreach($_SESSION['PANIER'] as $item){ 
               $tab = array("","","","","","");
               $tab[$item['quantite']]="selected";
               ?>
            <!-- PRODUCT -->
            
            <div class="row" >
                <div class="col-12 col-sm-12 col-md-2 text-center">
                    <img class="img-responsive" src="images/montres/<?= first($item['img_print'])?>.jpg" alt="prewiew" width="120" height="120">
                </div>
                <div class="text-center text-md-right col-12  col-sm-12  col-md-4">
                    <h1 class="display-4 font-35"><strong><?=$item['nom']?></strong></h1>
                    <h1 class="display-4 font-25"><?=$item['t_sexe']?></h1>
                    
                </div>
                <div class="col-12 col-sm-12 col-md-3 text-center" >
                    <h1 class="display-4 font-35" ><?=$item['prix']?>€</h1>
                    <h1 class="display-4 font-35"><b style="font-size: 25px" id="subtotal_<?=$q?>">
                       <?= $item['quantite']>1?$item['quantite']*$item['prix'].".00€":""?></b></h1>
                </div>
                <div class="col-12 col-sm-12 col-md-3 text-center"  >
                    <h1 class="display-4 font-30">Quantité :</h1>
                    <select  id="q<?= $q?>" class="changer_qte font-25" style="margin-right: 10px;" name="hour">
                        <?php 
                        for($i=1;$i<6;$i++){
                            echo '<option value="'.$i.'" '.$tab[$i].'>'.$i.'</option>';
                        }
                        ?>
                    </select>
                    <i id="<?=$q++?>" class="fa fa-trash-o trash font-30" aria-hidden="true"></i>
                </div>
            </div>
            <hr>
            <!-- END PRODUCT -->
            <?php } ?>
            
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-2 text-center"><a id="generate_pdf_" style="font-size: 25px;" href="./admin/lib/php/script_pdf.php"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div>
                <div class="py-1 col-12 col-sm-12 col-md-4 text-md-right text-center"><a href="index.php?page=produits.php" class="btn btn-outline-secondary ">Retour aux produits</a></div>
                <div class="col-12 col-sm-12 col-md-3  text-center"><h6 class="display-4" style="font-size: 35px;"><b id="total_panier"><span id="montant"><?= $_SESSION['TOTAL']?></span>€</b></h6></div>
                <div class="py-1 col-12 col-sm-12 col-md-3 text-center"><a class="<?= $str?> btn btn-outline-secondary ">Valider la commande</a></div>
            </div>
        </div>
    </div>
</div>
<?php
}
include ('modal_commande_ok.php'); 