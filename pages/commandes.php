<?php

$DB = new VueCommandeDB($cnx);
$tab = $DB->getListeCommandes($_SESSION['USER'][0]);

?>

<div id="recap_commande" class="py-5 container">
    <div class="card shopping-cart">
        <div class="card-header ">
            <h1 class="display-4 font-25 d-lg-none" >Liste de vos commandes :</h1>
            <div class="d-none d-lg-block">
                <div class="row" >
                    <div class="col-12 col-sm-12 col-lg-1 text-center ">
                        <h4>#</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-2 text-center ">
                        <h4>Détails</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-4 text-center ">
                        <h4>Etat de la commande</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-2 text-center ">
                        <h4>Date</h4>
                    </div>
                    <div class="col-12 col-sm-12 col-lg-2 text-center ">
                        <h4>Montant</h4>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-lg-1 text-center ">
                        <h4>PDF</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- ORDER -->
            <?php foreach($tab as $commande){?>
            
            <div class="row" >
                <div class="col-12 col-sm-12 col-lg-1 text-lg-center">
                    <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Numéro de commande : </b>
                        <span class="num"><?= $commande[0] ?></span> 
                    </h4>
                </div>
                
                <div class="col-12 col-sm-12 col-lg-2 text-lg-center">
                    <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Détails : </b>
                        <a data-num="<?= $commande[0] ?>" class="detail_commande" href="">Détails</a>
                    </h4>
                </div>
                
                <div class="col-12 col-sm-12 col-lg-4 text-lg-center">
                    <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Etat : </b>
                        <?= $commande[2] ?> 
                    </h4>
                </div>
                <div class="col-12 col-sm-12 col-lg-2 text-lg-center">
                    <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Date : </b>
                        <?= $commande[1] ?> 
                    </h4>
                </div>
                <div class="col-12 col-sm-12 col-lg-2 text-lg-center">
                    <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Montant : </b>
                        <?= $commande[3] ?>€
                    </h4>
                </div>
                
                    <div class="col-12 col-sm-12 col-lg-1 text-lg-center">
                        <h4 class="display-4 font-20">
                        <b class="d-lg-none" >Impression : </b>
                        <a style="font-size: 25px;" href=""><i data-num="<?= $commande[0] ?>" class="fa fa-file-pdf-o pdf_commande" aria-hidden="true"></i></a>
                        </h4>
                    </div>
                
            </div>
            <hr>
            <!-- END ORDER -->
            <?php } 
                if(empty($tab)){
                    echo "Aucune commande effectuée.";
                }
            ?>
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="py-1 col-12 col-sm-12 col-lg-11 text-lg-left text-center"><a href="index.php?page=produits.php" class="btn btn-outline-secondary ">Retour aux produits</a></div>
                <?php if(!empty($tab)){?>
                    <div class="col-12 col-sm-12 col-lg-1 text-center"><a id="generate_pdf_" style="font-size: 25px;" href="./admin/lib/php/script_zip_pdf.php"><i class="fa fa-file-archive-o" aria-hidden="true"></i></a></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div id="detail_commande"></div>
<?php


//echo"<pre>"; print_r($rs);echo"</pre>"; 