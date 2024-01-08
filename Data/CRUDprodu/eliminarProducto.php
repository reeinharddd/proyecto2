<?php
include('Producto.php');

if (isset($_GET['idProducto'])) { //Verificacmos si exitse el parametro del "idDepartamento", tambien sirve para identificar al departamento que sera eliminado
    $idProducto = $_GET['idProducto'];
    $miobjeto = new Producto();
    // Ejecutar la consulta para eliminar el producto
    $miobjeto->deleteProducto($idProducto); //Elimina el id del producto seleccionado
    // Redirigir a la página de lista de productos o a donde desees después de eliminar
    header('Location: gestionProducto.php');
    exit();
}