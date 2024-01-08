<?php
include ('Departamento.php');
$miobjeto = new Departamento();
//verificacion de que el $POST esta siendo recibida
print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setNomDepartamento($_POST['txtNom']);
$miobjeto->setDescripcion($_POST['txtDesc']);
$miobjeto->setTelDepa($_POST['numTel']);
$miobjeto->setDepartamento();
header('Location: gestionDepa.php');
//echo "¡Usuario registrado con exito!";
?>