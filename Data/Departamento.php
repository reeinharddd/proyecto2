<?php
include('conexionDB.php');
class Departamento extends Requisicion{

    public function getAllDepartamento(){
        $query = "SELECT * from departamentos";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getNombreDepartamento($idDepartamento){
        $query = "SELECT nomDepartamento from departamentos WHERE idDepartamento = ".$idDepartamento;
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