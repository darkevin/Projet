<?php

class VueCommandeDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    // récupérer les commandes d'un client sur base de l'id du client
    function getListeCommandes($idcli) {
        try {
            $query = "SELECT * FROM liste_commande(?)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $idcli);
            $resultset->execute();
            return $resultset->fetchAll();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    // récupérer la liste des numfact d'un client sur base de l'id du client 
    function getListeIdCommandes($idcli) {
        try {
            $query = "SELECT * FROM liste_id_commande(?)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $idcli);
            $resultset->execute();
            return $resultset->fetchAll(PDO::FETCH_COLUMN, 0);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    // récupérer les infos d'un commande (filtre sur une vue)
    function getDetailCommande($id) {
        try {
            $query = "SELECT * FROM detail_commande(?)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->execute();
            $data = $resultset->fetchAll();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $data;
    }
    
    // récupérer la date formatée en français d'une commande
    function getDateCommande($id){
        try {
            $query = "SELECT date_commande(?)";
            $resultset = $this->_db->prepare($query);
            $resultset->bindValue(1, $id);
            $resultset->execute();
            $data = $resultset->fetch();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
        return $data[0];
    }
    
}

