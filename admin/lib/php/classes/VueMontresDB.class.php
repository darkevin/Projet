<?php

class VueMontresDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    // récupérer les details des montres pour nourrir la boutique
    function getVueMontres($tab) {
        try {
            if(empty($tab)){
                $query = "select * from vue_montre";
            } else{
                $query = "SELECT * FROM rechercher(?,?,?)";
            }
            
            $resultset = $this->_db->prepare($query);
            $resultset->execute($tab);
            return $resultset->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
//            print ">>>".$e->getMessage();
        }
    }
    
    function getListeMarque(){
        try {
            $query = "select * from marque order by nom";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            return $resultset->fetchAll(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    /**
     * Permet de convertir un simple array en array 2D avec 3 colonnes
     * Pour permettre d'ajouter de façon itérative des row bootsrap
     * avec 3 élément par row
     */
    function getTableau2D($data){
        $size = count($data);
        $reste = $size%3;
        $n = $size - $reste;
        $i=0;
        $container = array();
        while($i<$n){
           $row = array();
           array_push($row, $data[$i++],$data[$i++],$data[$i++]);
           array_push($container, $row);
        }

        if($reste==1 || $reste==2){
           $row = array();
           $reste==1 ? array_push($row, $data[$i++]) : array_push($row, $data[$i++], $data[$i++]);
           array_push($container, $row);
        }
        return $container;
    }

}
