<?php
include("../../Data/conexionDB.php");
class Solicitud extends conexionDB{
    public function getAllSolicitud(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("Select * from solicitudes");
        }
        else{
            echo "No conecto";
            $dataset = "error";
        }
        return $dataset;
    }
    public function getAllUsuario(){
        $result = $this->connect();
        if ($result == true){
            //echo "Conecto";
            $dataset = $this->execquery("Select * from usuarios where status = 'activo'");
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
    public function getNombreProducto($producto){
        $query = "SELECT * from productos where idProducto = $producto";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
            if ($dataset !== null) { // Verifica si $dataset no es null
                $count = mysqli_num_rows($dataset);
                if ($count == 1) {
                    $tupla = mysqli_fetch_assoc($dataset);
                    $nombre = $tupla['nomProducto'];
                }
            }
        }
        else{
            $nombre = "error";
        }
        return $nombre;
    }
    public function getNombrePrioridad($prioridad){
        $query = "SELECT * from prioridades WHERE idPrioridad =".$prioridad;
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
            if ($dataset !== null) { // Verifica si $dataset no es null
                $count = mysqli_num_rows($dataset);
                if ($count == 1) {
                    $tupla = mysqli_fetch_assoc($dataset);
                    $nombre = $tupla['nombre'];
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