<?php
include ('../settings.php');
$data = filter_input_array(INPUT_POST);
$id = $data['id'];
$dispo = $data['dispo'];
$DB = new MontreDB($cnx);
$DB->updateDispo(array($id, $dispo));
