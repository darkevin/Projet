<?php
include './lib/php/verifier_connexion.php';
?>

<div class="py-5">
    <div class="container">
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-4 " ><i class="fa fa-cloud-download fa-5x" aria-hidden="true"></i></div>
            <div class="col-8">
              <h5 class="mb-3"><b><a href="index.php?page=ajouter.php">Ajouter une montre</a></b></h5>
              <p class="my-1">Ajout automatique d'une montre sur base du code source d'une montre disponible sur <a href="http://www.watchshop.fr/">watchshop.fr</a></p>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-4"><i class="fa fa-pencil-square-o fa-5x" aria-hidden="true"></i></div>
            <div class="col-8">
              <h5 class="mb-3"><b><a href="index.php?page=modifier.php">Modifier l'état d'une commande</a></b></h5>
              <p class="my-1">Permet de changer l'état d'une commande sur base de son numéro de facture.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-4"><i class="fa fa-database fa-5x" aria-hidden="true"></i></div>
            <div class="col-8">
              <h5 class="mb-3"><b><a href="index.php?page=gerer.php">Gestion des stocks et des clients</a></b></h5>
              <p class="my-1">Permet de mettre à jour les stocks et les informations des clients.</p>
            </div>
          </div>
        </div>
        <div class="py-5 col-md-6">
          <div class="row">
            <div class="text-center col-4"><i class="fa fa-sign-out fa-5x" aria-hidden="true"></i></div>
            <div class="col-8">
              <h5 class="mb-3"><b><a href="index.php?page=deconnecter.php">Se déconnecter</a></b></h5>
              <p class="my-1">Déconnectez-vous en toute sécurité !</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
