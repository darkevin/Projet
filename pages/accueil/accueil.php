<?php

$tab = array("intro", "collections", "nouveautes", "download_appli", "footer");
$src = "pages/accueil/";
foreach ($tab as $nomFichier) {
    $file = $src . $nomFichier . ".php";
    file_exists($file) AND include $file;
}
