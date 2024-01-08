<?php
include ('Requisicion.php');
$miobjeto = new Requisicion();
//verificacion de que el $POST esta siendo recibida
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit('Invalid request method.');
}
$miobjeto->setDepartamento($_POST['numDepartamento']);
$miobjeto->setFecha_Solicitud($_POST['fechaActual']); 
$miobjeto->setDescripcion($_POST['txtDescripcion']);
$miobjeto->setUbicacion($_POST['listUbicaciones']);
$miobjeto->setIdSolicitudUser($_POST['numUser']);
$miobjeto->setPrioridad($_POST['listPrioridades']);
$archivo = $_FILES["evidencia"];
        // Solo verifica si el archivo se cargó correctamente
        if ($archivo["error"] === UPLOAD_ERR_OK) {
            $Temp = $archivo["tmp_name"];

            // Mover el archivo temporal a una ubicación específica
            $ruta = "../img/evidenciasTecnicas/" .date("m-d-y")."_". $archivo["name"];
            move_uploaded_file($Temp, $ruta);
        }
$miobjeto->setRequisicionTech($archivo);

header('Location: ../View/indexGeneral.php');
?>