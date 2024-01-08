<?php
include ('Producto.php');
$miobjeto = new Producto();
//verificacion de que el $POST esta siendo recibida
print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setNomProducto($_POST['txtNom']);
$miobjeto->setDescProducto($_POST['txtDesc']);
$miobjeto->setTipoEntrega($_POST['listEntrega']);
$miobjeto->setCategoria($_POST['listCate']);
$miobjeto->setDepaProducto($_POST['listDepa']);
$miobjeto->setProducto();
header('Location: gestionProducto.php');
//echo "¡Usuario registrado con exito!";
?>