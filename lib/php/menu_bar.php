<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" width="" height="30" class="d-inline-block align-top" alt="">&nbsp;Watch For All
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar2SupportedContent" aria-controls="navbar2SupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span> 
        </button>
        <div class="collapse navbar-collapse text-center justify-content-end w-100 " id="navbar2SupportedContent">
            <ul id="barre_menu" class="navbar-nav">
                <li class="nav-item bg-dark">
                    <a id="rechercher" class="btn btn-default navbar-btn mx-2" ><i  class="fa fa-search text-primary" aria-hidden="true"></i></a>  
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link _dropdown-toggle"  href="" id="panier" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Panier</a>
                    <div id="liste_panier" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    </div>
                </li>

                <li id="compte" class="nav-item dropdown bg-dark">
                    <a class="nav-link _dropdown-toggle"  href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-fw"></i>Compte</a>
                    <div  class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if(isset($_SESSION['USER'])) {?>
                        <a id="deco" class="dropdown-item" href="#">Se déconnecter</a>
                        <a id="commande" class="dropdown-item" href="index.php?page=commandes.php">Consulter mes commandes</a>
                        <?php } else {?>
                        <a class="dropdown-item" href="index.php?page=inscription.php">S'inscrire</a>
                        <a  class="auth dropdown-item" href="#">Se connecter</a>
                        <?php } ?>
                    </div>
                </li>

                <li class="nav-item bg-dark">
                    <a class="nav-link" href="index.php?page=contact.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact</a>
                </li>


            </ul>         

            <div id="feedback"></div>

        </div>
    </div>
</nav>

<?php 
include ('modal_auth.php'); 
include ('modal_rechercher.php'); 