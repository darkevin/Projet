<?php
include ('../settings.php');
$data = filter_input_array(INPUT_POST);
$id = $data['id'];
$new_stock = $data['valeur'];

$DB = new MontreDB($cnx);
$DB->updateDispo(array($id, $new_stock));
