<?php
include("../../Data/conexionDB.php");
class Area extends conexionDB{
    private $idArea;
    private $nombre;
    private $ubicacion;
    private $idDepartamento;

    public function setNomArea($nombre){
        $this->nombre = $nombre;
    }
    public function setUbi($ubicacion){
        $this->ubicacion = $ubicacion;
    }
    public function setDepa($idDepartamento){
        $this->idDepartamento = $idDepartamento;
    }
    
    public function setArea(){
        $query = "insert into areas (nombre, ubicacion, idDepartamento) values ('".$this->nombre."','".$this->ubicacion."', '".$this->idDepartamento."')";
        $result = $this->connect();
        if ($result){
            $newid = $this->execinsert($query);
        }
        else{
            $newid = 0;
        }
        return $newid;
    }
    public function getAllArea(){
        $query = "SELECT * from areas";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getNomArea($idArea){
        $query = "SELECT nombre from areas WHERE idArea = ".$idArea;
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getAreaById($idArea){
        $query = "SELECT * FROM areas WHERE idArea = $idArea";
        $result = $this->connect();
        if ($result) {
            $dataset = mysqli_fetch_assoc($this->execquery($query));
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function setUpdateArea($idArea){
        $query = "UPDATE areas SET nombre = '".$this->nombre."', ubicacion = '".$this->ubicacion."' WHERE idArea = $idArea";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        } else {
            $dataset = "error";
        }
        return $dataset;
    }
    public function deleteArea($idArea) {
        $query = "DELETE FROM  areas WHERE idArea = $idArea";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getAllDepa(){
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
            if ($dataset !== null) { // Verifica si $dataset no es null
                $count = mysqli_num_rows($dataset);
                if ($count == 1) {
                    $tupla = mysqli_fetch_assoc($dataset);
                    $nombre = $tupla['nomDepartamento'];
                }
            }
        }
        else{
            $nombre = "error";
        }
        return $nombre;
    }
}
?>
?>