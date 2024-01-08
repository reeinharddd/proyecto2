<?php
include_once('conexionDB.php');
class Prioridad extends conexionDB{
    
    //Atributos
    //Getters & Setters
    //Metodos

    public function getAllPrioridades(){
        $query = "SELECT * from prioridades";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
}
?>