<?php
    include './lib/php/verifier_connexion.php';
    $data = filter_input_array(INPUT_POST);
    if (isset($data['submit'])) {
        $VUE = new VueCommandeDB($cnx);
        if (isset($data['numfact'])) {
            $numfact = $data['numfact'];
            $data = $VUE->getRecapCommande($numfact);
            if($data == null){
                $error = "Commande introuvable !";
            } else{
                $date = $VUE->getDateCommande($numfact);
            }
        } else if (isset($data['status'])){
            $num = $data['num'];
            $status = $data['status'];
            $DB = new CommandeDB($cnx);
            $DB->changer_etat(array($num, $status));
            $data = $VUE->getRecapCommande($num);
        }
    }
?>
<div class="py-5 text-white" style="background-image: url(images/background_add.jpg); height: 100vh;}">
  <div class="container">
    <div class="row ">
      <div class="col-md-8 mx-auto ajouter py-5">
          <a class="croix lead" href="index.php">x</a>
            <?php if(isset($error)){ ?>
                <h1 class="red text-center "><?= $error ?></h1>
            <?php } ?>
        <h1 class="text-light display-4 text-center font-50">Modifier l'état d'une commande</h1>
        <form action="index.php?page=modifier.php" method='post' id="form_search_order">
            
            <?php if(isset($status)){ // si la maj a été effectuée?>
                <p class="lead mb-4  text-center font-30">
                    La mise à jour a été effectuée avec succès !
                </p>
                <?php order_table($data) ?>
            <?php } else if(!isset($numfact) || isset($error)) {?> <!-- si on arrive sur le formulaire ou s'il y a une erreur -->
                <p class="lead mb-4 text-light text-center">Insérer le numéro de facture de la commande pour en modifier le statut.</p>
                <div class="row">
                    <div class="col-md-12">
                        <label class="lead" >Numéro de facture :</label>
                        <div class="input-group">
                            <input name="numfact" type="text" class="form-control" placeholder="Entrer le numéro de facture de la commande">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="submit">Rechercher</button>
                            </span>
                        </div>
                    </div>
                </div>
            <?php } else if(isset($numfact) ){ ?> <!-- si le numéro de facture a été trouvé -->
                <p class="lead mb-4 text-light text-center">Veuillez sélectionner le nouveau statut pour mettre à jour la commande.</p>
                <?php order_table($data) ?>
                <select name="num" hidden>
                    <option value="<?= $numfact ?>"></option>
                </select>
                <div class="row">
                    <div class="col-md-12">
                        <label class="lead">Statut de la commande :</label>
                        <select name="status" class="form-control form-control-lg">
                            <option class="lead" value="p">Commande passée.</option>
                            <option class="lead" value="t">Commande en cours de traitement.</option>
                            <option class="lead" value="e">Commande expédiée.</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class=" col-md-12 float-right">
                        <button class="btn btn-primary float-right py-2" type="submit" name="submit">Mettre à jour</button>
                    </div>
                </div>
            <?php } ?>
        </form>
      </div>
    </div>
  </div>
</div>


<?php function order_table($data){ ?>
    <table class="table">
        <tr>
            <th class="lead text-center"><b>Numfact</b></th>
            <th class="lead text-center"><b>Numcli</b></th>
            <th class="lead text-center"><b>Date</b></th>
            <th class="lead text-center"><b>Etat de la commande</b></th>
            <th class="lead text-center"><b>Montant</b></th>
        </tr>
        <tr>
            <td class="lead text-center"><?= $data['numfact'] ?></td>
            <td class="lead text-center"><?= $data['client'] ?></td>
            <td class="lead text-center"><?= $data['to_char'] ?></td>
            <td class="lead text-center"><?= $data['etat'] ?></td>
            <td class="lead text-center"><?= $data['montant'] . "€" ?></td>
        </tr>
    </table>
<?php } ?>