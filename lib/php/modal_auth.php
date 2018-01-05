<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div id="corpus" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Authentification :<span id="auth_denied" class="red" ></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                
            </div>
            <div  class="modal-body">
                
                <form id="form_auth" role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label for="auth_email" class="control-label">Votre adresse email</label>
                        <div>
                            <input id="auth_email" type="email" class="form-control input-lg" name="email" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="auth_password" class="control-label">Votre mot de passe</label>
                        <div>
                            <input id="auth_password" type="password" class="form-control input-lg" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <button id="user_auth" type="submit" class="btn btn-primary ">S'authentifier</button>
                        <a class="btn btn-primary" href="index.php?page=inscription.php">S'inscrire</a>
                    </div>
                    
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
