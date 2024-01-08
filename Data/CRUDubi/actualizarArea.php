<?php
    include ('Area.php');
    $miobjeto = new Area();
    // Obtener detalles del area si se pasa el idArea como parámetro GET
    if (isset($_GET['idArea'])) { //Verificacmos si exitse el parametro del "idArea", tambien sirve para identificar al area que se va a editar
        $datosArea = $miobjeto->getAreaById($_GET['idArea']); //Obtenemos los datos del area al que se le haya llamado
        $idArea = $datosArea['idArea'];
        $nomArea = $datosArea['nombre'];
        $ubicacion = $datosArea['ubicacion'];
        $idDepartamento = $datosArea['idDepartamento'];

    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomArea($_POST['nombre']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setUbi($_POST['ubicacion']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateArea($_POST['idArea']);
    }
    header('Location: gestionArea.php');