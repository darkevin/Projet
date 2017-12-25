<?php

class ClientDB {

    private $_db; // Instance de PDO.

    public function __construct($db) {
        $this->setDb($db);
    }

    public function add(Client $client) {
        try {
            $st = $this->_db->prepare("select create_client(?,?,?,?,?,?,?,?)");
            $st->execute($client->toArrayWithoutKeys());
            return true;
        } catch (PDOException $e) { //Catch any errors
            //echo "Could not connect to database: " . $e->getMessage() . "\n";
            return false;
        }
    }

    public function delete(Client $client) {
        // Exécute une requête de type DELETE.
    }

    public function get($id) {
        // Exécute une requête de type SELECT avec une clause WHERE, et retourne un objet Personnage.
    }

    public function getList() {
        // Retourne la liste de tous les personnages.
    }

    public function update(Personnage $perso) {
        // Prépare une requête de type UPDATE.
        // Assignation des valeurs à la requête.
        // Exécution de la requête.
    }

    public function setDb(PDO $db) {
        $this->_db = $db;
    }

}
