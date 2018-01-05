<?php
//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
$data = filter_input_array(INPUT_POST);
$stock = $data['stock'];
if(($_FILES["fileToUpload"]["tmp_name"]) == null) {
    echo "aucun fichier trouvé <br>";
    header("Location: index.php?page=ajouter.php");
    exit;
}

if(!((is_int($stock) || ctype_digit($stock)) && (int)$stock > 0 )){
    header("Location: index.php?page=ajouter.php");
    exit;  
}
//header("Location: index.php?page=ajouter.php");
 
/* Make sure that code below does not get executed when we redirect. */

if (isset($_POST["submit"])) {
    $source = file_get_contents($_FILES["fileToUpload"]["tmp_name"]);
    
    $data =  my_substring($source, 'var dataLayer = \[', '\];');
    $prix = my_substring($data, 'totalvalue":"', '"');
    $marque = my_substring($data, 'brand":"', '"');
    $genre = my_substring($data, 'gender":"', '"'); 
    $ID = my_substring($data, 'id":', ',');
    
    //$ID = $_FILES["fileToUpload"]["name"];
    $path = "../images/montres/";

    preg_match_all('@src="([^"]+)"@', $source, $match);
    $src = array_pop($match);
    $liste = array();

    $n = 0;
    foreach ($src as $item) {
        if (strpos($item, 'medium') !== false) {
            $n++;
            array_push($liste, $item);
        }
    }
    $total_item = count($liste);
    $i = 1;
    ?>
    <div class="py-5 text-white" style="background-image: url(images/background_add.jpg); height: 100vh;}">
        <div class="container">
            <div class="row ">
                <div class="col-md-8 mx-auto ajouter py-5">
                    <a class="croix lead" href="index.php">x</a>
                    <h1 class="text-gray-light text-light display-4 text-center">Ajout d'une montre</h1>
                    <p class="lead mb-4 text-light text-center">Veuillez attendre la fin des téléchargements pour continuer !</p>
                    <div style="background-color:white; color:black;">
                        <span class='lead mx-2'>Téléchargement des images du carousel : 
                            <?php
                            foreach ($liste as $item) {
                                file_put_contents($path . $ID . '_' . $i . '.jpg', file_get_contents($item));
                                outputProgress($i, $total_item);
                                $i++;
                            }
                        
                        ?>
                    </span>
                </div>
                <div style="background-color:white; color:black;">
                    <?php
                    $dir = $path . $ID . '_' . $n;
                    mkdir($dir);
                    preg_match('/ts\/(.*?)\/m/', $liste[0], $m);
                    $id = $m[1];
                    echo "<span class='lead mx-2'>Téléchargement du modèle 3d :";
                    for ($i = 1; $i < 10; $i++) {
                        $url = 'http://wsprd1.cookieless.cloud/products/3d/' . $id . '/images/I_0' . $i . '.jpg';
                        $img = $dir . '/' . ($i) . '.jpg';
                        file_put_contents($img, file_get_contents($url));
                        outputProgress($i, 72);
                    }
                    for ($i = 10; $i < 73; $i++) {
                        $url = 'http://wsprd1.cookieless.cloud/products/3d/' . $id . '/images/I_' . $i . '.jpg';
                        $img = $dir . '/' . ($i) . '.jpg';
                        file_put_contents($img, file_get_contents($url));
                        outputProgress($i, 72);
                    }
                    echo "</span><br><span class='lead mx-2'>Produit ajouté avec succès !</span>";
                    ?>
                    
    <div class="row py-5">
        <div class="col-md-3">
          <img class="img-fluid d-block mx-auto" src="../images/montres/<?= $ID ?>_1" width="200" height="200"> </div>
        <div class="col-md-9 py-3">
            <span class="lead mx-2"><?= $marque ?> Pour <?= $genre?>s</span><br>
            <span class="lead mx-2"><?= $stock ?> pièces disponibles</span><br>
            <span class="lead mx-2">Prix de vente à <?= $prix ?>€</span><br>
        </div>
      </div>
    </div>
                    
                    
                    
                    
    <?php
    //echo "<div class='lead md-6'>Produit ajouté avec succès !<br>Michael Korse<br>Pour femmes<br>298.00€<img width='200px' height='200px' src='../images/montres/".$ID."_1' /></div>";
    $DB = new MontreDB($cnx);
    $id_marque = $DB->getIdMarque($marque);
    $DB->add(array($prix, $genre[0], (int)$stock, $ID . '_' . $n, $id_marque));
    echo "</div></div></div></div></div>"; 


}

function outputProgress($current, $total) {
    echo "<span style='position: absolute;z-index:$current;background:white;'>&nbsp;" . round($current / $total * 100) . "%&nbsp;</span>";
    myFlush();
    //usleep(50000);
}

function myFlush() {
    echo(str_repeat(' ', 256));
    if (@ob_get_contents()) {
        @ob_end_flush();
    }
    flush();
}

function my_substring($source, $start, $end){
    preg_match('/'.$start.'(.*?)'.$end.'/', $source, $m);  
    return $m[1];
}
