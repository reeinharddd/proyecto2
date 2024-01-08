<?php
include_once('conexionDB.php'); ////////////////////////////
class Requisicion extends conexionDB{
    private $fecha_Solicitud;
    private $estadoSolicitud;
    private $prioridad;
    private $justificacion;
    private $comentario;
    private $cantidad;
    private $idSolicitudUser;
    private $idSolicitudProducto;
    private $idSolicitud;
    private $estadoEntrega;
    private $idSolicitudesTec;
    private $departamento;
    //Tecnicas

    private $descripcion;
    private $ubicacion;
    private $evidencia;

        public function setDepartamento($departamento){
            $this->departamento = $departamento;
        }

        public function getFecha_Solicitud() {
            return $this->fecha_Solicitud;
        }
        public function getIdSolicitud(){
            return $this->idSolicitud;
        }
    
        public function setFecha_Solicitud($fecha_Solicitud) {
            $this->fecha_Solicitud = $fecha_Solicitud;
        }
    
        public function getEstadoSolicitud() {
            return $this->estadoSolicitud;
        }
    
        public function setEstadoSolicitud($estadoSolicitud) {
            $this->estadoSolicitud = $estadoSolicitud;
        }
    
        public function getPrioridad() {
            return $this->prioridad;
        }
    
        public function setPrioridad($prioridad) {
            $this->prioridad = $prioridad;
        }
    
        public function getJustificacion() {
            return $this->justificacion;
        }
    
        public function setJustificacion($justificacion) {
            $this->justificacion = $justificacion;
        }
    
        public function getComentario() {
            return $this->comentario;
        }
    
        public function setComentario($comentario) {
            $this->comentario = $comentario;
        }

        public function getCantidad(){
            return $this->cantidad;
        }
        
        public function setCantidad($cantidad){
            $this->cantidad = $cantidad;
        }

        public function getIdSolicitudUser() {
            return $this->idSolicitudUser;
        }
    
        public function setIdSolicitudUser($idSolicitudUser) {
            $this->idSolicitudUser = $idSolicitudUser;
        }

        public function getIdSolicitudProducto() {
            return $this->idSolicitudProducto;
        }
    
        public function setIdSolicitudProducto($idSolicitudProducto) {
            $this->idSolicitudProducto = $idSolicitudProducto;
        }

        
        public function getDescripcion() {
            return $this->descripcion;
        }

        public function setDescripcion($descripcion) {
            $this->descripcion = $descripcion;
        }

        public function getUbicacion() {
            return $this->ubicacion;
        }
    
        public function setUbicacion($ubicacion) {
            $this->ubicacion = $ubicacion;
        }

        public function getEvidencia() {
            return $this->evidencia;
        }
    
        public function setEvidencia($evidencia) {
            $this->evidencia = $evidencia;
        }
        public function getIdSolicitudesTec() {
            return $this->idSolicitudesTec;
        }
        // Setter
        public function setIdSolicitudesTec($idSolicitudesTec) {
            $this->idSolicitudesTec = $idSolicitudesTec;
        }
        public function setEstadoEntrega($estadoEntrega){
            $this->estadoEntrega = $estadoEntrega;
        }
        
        public function updateEstadoEnEntrega($idSolicitud){
            $query ="UPDATE solicitudes SET estadoEntrega = 'En entrega' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result){
                $dataset = $this->execquery($query);
            }else{
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }
        public function updateEstadoEntrega($idSolicitud){
            $query ="UPDATE solicitudes SET estadoEntrega = 'Entregado' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result){
                $dataset = $this->execquery($query);
            }else{
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }
        public function updateEstadoRecibido($idSolicitud){
            $query = "UPDATE solicitudes SET estadoEntrega = 'Recibido' WHERE idSolicitud = $idSolicitud AND (estadoEntrega = '' OR estadoEntrega = 'Entregado')";
            $result = $this->connect();
            if ($result){
                $dataset = $this->execquery($query);
            }else{
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }

        /*public function getSolicitudesRetorna(){
            $query = "SELECT * FROM solicitudes s JOIN productos p ON s.idSolicitudProducto = p.idProducto WHERE p.tipoEntrega = 'Retornable'";
            $result = $this->connect();
            if ($result){
                $dataset = $this->execquery($query);
            }else{
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }*/
        public function getSoliRetornables($idDepartamento) {
            $query = "SELECT * FROM solicitudes s JOIN productos p ON s.idSolicitudProducto = p.idProducto WHERE p.idDepaProducto = $idDepartamento AND p.tipoEntrega = 'Retornable'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else{
                echo "No conecto";
                $dataset ="error";
            }
            return $dataset;
        }

        //Metodos REQUISICION ----------------------------------------------------          !!!!
        public function getSolicitudesPorDepa($idDepartamento) {
            $query = "SELECT * FROM solicitudes s JOIN productos p ON s.idSolicitudProducto = p.idProducto  WHERE p.idDepaProducto = ".$idDepartamento;
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else {
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }
        public function getSolicitudesPorDepaSupervisor($idDepartamento) {
            $query = "SELECT * FROM solicitudes s JOIN productos p ON s.idSolicitudProducto = p.idProducto  WHERE p.idDepaProducto = ".$idDepartamento." AND estadoSolicitud = 'Pendiente'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else {
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }
        

    public function getAllSolicitudTec(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("SELECT * FROM solicitudes_tec");
        }else{
            echo "No conecto";
            $dataset = "error";
        }
        return $dataset;
    }

    
    
    public function getAllSolicitudes(){
        $result = $this->connect();
        if ($result){
            $dataset = $this->execquery("Select * from solicitudes");
        }else{
            echo "No conecto";
            $dataset = "error";
        }
        return $dataset;
    }
    
    public function getPrioridadSolicitudTec() {
            $result = $this->connect();
            if ($result) {
                $query = "SELECT * FROM solicitudes_tec ORDER BY idPrioridad DESC";
                $dataset = $this->execquery($query);
            } else {
                echo "No conecto";
                $dataset = "error";
            }
            return $dataset;
        }

    public function getPrioridadSolicitud() {
        $result = $this->connect();
        if ($result) {
            $query = "SELECT * FROM solicitudes ORDER BY idPrioridad DESC";
            $dataset = $this->execquery($query);
        } else {
            echo "No conecto";
            $dataset = "error";
        }
        return $dataset;
    }
    public function setRequisicion(){
        $query = "insert into solicitudes (fechaSolicitud, estadoSolicitud, justificacion, comentario, cantidad, idSolicitudUser, idSolicitudProducto, idPrioridad) values ('".$this->fecha_Solicitud."','Pendiente','".$this->justificacion."','".$this->comentario."',".$this->cantidad.",".$this->idSolicitudUser.",".$this->idSolicitudProducto.",".$this->prioridad.")";
        //Se crea una noti para cada supervisor del departamento que tenga en su posibilidad la revisión
        $result = $this->connect();
        if ($result){
            $newid = $this->execinsert($query);
            $dataset = $this->getSupervisoresPorProducto();
            while ($tupla = mysqli_fetch_assoc($dataset)) {
                $supervisor = $tupla['user_id'];
                $noti = 'insert into notificaciones (asunto,idRemitente, idDestinatario) values ("Solicitud Pendiente de Revisión",'.$this->idSolicitudUser.','.$supervisor.')';
                echo $noti;
                $this->execinsert($noti);
            }
        }
        else{
            echo "No conecto";
            $newid = 0;
        }
        return $newid;
    }
        
        public function setRequisicionDocs(){
            $query = "insert into solicitudes (fechaSolicitud, estadoSolicitud, justificacion, comentario, idSolicitudUser, idSolicitudProducto, idPrioridad) values ('".$this->fecha_Solicitud."','Pendiente','".$this->justificacion."','".$this->comentario."',".$this->idSolicitudUser.",".$this->idSolicitudProducto.",".$this->prioridad.")";
            $result = $this->connect();
            if ($result){
                $newid = $this->execinsert($query);
                $dataset = $this->getSupervisoresPorProducto();
            while ($tupla = mysqli_fetch_assoc($dataset)) {
                $supervisor = $tupla['user_id'];
                $noti = 'insert into notificaciones (asunto,idRemitente, idDestinatario) values ("Solicitud Pendiente de Revisión",'.$this->idSolicitudUser.','.$supervisor.')';
                echo $noti;
                $this->execinsert($noti);
            }
            }
            else{
                echo "No conecto";
                $newid = 0;
            }
            return $newid;
        }
        public function marcarListo($idSolicitud){
            $query = "UPDATE solicitudes SET estadoSolicitud = 'Lista para Recoger' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        //Metodos Requisicion Tecnicas ----------------------------------------------------------
        public function tecnicoDescartaRequisicion($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET estado = 'Devuelta' WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function tecnicoCompletaRequisicion($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET estado = 'En Revisión' WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function usuarioMarcaReqCompletada($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET estado = 'Completado' WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function setRequisicionTech($archivo){
            $query = "insert into solicitudes_tec (fechaSolicitud, estado, descripcion,evidencia, ubicacion, idUserSolicitudTec, idPrioridad) values ('".$this->fecha_Solicitud."','Pendiente','".$this->descripcion."','".date("m-d-y")."_". $archivo["name"]."',".$this->ubicacion.",".$this->idSolicitudUser.", ".$this->prioridad.")";
            $result = $this->connect();
            if ($result){
                $newid = $this->execinsert($query);
                $dataset = $this->getSupervisoresTech();
            while ($tupla = mysqli_fetch_assoc($dataset)) {
                $supervisor = $tupla['user_id'];
                $noti = 'insert into notificaciones (asunto,idRemitente, idDestinatario) values ("Mantenimiento Pendiente de Aprobación",'.$this->idSolicitudUser.','.$supervisor.')';
                echo $noti;
                $this->execinsert($noti);
            }
            }
            else{
                echo "No conecto";
                $newid = 0;
            }
            return $newid;
        }
        public function getSolicitudAsignada(){
            $query = "SELECT * FROM solicitudes_tec WHERE idTecnicoAsignado = ".$_SESSION['user_id']."";
            $result = $this->connect();
            if ($result == true){
                //echo "Conecto";
                $dataset = $this->execquery($query);
            }
            else{
                echo "No conecto";
                $dataset = "error";
            }
        return $dataset;
        }
        // requisisciones tecnicas generadas - pendientes
        public function getSolicitudesTecnicasGeneradasUsuario(){
            $query = "SELECT * FROM solicitudes_tec WHERE idUserSolicitudTec = ".$_SESSION['user_id']."";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function sumarSolicitudTecnica($user_id){
            $query = "UPDATE usuarios SET cantidadTrabajosAsignados = cantidadTrabajosAsignados + 1 WHERE user_id = '$user_id'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } 
            else {
                $dataset = "error";
            }
            return $dataset;
        }

        public function restarSolicitudTecnica($user_id){
            $query = "UPDATE usuarios SET cantidadTrabajosAsignados = cantidadTrabajosAsignados - 1 WHERE user_id = '$user_id'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } 
            else {
                $dataset = "error";
            }
            return $dataset;
        }

        // revision de solicitudes por supervisor

        public function autorizarSolicitudTecnica($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET estado = 'Asignado' WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function asignarTecnico($idSolicitudesTec, $idTecnicoAsignado, $idUserSolicitudTec){
            $query = "UPDATE solicitudes_tec SET idTecnicoAsignado = $idTecnicoAsignado WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $noti = "INSERT INTO notificaciones (asunto, idRemitente, idDestinatario) VALUES ('Tienes una nueva asignación. No.".$idSolicitudesTec."', '".$idUserSolicitudTec."', '".$idTecnicoAsignado."')";
                $this->execquery($noti);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function getSolicitudesGeneradasSupervisorTecnico(){
            $query = "SELECT * FROM solicitudes_tec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getSolicitudesGeneradasSupervisor(){
            $query = "SELECT * FROM solicitudes where estadoSolicitud = 'Pendiente'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getAprobadasSupervisor(){
            $query = "SELECT * FROM solicitudes where estadoSolicitud = 'Autorizado'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getDenegadasSupervisor(){
            $query = "SELECT * FROM solicitudes where estadoSolicitud = 'Denegado'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function autorizarSolicitud($idSolicitud, $remitente) {
            $query = "UPDATE solicitudes SET estadoSolicitud = 'Autorizado' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $usuario = $this->getSolicitante($idSolicitud);
                $noti = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud Autorizada - Folio No.".$this->idSolicitudUser."',".$remitente.",".$usuario.")";
                $this->execquery($noti);
                $empleados = $this->getEmpleadosDepaAtiende($idSolicitud);
                while($tupla = mysqli_fetch_assoc($empleados)){
                    $notiArea = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud de Área lista para ser atendida',".$remitente.",".$tupla['user_id'].")";
                    $this->execquery($notiArea);
                }
            } else {
                $dataset = "error";
            }
        
            return $dataset;
        }

        public function autorizarSolicitudUsuario($idSolicitud, $remitente) {
            $query = "UPDATE solicitudes SET estadoSolicitud = 'Completada' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $usuario = $this->getSolicitante($idSolicitud);
                $noti = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud Autorizada - Folio No.".$this->idSolicitudUser."',".$remitente.",".$usuario.")";
                $this->execquery($noti);
                $empleados = $this->getEmpleadosDepaAtiende($idSolicitud);
                while($tupla = mysqli_fetch_assoc($empleados)){
                    $notiArea = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud de Área lista para ser atendida',".$remitente.",".$tupla['user_id'].")";
                    $this->execquery($notiArea);
                }
            } else {
                $dataset = "error";
            }
        
            return $dataset;
        }
        public function prestarSolicitudUsuario($idSolicitud, $remitente) {
            $query = "UPDATE solicitudes SET estadoSolicitud = 'En Prestamo' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $usuario = $this->getSolicitante($idSolicitud);
                $noti = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Articulo En Prestado - Folio No.".$this->idSolicitudUser."',".$remitente.",".$usuario.")";
                $this->execquery($noti);
            } else {
                $dataset = "error";
            }
        
            return $dataset;
        }


        public function denegarSolicitud($idSolicitud, $remitente) {
            $query = "UPDATE solicitudes SET estadoSolicitud = 'Denegado' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $usuario = $this->getSolicitante($idSolicitud);
                $noti = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud Denegada - Folio No.".$this->idSolicitudUser."',".$remitente.",".$usuario.")";
                $this->execquery($noti);
            } else {
                $dataset = "error";
            }
        
            return $dataset;
        }
        public function denegarSolicitudComentario($idSolicitud, $remitente, $comentario) {
            $query = "UPDATE solicitudes SET estadoSolicitud = 'Denegado', comentarioDenegado = '".$comentario."' WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $usuario = $this->getSolicitante($idSolicitud);
                $noti = "insert into notificaciones (asunto,idRemitente, idDestinatario) values ('Solicitud Denegada - Folio No.".$this->idSolicitudUser."',".$remitente.",".$usuario.")";
                $this->execquery($noti);
            } else {
                $dataset = "error";
            }
        
            return $dataset;
        }
        public function denegarSolicitudTecnica($idSolicitudesTec, $comentario){
            $query = "UPDATE solicitudes_tec SET estado = 'Denegado', comentarioDeTecnico = '".$comentario."' WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        //---------------------------------------------------------------------------------------
        //Metodos Departamento

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
        public function getDepartamentoPorNombre($nombre){
            $query = "SELECT * from departamentos WHERE nomDepartamento = '".$nombre."'";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                if ($dataset !== null) { // Verifica si $dataset no es null
                    $count = mysqli_num_rows($dataset);
                    if ($count == 1) {
                        $tupla = mysqli_fetch_assoc($dataset);
                        $idDepartamento = $tupla['idDepartamento'];
                    }
                }
            }
            else{
                $idDepartamento = "error";
            }
            return $idDepartamento;
        }

        //Metodos Prioridades
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

        //Metodos Producto
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
        public function getAllDocProductos(){
            $query = "SELECT * from productos WHERE idCatProducto = 1";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getAllSuppliesProductos(){
            $query = "SELECT * from productos WHERE (idCatProducto = 2) OR (idCatProducto = 3) ";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getAllUbicaciones(){
            $query = "SELECT * from areas WHERE idDepartamento =".$_SESSION['departamento']."";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function getSupervisores(){
            $query = "SELECT * FROM usuarios WHERE category = 3 AND status = 'activo' AND idDepaUsuario = ".$this->departamento;
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getSupervisoresTech(){
            $query = "SELECT * FROM usuarios WHERE category = 3 AND status = 'activo' AND (idDepaUsuario = ".$this->getDepartamentoPorNombre("Mantenimiento").")";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getSupervisoresPorProducto(){
            $query = "SELECT * FROM usuarios WHERE category = 3 AND status = 'activo' AND idDepaUsuario = ".$this->getDepaProducto($this->idSolicitudProducto);
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }

        public function getSupervisoresPorUsuario($user_id){
            $query = "SELECT * FROM usuarios WHERE category = 3 AND status = 'activo' AND idDepaUsuario = (Select idDepaUsuario from usuarios where user_id = ".$user_id.")";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            }
            else{
                $dataset = "error";
            }
            return $dataset;
        }
        public function getSolicitante($solicitud){
            $query = 'SELECT * FROM  solicitudes WHERE idSolicitud = '.$solicitud;
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $count = mysqli_num_rows($dataset);
                if($count == 1){
                    while($tupla = mysqli_fetch_assoc($dataset)){
                        $solicitante = $tupla['idSolicitudUser'];
                    }
                }
            }
            else{
                $solicitante = "error";
            }
            return $solicitante;
        }
        
        public function getEmpleadosDepaAtiende($solicitud){
            $query = "Select * From productos where idProducto = (select idSolicitudProducto from solicitudes where idSolicitud = ".$solicitud.")";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $count = mysqli_num_rows($dataset);
                if($count == 1){
                    while($tupla = mysqli_fetch_assoc($dataset)){
                        $depa = $tupla['idDepaProducto'];
                    }
                    $query = "Select * from usuarios where idDepaUsuario = ".$depa." AND category = 2";
                    $empleados = $this->execquery($query);
                        
                } 
            }else{
                $depa = "error";
            }
            return $empleados;
        }
        public function getDatosSolicitud($idSolicitud){
            $query = "SELECT * FROM solicitudes WHERE idSolicitud = $idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = mysqli_fetch_assoc($this->execquery($query));
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


        public function getProductoContable($idProducto){
            $query = "SELECT * from productos where idProducto  = $idProducto";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                $tupla = mysqli_fetch_assoc($dataset);
                $categoria = $tupla['idCatProducto'];
                if($categoria  === 2 || $categoria  === 3){
                    $contable = true;
                }else{
                    $contable = false;
                }
            }
            else{
                $contable = "error";
            }
            return $contable;
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
        

        public function updateRequisicion(){
            $query = "UPDATE solicitudes SET idPrioridad = '".$this->prioridad."', justificacion = '".$this->justificacion."', comentario = '".$this->comentario."' ,cantidad = '".$this->cantidad."' WHERE idSolicitud = $this->idSolicitud";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else {
                $dataset = "error";
            }
            return $dataset;
        }

        public function setIdRequisicion($idSolicitud){
            $this->idSolicitud = $idSolicitud;
        }

        public function updateFechaResolucion($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET fechaResolucion = CURRENT_TIMESTAMP WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else {
                $dataset = "error";
            }
            return $dataset;
        }

        public function updateFechaFin($idSolicitudesTec){
            $query = "UPDATE solicitudes_tec SET fechFin = CURRENT_TIMESTAMP WHERE idSolicitudesTec = $idSolicitudesTec";
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
            } else {
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
        public function getDepaProducto($producto){
            $query = "SELECT * from productos WHERE idProducto =".$producto;
            $result = $this->connect();
            if ($result) {
                $dataset = $this->execquery($query);
                if ($dataset !== null) { // Verifica si $dataset no es null
                    $count = mysqli_num_rows($dataset);
                    if ($count == 1) {
                        $tupla = mysqli_fetch_assoc($dataset);
                        $departamento = $tupla['idDepaProducto'];
                    }
                }
            }
            else{
                $departamento = "error";
            }
            return $departamento;

        }
        public function getDepaSolicitante($idUserSolicitudTec) {
            $query = "SELECT nomDepartamento FROM departamentos WHERE idDepartamento = (SELECT idDepaUsuario FROM usuarios WHERE user_id = $idUserSolicitudTec)";
            $result = $this->connect();
        
            if ($result) {
                $dataset = $this->execquery($query);
        
                if ($dataset !== null) {
                    $count = mysqli_num_rows($dataset);
        
                    if ($count == 1) {
                        $tupla = mysqli_fetch_assoc($dataset);
                        $departamento = $tupla['nomDepartamento'];
                    }
                }
            } else {
                $departamento = "error";
            }
        
            return $departamento;
        }
        
        
}

?>