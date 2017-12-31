<?php 
include ('../settings.php');

$data = filter_input_array(INPUT_POST);
$numfact = $data['numfact'];

$DB = new VueCommandeDB($cnx);
$rs = $DB->getDetailCommande($numfact);


?>
<div id="recap_panier" class="py-5 container">
    <div class="card shopping-cart">
        <div class="card-header ">
            <h1 class="display-4 font-25 d-lg-none" >Détail de la commande <b><?= $numfact?></b></h1>
            <div class="d-none d-lg-block">
                <div class="row" >
                    <div class="col-12 col-sm-12 col-lg-4 text-right ">
                        <h4>Description du produit</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 text-center ">
                        <h4>Prix unitaire</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-2 text-center ">
                        <h4>Quantité</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-3 text-center ">
                        <h4>Sous-Total</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
           <?php 
           
            
           $sum=0;
           $q=0;
           foreach($rs as $item){ 
               ?>
            <!-- PRODUCT -->
            
            <div class="row" >

                <div class="col-12 col-sm-12 col-lg-2 text-center ">
                    <img class="img-responsive" src="images/montres/<?= first($item['img_print'])?>.jpg" alt="prewiew" width="120" height="120">
                </div>
                
                <div class="col-12 col-sm-12 col-lg-2 text-lg-right text-center py-2">
                    <h1 class="display-4 font-20"><strong><?=$item['marque']?></strong></h1>
                    <h1 class="display-4 font-20"><?=$item['description']?></h1>
                </div>
                 
                <div class="col-12 col-sm-12 col-lg-3 text-lg-center text-center ">
                    <h1 class="display-4 font-30"><b class="d-lg-none" >Prix unitaire : </b><?=$item['prix']?>€</h1>
                </div>

                <div class="col-12 col-sm-12 col-lg-2 text-lg-center text-center">
                    <h1 class="display-4 font-30"><b class="d-lg-none" >Quantité : </b>x<?=$item['quantite']?></h1>
                </div>

                <div class="col-12 col-sm-12 col-lg-3 text-lg-center text-center">
                    <h1 class="display-4 font-30"><b class="d-lg-none" >Sous-total : </b><?=$item['subtotal']?>€</h1>
                </div>
                
                
                
            </div>
            <hr>
            <!-- END PRODUCT -->
            <?php 
            $sum += $item['subtotal']; 
            $q += $item['quantite'];
            } ?>
            
            
        </div>
        <div class="card-footer">
            <div class="row">
                <!--<div class="py-1 col-12 col-sm-12 col-lg-2  text-center "><a id="woop" style="font-size: 25px;" href="./admin/lib/php/script_pdf.php"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></div>-->
                <div class="py-1 col-12 col-sm-12 col-lg-2  text-center "><a   style="font-size: 25px;"><i data-num="<?= $numfact ?>" class="fa fa-file-pdf-o pdf_commande" aria-hidden="true"></i></a></div>
                <div class="py-1 col-12 col-sm-12 col-lg-2  text-center text-lg-right"><a href="index.php?page=produits.php" class="btn btn-outline-secondary ">Retour aux produits</a></div>
                <div class="py-1 col-12 col-sm-12 col-lg-3  text-center"><a href="index.php?page=commandes.php" class="btn btn-outline-secondary ">Retour aux commandes</a></div>
                <div class="col-12 col-sm-12 col-lg-2 text-center">
                    <h1 class="display-4 font-30 text-center"><?= $q ?> articles</h1>
                </div>
                <div class="col-12 col-sm-12 col-lg-3  text-center"><h6 class="display-4" style="font-size: 35px;"><b id="total_panier"><span id="montant"><?= $sum ?></span>.00€</b></h6></div>
            </div>
        </div>
    </div>
</div>
