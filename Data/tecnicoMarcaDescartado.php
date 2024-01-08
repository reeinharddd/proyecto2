<?php
include('Requisicion.php');

if (isset($_GET['idSolicitudesTec'])) { 
    $miTecnico = new Requisicion();
    $miTecnico->tecnicoDescartaRequisicion($_GET['idSolicitudesTec']);
    header('Location: ../View/Tecnico/tareasAsignadasTecnico.php');
    exit();
}
?>