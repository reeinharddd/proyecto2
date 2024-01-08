<?php
include('Requisicion.php');
/*
if (isset($_GET['idSolicitudesTec'])) { 
    $idSolicitudesTec = $_GET['idSolicitudesTec'];
    $miSolTec = new Requisicion();
    $miSolTec->autorizarSolicitudTecnica($idSolicitudesTec);
    header('Location: ../View/Supervisor/asignarTareasSupervisor.php');
    exit();
}
*/
if (isset($_GET['idTecnicoAsignado']) && isset($_GET['idSolicitudesTec']) && isset($_GET['idUserSolicitudTec'])) { 
    //$idTecnicoAsignado = $_GET['idTecnicoAsignado'];
    //$idSolicitudesTec = $_GET['idSolicitudesTec'];
    $user_id = $_GET['idTecnicoAsignado'];
    $idUserSolicitudTec = $_GET['idUserSolicitudTec'];
    echo $idUserSolicitudTec;
    $miTecnico = new Requisicion();
    $miTecnico->asignarTecnico($_GET['idSolicitudesTec'], $_GET['idTecnicoAsignado'], $_GET['idUserSolicitudTec']);
    $miTecnico->sumarSolicitudTecnica($user_id); // Usando el user_id aquí
    $miTecnico->autorizarSolicitudTecnica($_GET['idSolicitudesTec']); // manda la solicitud a autorizar
    header('Location: ../View/Supervisor/asignarTareasSupervisor.php');
    exit();
}
?>