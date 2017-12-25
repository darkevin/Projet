<?php
$tab = array("casio", "chanel", "citizen", "dw", "fossil", "gucci", "ice_watch", "rolex");
?>
<div class="container">
    <h1 class="display-4 h-25 py-5">NOS MARQUES DE MONTRES</h1>
    <div class="row text-center text-lg-left">
        <?php foreach ($tab as $marque) { ?>
            <div class="col-lg-3 col-md-4 col-xs-6">
                <a href="#" class="d-block mb-4 h-100">
                    <img class=" marque img-fluid img-responsive zoom-img" src="./images/<?= $marque ?>.png" alt="">
                </a>
            </div>
        <?php } ?>
    </div>
</div>
