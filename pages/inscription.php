<?php if (isset($_SESSION['USER'])) {
    echo '<meta http-equiv = "refresh" content = "0;url=index.php">';
    exit();
} else { ?>
    <div class="py-5 text-white opaque-overlay" style="background-image: url(images/background_form.jpg);">
        <div  class="container">
            <div  class="row">
                <div id="formulaire_inscription" class="col-md-8 mx-auto">
                    <h1 class="text-gray-dark text-center lead display-4">Formulaire d'inscription</h1>
                    <p class="lead mb-4 text-center">Compléter le formulaire ci-dessous pour vous inscrire.</p>
                    <form id="form_ins" class="" method="post" action="">
                        <div class="form-group"> 
                            <label for="nom" class="lead">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez votre nom"> 
                        </div>
                        <div class="form-group"> 
                            <label for="prenom" class="lead">Prénom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez votre prénom"> 
                        </div>
                        <div class="form-group"> 
                            <label for="mail" class="lead">Adresse email</label>
                            <input type="email" id="mail" name="email" class="form-control" placeholder="Entrez votre adresse email"> 
                        </div>
                        <div class="form-group"> 
                            <label for="pw1" class="lead">Mot de passe</label>
                            <input type="password" id="pw1" name="pw1" class="form-control" placeholder="Entrez votre adresse"> 
                        </div>
                        <div class="form-group"> 
                            <label for="pw2" class="lead">Mot de passe</label>
                            <input type="password" id="pw2" name="pw2" class="form-control" placeholder="Entrez votre mot de passe"> 
                        </div>

                        <div class="form-group"> 
                            <label for="numero" class="lead">Numéro</label>
                            <input type="text" id="numero" name="numero" class="form-control" placeholder="Entrez votre numéro"> 
                        </div>
                        <div class="form-group"> 
                            <label for="adresse" class="lead">Adresse</label>
                            <input type="text" id="adresse" name="adresse" class="form-control" placeholder="Entrez votre adresse"> 
                        </div>
                        <div class="form-group"> 
                            <label for="cp" class="lead">Code Postal</label>
                            <input type="text" id="cp" name="cp" class="form-control" placeholder="Entrez votre code postal"> 
                        </div>
                        <div class="form-group"> 
                            <label for="localite" class="lead">Localité</label>
                            <input type="text" id="localite" name="localite" class="form-control" placeholder="Entrez votre localité"> 
                        </div>
                        <button  id="envoi" type="submit" class="btn btn-primary float-right">Envoyer</button>
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
<?php } ?>