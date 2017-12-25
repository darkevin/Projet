<?php 
if(isset($_SESSION['USER'])){
$tab = $_SESSION['USER'];
$numcli = $tab[0];
$nom = $tab[1];
$prenom = $tab[2];
$mail = $tab[3];
$adresse1 = $tab[4] . " " . $tab[5];
$adresse2 = $tab[6] . " " . $tab[7];
?>
<!-- Modal HTML Markup -->
<div id="ModalOrder" class="modal fade">
    <div class="modal-dialog" role="document">
        <div id="corpus" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Récapitulatif de votre commande</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div  class="modal-body chyzy">
                <b>Numéro de commande : </b><span id="NUMCOMMANDE"></span><br>
                <b>Montant : </b><span id="MONTANT"></span>€<br>
                <b>Adresse de livraison :</b>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                                <?= $prenom ?> <?= $nom ?><br>
                                <?= $adresse1 ?><br>
                                <?= $adresse2 ?><br>
                        </div>
                    </div>
                </div>
                Votre commande sera traitée dans les plus brefs delais !<br>
                Vous pouvez suivre l'état de vos commandes <a href="">ici</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php }