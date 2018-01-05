
<?php

try {
    $search = filter_input_array(INPUT_GET);
    $vue = new VueMontresDB($cnx);
    $data = $vue->getVueMontres(rechercher($search));
    if(empty($data)){ ?>
        <div class="py-5 text-white" style="background-image: url(images/background_form.jpg); height: 100vh;}">
            <div class="container">
                    <div class="col-md-10 mx-auto ajouter">
                        <a class="croix lead" href="index.php">x</a>
                        <h1 class="text-gray-light text-light display-4 text-center">Aucun produit trouvé !</h1>
                        <p class="lead mb-4 text-light text-center">Vous pouvez choisir l'une de nos catégories ci-dessous.</p>

                        <div class="row py-3">
                            <div class="col-md-4 text-center text-center">
                                <b class=" lead font-30 ">Pour hommes</b>
                                <a href="index.php?page=produits.php&cat=h"><img class="img-fluid d-block w-100 border border-primary" src="images/man.jpg" ></a>
                            </div>
                            <div class="col-md-4 text-center">
                                <b class=" lead font-30 ">Pour femmes</b>
                                <a href="index.php?page=produits.php&cat=f"><img class="img-fluid d-block w-100 border border-primary" src="images/woman.jpg" ></a>

                            </div>
                            <div class="col-md-4 text-center ">
                                <b class=" lead font-30 ">Toutes nos marques</b>
                                <a href="index.php?page=produits.php"><img class="img-fluid d-block w-100 border border-primary" src="images/brands.jpg" ></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } else {
    $_SESSION['MONTRES'] = $data;
    $container = $vue->getTableau2D($data);
    
    echo '<div class="container">';
    foreach ($container as $row) {
        echo '<div class=" row py-3">';
        foreach ($row as $obj) {
            $id = $obj['img_print'];
            ?>
            <div class="col-md-4 py-3" >
                <div id="<?= $id ?>" class="card produit">
                    <!--<div class="card-header text-center">Modèle pour femme</div>-->
                    <div class="card-body">
                        <div id="3d_<?= $id ?>" >
                            <a href="" class="autorotate"><i id="" class="fa fa-play player player-<?= $id ?>" aria-hidden="true"></i></a>
                            <a href="" class="autorotate_stop"><i class="fa fa-stop stop_3d player player-<?= $id ?>" aria-hidden="true"></i></a>
                        </div>
                        <div id="2d_<?= $id ?>" class="text-center">
                            <img  class="img-fluid mx-auto py-3 img-responsive zoom-img montre" src="images/montres/<?= first($id) ?>.jpg" alt="Card image">
                        </div>
                        <h4 class="text-center"><?= $obj['nom']; ?></h4>
                        <h6 class=" text-center"><?= $obj['t_sexe']; ?></h6>
                        <h5 class="text-muted text-center"><?= $obj['prix']; ?> €</h5>
                        <p class=" p-y-1"></p>
                    </div>
                    <div class="ico add_panier"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                    <div class="ico start_2d"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                    <div id="r_oeil" class="ico start_3d"><i class="fa fa-eye" aria-hidden="true"></i></div>
                </div>
            </div>

        <?php
        }
        echo "</div>";
    }
    echo"</div>";
    }
} catch (PDOException $e) {
    print $e->getMessage();
}
?>

<div id="div_modal"></div>

<div id="notif_panier" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Continuer</button>
            </div>
        </div>
    </div>
</div>

<?php

function rechercher($search){
    $tab = array();
    if(isset($search['brand'] )){
        array_push($tab, $search['brand']);
    } else{
        array_push($tab, '%');
    }
    if(isset($search['cat'] )){
        array_push($tab, $search['cat']);
    } else{
        array_push($tab, '%');
    }
    if(isset($search['sort'] )){
        array_push($tab, $search['sort']);
    } else{
        array_push($tab, 1);
    }
    return $tab;
}

function first($str) {
    return explode('_', $str)[0] . '_1';
}