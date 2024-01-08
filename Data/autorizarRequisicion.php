<?php
include('Requisicion.php');

if (isset($_GET['idSolicitud']) && isset($_GET['user_id'])) {
    $idSolicitud = $_GET['idSolicitud'];
    $user_id = $_GET['user_id'];
    $miobjeto = new Requisicion();
    $miobjeto->autorizarSolicitud($idSolicitud, $user_id); // Llamada al método autorizarSolicitud
    header('Location: ../View/Supervisor/revisionSolicitudesSupervisor.php');
    exit();
}
// Requisicion marcada como completada luego que el tecnico marque como atendida el usuario marca como completada 
if (isset($_GET['idSolicitudesTec']) && isset($_GET['idSolicitudesTec'])) {
    $idSolicitudesTec = $_GET['idSolicitudesTec'];
    $user_id = $_GET['idTecnicoAsignado'];
    $miobjeto = new Requisicion();
    $miobjeto->usuarioMarcaReqCompletada($idSolicitudesTec);
    $miobjeto->restarSolicitudTecnica($user_id);
    $miobjeto->updateFechaFin($idSolicitudesTec);
    echo $user_id;
    header('Location: ../View/General/historialSolicitudEmpleado.php');
    exit();
}
?>