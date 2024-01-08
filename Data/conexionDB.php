<?php
//conexionDB.php
//nombre de la clase, nivel de acceso
//atributos, constructor, metodos get-set, otros

class conexionDB{
    private $HOST = "";
    private $USER = "";
    private $PASS = "";
    private $DB = "";
    protected $connection;
    private $dataset;

    public function __construct(){
        $this->HOST="localhost";
        $this->USER="root";
        $this->PASS="";
        $this->DB="requests";
    }

  /*public function __constructor($PHOST,$PUSER,$PPASS,$PDB){
        $this->HOST=$PHOST;
        $this->USER=$PUSER;
        $this->PASS=$PPASS;
        $this->DB=$PDB;
    }*/

    //metodo para conectar a la base de datos
    public function connect(){
        $this->connection = mysqli_connect($this->HOST, $this->USER, $this->PASS, $this->DB);
        if($this->connection){
            //echo "Si se conecta a la db";
            return true;
        }else{
            //echo"no conecto a la db";
            return false;
        }
        //fin de conectar
    }

    public function execquery($query){
        $this->dataset = mysqli_query($this->connection,$query);
        if($this->dataset){
            //echo "la consulta va bien";
            return $this->dataset;
        }else{
            //echo "algo pasó con la consulta";
            return 0;
        }
    }

    public function execinsert($query){
        if(mysqli_query($this->connection, $query)){
            $newid = mysqli_insert_id($this->connection);
            echo "insercion exitosa";
        }
        else{
            $newid = 0;
            // Imprimir el mensaje de error de la última consulta
            echo "Error de inserción: " . mysqli_error($this->connection);
        }
        return $newid;
    } 
}

?>