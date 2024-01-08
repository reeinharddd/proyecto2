<?php
include ('Usuario.php');
$miobjeto = new Usuario();
//verificacion de que el $POST esta siendo recibida
print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setFirst_Name($_POST['txtUser']);
$miobjeto->setLast_Name($_POST['txtApe']);
$miobjeto->setEmail($_POST['txtEmail']);
$miobjeto->setContraseña($_POST['txtPass']);
$miobjeto->setTelefono($_POST['numTele']); //nombre del campo del form
$miobjeto->setNick($_POST['txtNick']);
$miobjeto->setCategoria($_POST['listCategoria']);
$miobjeto->setIdDepaUsuario($_POST['listDepartamento']);
$archivo = $_FILES["imgPerfil"];
        // Solo verifica si el archivo se cargó correctamente
    if ($archivo["error"] === UPLOAD_ERR_OK) {
        $Temp = $archivo["tmp_name"];
        // Mover el archivo temporal a una ubicación específica
        $ruta = "../img/profiles_pics/" .date("m-d-y")."_". $archivo["name"];
        move_uploaded_file($Temp, $ruta);
    }
$miobjeto->setUsuario($archivo);
header('Location: ../View/Admin/gestionUsuarios.php');
//echo "¡Usuario registrado con exito!";
?>