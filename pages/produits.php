<?php

function first($str) {
    return explode('_', $str)[0] . '_1';
}

try {
    $vue = new VueMontresDB($cnx);
    $data = $vue->getVueMontres();
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
} catch (PDOException $e) {
    print $e->getMessage();
}
//   echo"<pre>";print_r($_SESSION['PANIER']); echo"</pre>";
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

<!--<style>
    #myDIV {
        border: 1px solid black;
        width: 200px;
        height: 100px;
        overflow: scroll;
    }
</style>

<div id="myDIV">
    <p class="owl-stage">SCROLL MY ASS</p>
</div>
<p id="demo"></p>
<script>

</script>-->