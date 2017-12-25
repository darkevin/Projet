<?php

class VueMontresDB {

    private $_db;

    function __construct($_db) {
        $this->_db = $_db;
    }

    function getVueMontres() {
        try {
            $query = "SELECT * FROM vue_montre";
            $resultset = $this->_db->prepare($query);
            $resultset->execute();
            return $resultset->fetchAll();
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
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
