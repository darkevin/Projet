<?php
$DB = new VueMontresDB($cnx);
$rs = $DB->getListeMarque();
$GET = filter_input_array(INPUT_GET); 
$a = $GET['brand'] ?? ''; 
$b = $GET['cat'] ?? ''; 
$c = $GET['sort'] ?? ''; 
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
                                    <option class="lead" value="<?= $marque[1] ?>" <?= $a== $marque[1] ? 'selected':''?>><?= $marque[1] ?></option>
                                <?php } ?>
                            </select>  
                        </div>
                        <div class="form-group text-dark lead"> 
                            <label>Catégorie :</label>
                            <select name="cat" class="form-control form-control-lg">
                                <option class="lead" value="%" <?= $b == '%' ? 'selected':''?>>Hommes et Femmes</option>
                                <option class="lead" value="h" <?= $b == 'h' ? 'selected':''?>>Hommes</option>
                                <option class="lead" value="f" <?= $b == 'f' ? 'selected':''?>>Femmes</option>
                            </select> 
                        </div>
                        <div class="form-group text-dark lead"> 
                            <label>Prix :</label>
                            <select name = "sort" class="form-control form-control-lg">
                                <option class="lead" value="1"  <?= $c == '1'  ? 'selected':''?>>Ordre croissant</option>
                                <option class="lead" value="-1" <?= $c == '-1' ? 'selected':''?>>Ordre décroissant</option>
                            </select> 
                        </div>
                        <button type="submit" class="btn btn-primary float-right border border-silver">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php function check($a, $b){
    if(isset($a)){
        echo $b;
    }
}