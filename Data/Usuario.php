<?php //User.php 
include_once('conexionDB.php'); ////////////////////////////
class Usuario extends conexionDB{
    //atributos
private $user_id;
private $first_name;
private $last_name;
private $password;
private $email;
private $numTel;
private $nickname;
private $categoria;
private $idDepaUsuario;
private $status;
private $idNotificacion;
//private $fechaRegistro;
private $profile_pic;
    //constructor
    //queda pendiente
    
    //métodos
public function setFirst_Name($first_name){
    $this->first_name = $first_name;
}
public function setLast_Name($last_name){
    $this->last_name = $last_name;
}
public function setContraseña($password){
    $this->password = $password;
}
public function setEmail($email){
    $this->email = $email;
}
public function setTelefono($numTel){
    $this->numTel = $numTel;
}
public function setNick($nickname){
    $this->nickname = $nickname;
}
public function setCategoria($categoria){
    $this->categoria = $categoria;
}
public function setEstado($status){
    $this->status = $status;
}
public function setProfilePic($profile_pic){
    $this->profile_pic = $profile_pic;
}
public function getConnection(){
    return $this->connection;
}
public function setIdDepaUsuario($idDepaUsuario){
    $this->idDepaUsuario = $idDepaUsuario;
}
public function setNotificacion($idNotificacion){
    $this->idNotificacion = $idNotificacion;
}

public function setUsuario($archivo){
    $query = "insert into usuarios (first_name, last_name, email, password, numTel, nickname, category, idDepaUsuario, status, profile_pic) values ('".$this->first_name."','".$this->last_name."','".$this->email."','".$this->password."','".$this->numTel."','".$this->nickname."','".$this->categoria."',".$this->idDepaUsuario.", 'activo','".date("m-d-y")."_".$archivo["name"]."')";
    $result = $this->connect();
    if ($result == true){
        //echo "Conecto";
        $newid = $this->execinsert($query);
    }
    else{
        echo "No conecto";
        $newid = 0;
    }
    return $newid;
}
public function getNotificaciones($user_id){
    $query = "SELECT * FROM notificaciones WHERE idDestinatario = $user_id";
    $result = $this->connect();
    if ($result){
        $dataset = $this->execquery($query);
    }
    else{
        echo "No conecto";
        $dataset = "error";
    }
    return $dataset;
}
public function getNotificacionesNoLeidas($user_id){
    $query = "SELECT * FROM notificaciones WHERE idDestinatario = $user_id AND estado = 'No leído'";
    $result = $this->connect();
    if ($result){
        $dataset = $this->execquery($query);
    }
    else{
        echo "No conecto";
        $dataset = "error";
    }
    return $dataset;
}
public function marcarLeido($idNotificacion){
    $query = "UPDATE notificaciones SET estado = 'Leído' WHERE idNotificacion = $idNotificacion";
    $result = $this->connect();
    if ($result) {
        $this->execquery($query);
    }
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

public function getUsuario(){
    $query = "select * from usuarios where (password = '".$this->password."' and nickname = '".$this->nickname."') OR (password = '".$this->password."' and email = '".$this->nickname."')";
    $result = $this->connect();
    if($result){
        $dataset = $this->execquery($query);
    }else{
        $dataset = "ERROR";
    }
    return $dataset;
}
public function getTechUsuario(){
    $query = "SELECT * FROM usuarios where password = '".$this->password."' and nickname = '".$this->nickname."' and category='T'";
    $result = $this->connect();
    if($result){
        $dataset = $this->execquery($query);

    }else{
        $dataset = "ERROR";
    }
    return $dataset;
}
public function setUpdateUsuario($user_id){
    $query = "UPDATE usuarios SET first_name = '".$this->first_name."', last_name = '".$this->last_name."', email = '".$this->email."' , numTel = '".$this->numTel."', category = '".$this->categoria."' , idDepaUsuario = '".$this->idDepaUsuario."' WHERE user_id = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    } else {
        $dataset = "error";
    }
    return $dataset;
}
/*public function updateUser($user_id){
    $query = "UPDATE users SET first_name = '".$this->first_name."', last_name = '".$this->last_name."', password = '".$this->password."', email = '".$this->email."', nickname = '".$this->nickname."', categoria = '".$this->categoria."' WHERE user_id = $user_id";
    $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
    }*/
    public function getAllRoles(){
        $query = 'SELECT * from roles';
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
            $dataset = "error";
        }
        return $dataset;
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
    public function getUsuarioById($user_id){
        $query = "SELECT * FROM usuarios WHERE user_id = $user_id";
        $result = $this->connect();
        if ($result) {
            $dataset = $this->execquery($query);
        }
        else{
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
        /*$result = $this->execquery($query);
        $userData = mysqli_fetch_assoc($result);
        if($userData){
            return $userData;
        } else {
            echo "Error: ".mysqli_error($this->connection);
            return null;
        }*/

public function deleteUsuario($user_id) {
    $query = "UPDATE usuarios SET status = 'inactivo' WHERE user_id = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}

public function deleteTrabajosAsigandos($user_id){
    $query = "UPDATE usuarios SET cantidadTrabajosAsignados = 0 WHERE user_id = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}

public function desAsignarRequisiciones($user_id){
    $query = "UPDATE solicitudes_tec SET estado = 'Pendiente' WHERE idTecnicoAsignado = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}

public function getHistorialSolicitudes($user_id){
    $query = "SELECT * FROM vista_solicitudes_usuario WHERE id_Usuario = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}

public function getHistorialSolicitudesTech($user_id){
    $query = "SELECT * FROM vista_filtrada_solicitudes_tec WHERE idUserSolicitudTec = $user_id";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}
public function getTecnico(){
    $query = "SELECT * FROM usuarios WHERE category = 4";
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
    }
    else{
        $dataset = "error";
    }
    return $dataset;
}

public function getNombreUbicacion($ubicacion){
    $query = "SELECT * from areas WHERE idArea =".$ubicacion;
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
public function getNombreDepartamento($departamento){
    $query = "SELECT * from departamentos WHERE idDepartamento =".$departamento;
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
public function getNombreRol($rol){
    $query = "SELECT * from roles WHERE idRol =".$rol;
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
public function notificacionReenviada($idSolicitud){
    $query = "SELECT * from notificaciones WHERE idSolicitud =".$idSolicitud;
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
        if ($dataset !== null && $dataset !== 0)   { // Verifica si $dataset no es null
            $count = mysqli_num_rows($dataset);
            if ($count <1) {
                return $reenvio = true;
                echo "Dentro del primer if";
            }
        }else{
            return $reenvio = false;
            echo "falló el primer if";
        }
    }
    else{
        return $reenvio = false;
        echo "else final";
    }
}
public function notificacionReenviadaTech($idSolicitud){
    $query = "SELECT * from notificaciones WHERE idSolicitudesTec =".$idSolicitud;
    $result = $this->connect();
    if ($result) {
        $dataset = $this->execquery($query);
        if ($dataset !== null && $dataset !== 0)   { // Verifica si $dataset no es null
            $count = mysqli_num_rows($dataset);
            if ($count <1) {
                return $reenvio = true;
                echo "Dentro del primer if";
            }
        }else{
            return $reenvio = false;
            echo "falló el primer if";
        }
    }
    else{
        return $reenvio = false;
        echo "else final";
    }
}
}

?>