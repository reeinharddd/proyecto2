<?php
include('Requisicion.php');

if (isset($_GET['idSolicitud']) && isset($_GET['user_id'])) {
    $idSolicitud = $_GET['idSolicitud'];
    $miobjeto = new Requisicion();
    $user_id = $_GET['user_id'];
    $comentario = $_GET['comentario'];
    $miobjeto->denegarSolicitudComentario($idSolicitud,$user_id,$comentario); // Llamada al método autorizarSolicitud
    header('Location: ../View/Supervisor/revisionSolicitudesSupervisor.php');
    exit();
}

?>