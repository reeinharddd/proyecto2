<?php
include("../../Data/conexionDB.php");
class SolTecnica extends conexionDB{

    
    public function getAllSolicitudTec(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("Select * from solicitudes_tec");
        }
        else{
            echo "No conecto";
            $dataset = "error";
        }
        return $dataset;
    }
    
    public function getNombreCompletoUsuario($user_id){
        $query = "SELECT * FROM usuarios WHERE user_id = $user_id";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
            $tupla  = mysqli_fetch_assoc($dataset);
            $nombre = $tupla['first_name'];
            $apellido =$tupla['last_name'];
            $nombreCompleto  = $nombre." ".$apellido;
        }
        else{
            $nombreCompleto = "error";
        }
        return $nombreCompleto;
    }
}
?>