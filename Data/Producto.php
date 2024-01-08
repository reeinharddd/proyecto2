<?php
include_once('Requisicion.php');
class Producto extends Requisicion{

    //Atributos
    private $idProducto;

    //Getter & Setters
    public function setIdProducto($idProducto){
        $this->idProducto = $idProducto;
    }
    public function getIdProducto(){
        return $this->idProducto;
    }

    //Métodos
    public function getTipoProducto(){
        $query = "SELECT idTipoProducto from productos WHERE idProducto = $this->idProducto";
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