<?php
include('Area.php');

if (isset($_GET['idArea'])) { //Verificacmos si exitse el parametro del "idArea", tambien sirve para identificar al departamento que sera eliminado
    $idArea = $_GET['idArea'];
    $miobjeto = new Area();
    // Ejecutar la consulta para eliminar el area
    $miobjeto->deleteArea($idArea); //Elimina el id del area seleccionado
    // Redirigir a la página de lista de area a donde desees después de eliminar
    header('Location: gestionArea.php');
    exit();
}