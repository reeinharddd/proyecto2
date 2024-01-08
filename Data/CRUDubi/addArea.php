<?php
include ('Area.php');
$miobjeto = new Area();
//verificacion de que el $POST esta siendo recibida
print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setNomArea($_POST['txtArea']);
$miobjeto->setUbi($_POST['txtUbi']);
$miobjeto->setDepa($_POST['listDepaArea']);
$miobjeto->setArea();
header('Location: gestionArea.php');
?>