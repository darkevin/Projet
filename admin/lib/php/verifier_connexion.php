<?php
if (!isset($_SESSION['admin'])) {
//    header ('Location:../../index.php');
    echo "you are not an admin !";
} else{
    echo "you are an admin !";
}
