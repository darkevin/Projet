<?php
$msg="";
$data = filter_input_array(INPUT_POST); 
if (isset($data['submit_login'])) {
    $DB = new AdminDB($cnx);
    $data = $DB->verifierAdmin(array($data['login'], $data['password']));
    if ($data == null){
        $msg = "Données incorrectes !";
    }
    else {
        $_SESSION['admin'] = 1;
        $msg= "authentifié !";?>
        <meta http-equiv = "refresh" content = "0;url=index.php"><?php
    }
}
?>
<div class="py-5 text-white" style="background-image: url(images/background_add.jpg); height: 100vh;}">
    <div class="container">
        <div class="row ">
            <div class="col-md-6 mx-auto ajouter ">
                <a class="croix lead" href="../index.php">x</a>
                <h1 class="text-gray-light text-light display-4 text-center ">Administration</h1>
                <p class="lead mb-4 text-light text-center">Veuillez vous identifier pour continuer.</p>
                <section class=' lead font-30 red text-center'><b><?= $msg ?></b></section>
                
                <form action="<?php print $_SERVER['PHP_SELF']; ?>" method='post' id="form_auth_">    
                    <div class="form-group">
                        <label class="lead form-control-label text-light">Login :<br></label>
                        <input type="text" name="login" class="form-control" placeholder="Entrez votre login">
                    </div>
                    <div class="form-group">
                        <label class="lead form-control-label text-light">Mot de passe :<br></label>
                        <input type="password" name="password" class="form-control" placeholder="Entrez votre mot de passe">
                    </div><br>
                    <button type="submit" name="submit_login"  class="btn btn-primary float-right">Se connecter</button>   
                </form>
            </div>
        </div>
    </div>
</div>