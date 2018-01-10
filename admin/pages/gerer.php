<?php
include './lib/php/verifier_connexion.php';
$DB = new VueMontresDB($cnx);
$data = $DB->getVueMontres(null);
?>

<div class="py-5 maj_stock">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ajouter mx-auto hello">
                <table id="example" class="table" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class='lead text-center text-light' >ID</th>
                            <th class='lead text-center text-light' >Prix</th>
                            <th class='lead text-center text-light' >Description</th>
                            <th class='lead text-center text-light' >Marque</th>
                            <th class='lead text-center text-light' >Stock</th>
                            <th class='lead text-center text-light' >En ligne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $item) { ?>
                            <tr>
                                <th class='lead text-center'><?= $item['id_montre'] ?></th>
                                <th class='lead text-center'><?= $item['prix']."€" ?></th>
                                <th class='lead text-center'><?= $item['t_sexe'] ?></th>
                                <th class='lead text-center'><?= $item['nom'] ?></th>
                                
                                <th class='lead text-center'>
                                <input id='<?= $item['id_montre'] ?>' onkeydown="return false" type="number"  min="0" step="1" class="changer_stock lead" value="<?= $item['stock'] ?>"/>
                                </th>
                                <th  class='lead text-center '>
                                    <select data-num='<?= $item['id_montre'] ?>' class="changer_dispo" >
                                        <option class='lead text-center' value="1">oui</option>
                                        <option class='lead text-center' value="0" <?= $item['dispo']==0?"selected":""?>>non</option>
                                    </select>
                                </th>
                            </tr>
                        <?php } ?>
                    <tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
