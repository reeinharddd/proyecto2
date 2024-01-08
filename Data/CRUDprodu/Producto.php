<?php
include('../../Data/conexionDB.php');
class Producto extends conexionDB{
    private $idProducto;
    private $nomProducto;
    private $descripcion;
    private $tipoEntrega;
    private $idCatProducto;
    private $idDepaProducto;
    private $idTipoProducto;

    public function setTipoEntrega($tipoEntrega){
        $this->tipoEntrega = $tipoEntrega;
    }
    public function setNomProducto($nomProducto){
        $this->nomProducto = $nomProducto;
    }
    public function setDescProducto($descripcion){
        $this->descripcion = $descripcion;
    }
    public function setCategoria($idCatProducto){
        $this->idCatProducto = $idCatProducto;
    }
    public function setDepaProducto($idDepaProducto){
        $this->idDepaProducto = $idDepaProducto;
    }
    public function setProducto(){
        $query = "insert into productos (nomProducto, descripcion, tipoEntrega, idCatProducto, idDepaProducto) values ('".$this->nomProducto."','".$this->descripcion."','".$this->tipoEntrega."','".$this->idCatProducto."','".$this->idDepaProducto."')";
        $result = $this->connect();
        if ($result){
            $newid = $this->execinsert($query);
        }
        else{
            $newid = 0;
        }
        return $newid;
    }
    public function getAllProductos(){
        $query = "SELECT * from productos";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getNomProducto($idProducto){
        $query = "SELECT nomProducto from productos WHERE idProducto = ".$idProducto;
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getProductoById($idProducto){
        $query = "SELECT * FROM productos WHERE idProducto = $idProducto";
        $result = $this->connect();
        if ($result) {
            $dataset = mysqli_fetch_assoc($this->execquery($query));
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function setUpdateProducto($idProducto){
        $query = "UPDATE productos SET nomProducto = '".$this->nomProducto."', descripcion = '".$this->descripcion."' WHERE idProducto = $idProducto";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        } else {
            $dataset = "error";
        }
        return $dataset;
    }
    public function deleteProducto($idProducto) {
        $query = "DELETE FROM  productos WHERE idProducto = $idProducto";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }
    public function getAllCategorias(){
        $query = 'SELECT * from categorias';
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
    public function getAllDepaSinMantenimiento(){
        $query = "SELECT * from departamentos WHERE nomDepartamento NOT IN('Mantenimiento')";
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