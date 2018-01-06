<?php
include './lib/php/verifier_connexion.php';
?>

<div class="py-5 text-white" style="background-image: url(images/background_add.jpg); height: 100vh;}">
  <div class="container">
    <div class="row ">
      <div class="col-md-8 mx-auto ajouter py-5">
          <a class="croix lead" href="index.php">x</a>
        <h1 class="text-gray-light text-light display-4 text-center">Ajout d'une montre</h1>
        <p class="lead mb-4 text-light text-center">Veuillez compléter tous les champs pour ajouter une montre.</p>
        <form class="" method="post" action="index.php?page=upload.php" enctype="multipart/form-data">
<!--            <div class="form-group"> <label class="lead text-light">Prix en euros :</label>
            <input type="email" name="email" class="form-control" placeholder="Entrez le prix de la montre"> </div>-->
          <!--<div class="form-group"><label class="lead form-control-label text-light">Sexe :</label><select class="form-control"><option value="1">Pour hommes</option><option value="2">Pour femmes</option><option value="3">Pour hommes et femmes</option></select></div>-->
          <div class="form-group"><label class="lead form-control-label text-light">Stock disponible :<br></label>
            <input type="text" name="stock" class="form-control" placeholder="Entrez le stock disponible">
          </div>
          <!--<div class="form-group"><label class="lead form-control-label text-light">Marque de la montre :</label><select class="form-control"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div>-->

          <div class="form-group">
              <label class="lead form-control-label text-light">Code source de la montre :</label>
              <label class="custom-file w-100">
                  <input type="file" class="custom-file-input w-100" name="fileToUpload" id="fileToUpload">
                  <label id="msg_upload" for="fileToUpload" class="custom-file-control">Choisir un fichier ...</label>
              </label>
          </div>
          <!--<button type="submit" class="btn btn-primary">Send</button>-->
          <button type="submit" value="Upload Image" name="submit" class="btn btn-primary float-right">Ajouter la montre</button>   

        </form>
      </div>
    </div>
  </div>
</div>
