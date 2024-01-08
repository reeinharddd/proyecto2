<?php
include('Usuario.php');

if (isset($_GET['user_id'])) { //Verificacmos si exitse el parametro del "user_id", tambien sirve para identificar al usuario que sera eliminado
    $user_id = $_GET['user_id'];
    $miobjeto = new Usuario();
    // Ejecutar la consulta para eliminar el usuario
    $miobjeto->deleteUsuario($user_id); //Elimina el id del usuario seleccionado
    $miobjeto->deleteTrabajosAsigandos($user_id);
    $miobjeto->desAsignarRequisiciones($user_id);
    // Redirigir a la página de lista de usuarios o a donde desees después de eliminar
    header('Location: ../View/Admin/gestionUsuarios.php');
    exit();
}
