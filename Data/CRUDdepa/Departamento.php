<?php
include('../../Data/conexionDB.php');
class Departamento extends conexionDB{
    private $idDepartamento;
    private $nomDepartamento;
    private $descripcion;
    private $numTel;
    
    public function setidDepartamento($idDepartamento){
        $this->idDepartamento = $idDepartamento;
    }
    public function setNomDepartamento($nomDepartamento){
        $this->nomDepartamento = $nomDepartamento;
    }
    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setTelDepa($numTel){
        $this->numTel = $numTel;
    }
    public function setDepartamento(){
        $query = "insert into departamentos (nomDepartamento, descripcion, numTel) values ('".$this->nomDepartamento."','".$this->descripcion."','".$this->numTel."')";
        $result = $this->connect();
        if ($result){
            $newid = $this->execinsert($query);
        }
        else{
            $newid = 0;
        }
        return $newid;
    }
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
    public function getDepaById($idDepartamento){
        $query = "SELECT * FROM departamentos WHERE idDepartamento = $idDepartamento";
        $result = $this->connect();
        if ($result) {
            $dataset = mysqli_fetch_assoc($this->execquery($query));
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function setUpdateDepa($idDepartamento){
        $query = "UPDATE departamentos SET nomDepartamento = '".$this->nomDepartamento."', descripcion = '".$this->descripcion."', numTel = '".$this->numTel."' WHERE idDepartamento = $idDepartamento";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        } else {
            $dataset = "error";
        }
        return $dataset;
    }
    public function deleteDepa($idDepartamento) {
        $query = "DELETE FROM  departamentos WHERE idDepartamento = $idDepartamento";
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