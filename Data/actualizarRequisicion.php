<?php
include('Requisicion.php');
$miobjeto = new Requisicion();
//verificacion de que el $POST esta siendo recibida
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setIdRequisicion($_POST['idSolicitud']);
$miobjeto->setPrioridad($_POST['listPrioridades']);
$miobjeto->setJustificacion($_POST['txtJustificacion']);
$miobjeto->setComentario($_POST['txtComentario']);
$miobjeto->setCantidad($_POST['numCantidad']);
$miobjeto->updateRequisicion();

header('Location: ../View/Supervisor/revisionSolicitudesSupervisor.php');
?>