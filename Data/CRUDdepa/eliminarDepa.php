<?php
include('Departamento.php');

if (isset($_GET['idDepartamento'])) { //Verificacmos si exitse el parametro del "idDepartamento", tambien sirve para identificar al departamento que sera eliminado
    $idDepartamento = $_GET['idDepartamento'];
    $miobjeto = new Departamento();
    // Ejecutar la consulta para eliminar el departamento
    $miobjeto->deleteDepa($idDepartamento); //Elimina el id del departamento seleccionado
    // Redirigir a la página de lista de usuarios o a donde desees después de eliminar
    header('Location: gestionDepa.php');
    exit();
}