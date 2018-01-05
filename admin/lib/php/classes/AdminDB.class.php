<?php
class AdminDB {

    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }
    
    public function verifierAdmin($infos){
        try {
            $st = $this->_db->prepare("select verifier_admin(?,?)");
            $st->execute($infos);
            $data = $st->fetch();
            return $data[0];
        } catch (PDOException $e) {
            return -1;
        }
    }
    
    public function setDb(PDO $db) {
        $this->_db = $db;
    }
}