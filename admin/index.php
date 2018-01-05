<?php
include ('lib/php/settings.php');
//$_SESSION['admin']=1;
?>
<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>Watch For All</title>
        <link rel="stylesheet" href="lib/css/font-awesome-4.7.0/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="lib/css/bootstrap-4.0.0-beta.2-dist/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="lib/css/style.css" type="text/css" >
        <link rel="stylesheet" href="lib/css/style_panier.css" type="text/css" >
    </head>
    
    <body>
        <?php
        $menubar = "lib/php/menu_bar.php"; 
        file_exists($menubar) AND include $menubar;
        if (!isset($_SESSION['admin'])) { // pas connecté en admin
            $_SESSION['page_admin'] = "./pages/admin_login.php";
        } else { //connecté en admin
//            if (!isset($_SESSION['page_admin'])) {
//                $_SESSION['page_admin'] = "./pages/accueil_admin.php";
//            } else {
                if (isset($_GET['page'])) {
                    $_SESSION['page_admin'] = "./pages/" . $_GET['page'];
                } else{
                    $_SESSION['page_admin'] = "./pages/accueil_admin.php";
                }
//            }
        }
       // print $_SESSION['page_admin'];  
        if (file_exists($_SESSION['page_admin'])) {
            include $_SESSION['page_admin'];
        } else {
            print "OUPS!!!!!";
        }
        ?>
        
        <script src="lib/js/popper.min.js" ></script>
        <script src="lib/js/jquery-3.2.1.min.js"></script>
        <script src="lib/js/messagesJqueryVal.js"></script>
        <script src="lib/css/bootstrap-4.0.0-beta.2-dist/js/bootstrap.min.js"></script>
        <script src="lib/js/fonctions.js"></script>
        <script src="lib/js/jquery.validate.js"></script>
        <script src="lib/js/functionsJqueryVal.js" type="text/javascript"></script>
        <script src="lib/js/rotate.js" type="text/javascript" ></script>
    
    </body>
    
</html>
