<?php
class MontreDB {

    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add($param) { // ajouter une montre
        try {
            $st = $this->_db->prepare("select add_montre(?,?,?,?,?)");
            $st->execute($param);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function getIdMarque($marque){
        try {
            $st = $this->_db->prepare("select verifier_marque(?)");
            $st->bindValue(1, $marque);
            $st->execute();
            $data = $st->fetch();
        } catch (PDOException $e) {
            return 0;
        }
        return $data[0];
    }
    
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}