<?php
include('Requisicion.php');
if (isset($_GET['idSolicitudesTec'])) { 
    //$idTecnicoAsignado = $_GET['idTecnicoAsignado'];
    //$idSolicitudesTec = $_GET['idSolicitudesTec'];
    //$userId = $_GET['userId'];
    $miTecnico = new Requisicion();
    $miTecnico->tecnicoCompletaRequisicion($_GET['idSolicitudesTec']);
    $miTecnico->updateFechaResolucion($_GET['idSolicitudesTec']);
   // $miTecnico->autorizarSolicitudTecnica($_GET['idSolicitudesTec']);
    header('Location: ../View/Tecnico/tareasAsignadasTecnico.php');
    exit();
}
?>