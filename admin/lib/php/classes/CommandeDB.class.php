<?php
class CommandeDB{
    
    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }
    
    public function add($commande) { // ajouter une commande
        try {
            $st = $this->_db->prepare("select create_commande(?,?)");
            $st->execute($commande);
            return $st->fetch()[0];
        } catch (PDOException $e) { //Catch any errors
            return $e->getMessage();
        }
    }
    
    public function add_ligne($param){ // ajouter une ligne (d'une commande)
        try {
            $st = $this->_db->prepare("select add_ligne(?,?,?)");
            $st->execute($param);
            return true;
        } catch (PDOException $e) { //Catch any errors
            return false;
        }
    }
    
    public function detail_commande($num){ // récupérer toutes lignes d'une commande
        try {
            $resultset = $this->_db->prepare("select * from detail_commande(?)");
            $resultset->execute(array($num));
            return $resultset->fetchAll();
        } catch (PDOException $e) { //Catch any errors
            return NULL;
        }
    }
    
    public function changer_etat($param){ // changer l'état d'une commande
        try {
            $resultset = $this->_db->prepare("select changer_etat(?,?)");
            $resultset->execute($param);
            return true;
        } catch (PDOException $e) { //Catch any errors
            return false;
        }
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}