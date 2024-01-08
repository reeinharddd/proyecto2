<?php
include('Requisicion.php');

if (isset($_GET['idSolicitud'])) { //Verificacmos si exitse el parametro del "user_id", tambien sirve para identificar al usuario que sera eliminado
    $idSolicitud = $_GET['idSolicitud'];
    $miobjeto = new Requisicion();
    // Ejecutar la consulta para eliminar el usuario
    $miobjeto->updateEstadoEnEntrega($idSolicitud);
    // Redirigir a la página de lista de usuarios o a donde desees después de eliminar
    header('Location: ../View/General/recibidosRetornables.php');
    exit();
}
?>