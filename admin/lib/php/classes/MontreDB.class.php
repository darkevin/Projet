<?php
class MontreDB {

    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add($param) {
        try {
            $st = $this->_db->prepare("select add_montre(?,?,?,?,?)");
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