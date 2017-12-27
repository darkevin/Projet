<?php

class VueCommandeDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

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
    
    
}

