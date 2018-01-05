<div class="py-5 text-white" style="background-image: url(images/background_add.jpg); height: 100vh;}">
  <div class="container">
    <div class="row ">
      <div class="col-md-8 mx-auto ajouter py-5">
        <h1 class="text-gray-light text-light display-4 text-center">Ajout d'une montre</h1>
        <p class="lead mb-4 text-light text-center">Veuillez compléter tous les champs pour ajouter une montre.</p>
        <form class="" method="post" action="lib/php/upload.php" enctype="multipart/form-data">
<!--            <div class="form-group"> <label class="lead text-light">Prix en euros :</label>
            <input type="email" name="email" class="form-control" placeholder="Entrez le prix de la montre"> </div>-->
          <!--<div class="form-group"><label class="lead form-control-label text-light">Sexe :</label><select class="form-control"><option value="1">Pour hommes</option><option value="2">Pour femmes</option><option value="3">Pour hommes et femmes</option></select></div>-->
          <div class="form-group"><label class="lead form-control-label text-light">Stock disponible :<br></label>
            <input type="text" class="form-control" placeholder="Entrez le stock disponible">
          </div>
          <!--<div class="form-group"><label class="lead form-control-label text-light">Marque de la montre :</label><select class="form-control"><option value="1">1</option><option value="2">2</option><option value="3">3</option></select></div>-->

          <div class="form-group">
              <label class="lead form-control-label text-light">Code source de la montre :</label>
              <label class="custom-file w-100">
                  <input type="file" class="custom-file-input w-100" name="fileToUpload" id="fileToUpload">
                  <label for="fileToUpload" class="custom-file-control">Choisir un fichier ...</label>
              </label>
          </div>
          <!--<button type="submit" class="btn btn-primary">Send</button>-->
          <button type="submit" value="Upload Image" name="submit" class="btn btn-primary float-right">Ajouter la montre</button>   

        </form>
      </div>
    </div>
  </div><br><br><br><br>
</div>
<?php

include ('settings.php');
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $source= file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    $ID =  $_FILES["fileToUpload"]["name"];
    $path = "../../../images/montres/";
    
    preg_match_all( '@src="([^"]+)"@' , $source, $match );
    $src = array_pop($match);
    $liste = array();
    
    $n=0;
    foreach($src as $item){
        if (strpos($item, 'medium') !== false){
            $n++;
            array_push($liste, $item);
        }
    }
    
    $total_item = count($liste);
    $i=1;
    echo "Téléchargement des images :";
    foreach($liste as $item){
        file_put_contents($path.$ID.'_'.$i.'.jpg', file_get_contents($item));
        outputProgress($i, $total_item);
       $i++;
    }
    echo "<br>";
    
    $dir=$path.$ID.'_'.$n;
    mkdir($dir);
    
    preg_match('/ts\/(.*?)\/m/', $liste[0], $m);
    $id = $m[1];
    echo "Téléchargement du modèle 3d :";
    for($i=1; $i<10; $i++){
        $url = 'http://wsprd1.cookieless.cloud/products/3d/'.$id.'/images/I_0'.$i.'.jpg';
        $img = $dir.'/'.($i).'.jpg';
        file_put_contents($img, file_get_contents($url));
        outputProgress($i, 72);
    }

    for($i=10; $i<73; $i++){
        $url = 'http://wsprd1.cookieless.cloud/products/3d/'.$id.'/images/I_'.$i.'.jpg';
        $img = $dir.'/'.($i).'.jpg';
        file_put_contents($img, file_get_contents($url));
        outputProgress($i, 72);
    }
    
    $DB = new MontreDB($cnx);
    $DB->add(array(199,'f',50,$ID.'_'.$n,1));
    
}

    function outputProgress($current, $total) {
        echo "<span style='position: absolute;z-index:$current;background:#FFF;'>&nbsp;" . round($current / $total * 100) . "% </span>";
        myFlush();
    }

    function myFlush() {
        echo(str_repeat(' ', 256));
        if (@ob_get_contents()) {
            @ob_end_flush();
        }
        flush();
    }

//if(isset($_POST["submit"])) {
//    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//    if($check !== false) {
//        echo "File is an image - " . $check["mime"] . ".";
//        $uploadOk = 1;
//    } else {
//        echo "File is not an image.";
//        $uploadOk = 0;
//    }
//}