<?php
$DB = new VueMontresDB($cnx);
$rs = $DB->getListeMarque();
?>
<div id="ModalSearch" class="modal fade">
    <div class="modal-dialog" role="document">
        <div  class="modal-body modal-body-search">
            <div  class="modal-content">
                <div id="corpus_search" class="card-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h1 class="mb-4 lead text-dark font-30 display-4 text-center">Critères de recherche :</h1>
                    <form>
                        <select name="page" hidden>
                            <option value="produits.php"></option>
                        </select>  
                        <div class="form-group text-dark lead"> 
                            <label>Marque :</label>
                            <select name="brand" class="form-control form-control-lg">
                                <option class="lead" value="%">Toutes les marques</option>
                                <?php foreach ($rs as $marque) { ?>
                                    <option class="lead" value="<?= $marque[1] ?>"><?= $marque[1] ?></option>
                                <?php } ?>
                            </select>  
                        </div>
                        <div class="form-group text-dark lead"> 
                            <label>Catégorie :</label>
                            <select name="cat" class="form-control form-control-lg">
                                <option class="lead" value="%">Hommes et Femmes</option>
                                <option class="lead" value="h">Hommes</option>
                                <option class="lead" value="f">Femmes</option>
                            </select> 
                        </div>
                        <div class="form-group text-dark lead"> 
                            <label>Prix :</label>
                            <select name = "sort" class="form-control form-control-lg">
                                <option class="lead" value="1">Ordre croissant</option>
                                <option class="lead" value="-1">Ordre décroissant</option>
                            </select> 
                        </div>
                        <button type="submit" class="btn btn-primary float-right border border-secondary">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>