<?php
include('Requisicion.php');



if (isset($_GET['idSolicitud'])) { 
    //$idTecnicoAsignado = $_GET['idTecnicoAsignado'];
    $idSolicitud = $_GET['idSolicitud'];
    $miTecnico = new Requisicion();
    $miTecnico->marcarListo($_GET['idSolicitud']);
    header('Location: ../View/General/miarea.php');
    exit();
}
?>