<?php if (!isset($_SESSION['USER'])) { ?>
    <div class="py-5 text-white opaque-overlay" style="background-image: url(images/formulaire6.jpg);">
        <div  class="container">
            <div  class="row">
                <div id="formulaire_inscription" class="col-md-8 mx-auto">
                    <h1 class="text-gray-dark">Formulaire d'inscription</h1>
                    <p class="lead mb-4">Compléter le formulaire ci-dessous pour vous inscrire.</p>
                    <form id="form_ins" class="" method="post" action="">
                        <div class="form-group"> 
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom"> 
                        </div>
                        <div class="form-group"> 
                            <label for="prenom">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom"> 
                        </div>
                        <div class="form-group"> 
                            <label for="mail">Adresse email</label>
                            <input type="email" id="mail" name="email" class="form-control" placeholder="Entrez votre adresse email"> 
                        </div>
                        <div class="form-group"> 
                            <label for="pw1">Mot de passe</label>
                            <input type="password" id="pw1" name="pw1" class="form-control" placeholder="Entrez votre adresse"> 
                        </div>
                        <div class="form-group"> 
                            <label for="pw2">Mot de passe</label>
                            <input type="password" id="pw2" name="pw2" class="form-control" placeholder="Entrez votre mot de passe"> 
                        </div>

                        <div class="form-group"> 
                            <label for="numero">Numéro</label>
                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Entrez votre numéro"> 
                        </div>
                        <div class="form-group"> 
                            <label for="adresse">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Entrez votre adresse"> 
                        </div>
                        <div class="form-group"> 
                            <label for="cp">Code Postal</label>
                            <input type="text" id="cp" name="cp" class="form-control" placeholder="Entrez votre code postal"> 
                        </div>
                        <div class="form-group"> 
                            <label for="localite">Localité</label>
                            <input type="text" id="localite" name="localite" class="form-control" placeholder="Entrez votre localité"> 
                        </div>
                        <button  id="envoi" type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="modal_inscription" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation d'incription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><div id="recap_inscription"></div></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">M'inscrire</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Retour</button>
                </div>
            </div>
        </div>
    </div>

<?php } else {
    $tab = $_SESSION['USER'];
    $numcli = $tab[0];
    $nom = $tab[1];
    $prenom = $tab[2];
    $mail = $tab[3];
    $adresse1 = $tab[4] . " " . $tab[5];
    $adresse2 = $tab[6] . " " . $tab[7];
    ?>
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card">
                        <div class="card-header" contenteditable="true">Informations fournies lors de l'inscription</div>
                        <div class="card-body">
                            <h6 class="text-muted">Numéro de client : <?= $numcli ?></br></h6>
                            <p class=" p-y-1">
                                <?= $prenom ?> <?= $nom ?></br>
                                <?= $adresse1 ?></br>
                                <?= $adresse2 ?></br>
                                <?= $mail ?></br>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }