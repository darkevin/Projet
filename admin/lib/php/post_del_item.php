<?php
function first($str){return explode('_', $str)[0].'_1';}
include ('settings.php');

$data = filter_input_array(INPUT_POST);
$i = $data['num_ligne'];
unset($_SESSION['PANIER'][$i]);
$_SESSION['PANIER'] = array_values($_SESSION['PANIER']);