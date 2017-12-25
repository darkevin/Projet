<?php
class CommandeDB{
    
    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }
    
    public function add($commande) {
        try {
            $st = $this->_db->prepare("select create_commande(?,?)");
            $st->execute($commande);
            return $st->fetch()[0];
        } catch (PDOException $e) { //Catch any errors
            return $e->getMessage();
        }
    }
    
    public function add_ligne($param){
        try {
            $st = $this->_db->prepare("select add_ligne(?,?,?)");
            $st->execute($param);
            return true;
        } catch (PDOException $e) { //Catch any errors
            //echo "Could not connect to database: " . $e->getMessage() . "\n";
            return false;
        }
    }
    
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}