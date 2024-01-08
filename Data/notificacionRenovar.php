<?php
include('Requisicion.php');
$miobjeto = new Requisicion();
if(isset($_GET['idSolicitudUser'])){
    $idSolicitud = $_GET['idSolicitud'];
    $user_id = $_GET['idSolicitudUser'];
    $dataset = $miobjeto->getSupervisoresPorUsuario($user_id);

    while ($tupla = mysqli_fetch_assoc($dataset)) {
        $supervisor = $tupla['user_id'];
        $noti = 'insert into notificaciones (asunto,idRemitente, idDestinatario, idSolicitud) values ("Renovación de Solicitud General - Atención Necesaria",'.$user_id.','.$supervisor.','.$idSolicitud.')';
        $miobjeto->execinsert($noti);
    }
}
if(isset($_GET['idUserSolicitudTec'])){
    $idSolicitud = $_GET['idSolicitud'];
    $user_id = $_GET['idUserSolicitudTec'];
    $dataset = $miobjeto->getSupervisoresPorUsuario($user_id);
    while ($tupla = mysqli_fetch_assoc($dataset)) {
        $supervisor = $tupla['user_id'];
        $noti = 'insert into notificaciones (asunto,idRemitente, idDestinatario, idSolicitudesTec) values ("Renovación de Solicitud Técnica - Atención Necesaria",'.$user_id.','.$supervisor.','.$idSolicitud.')';
        echo $noti;
        $miobjeto->execinsert($noti);
    }
}
header('Location: ../View/General/historialSolicitudEmpleado.php');
?>