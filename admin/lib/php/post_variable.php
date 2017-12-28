<?php

//création d'une variable post qui sera utilisée par ajax pour télécharger le pdf
include ('settings.php');
$data = filter_input_array(INPUT_POST);
$_SESSION['pdf_var'] = $data['numfact'];
$_SESSION['mode'] = $data['mode'];
