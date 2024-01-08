<?php
include('Requisicion.php');

/// deniega la solicitud tecnica por parte desl supervisor
if (isset($_GET['idSolicitudesTec'])) {
    $idSolicitudesTec = $_GET['idSolicitudesTec'];
    $comentario = $_GET['comentario'];
    $miobjeto = new Requisicion();
    $miobjeto->denegarSolicitudTecnica($idSolicitudesTec,$comentario); // Llamada al método autorizarSolicitud
    header('Location: ../View/Supervisor/asignarTareasSupervisor.php');
    exit();
}
?>