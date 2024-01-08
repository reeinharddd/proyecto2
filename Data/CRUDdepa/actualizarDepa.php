<?php
    include ('Departamento.php');
    $miobjeto = new Departamento();
    // Obtener detalles del departamento si se pasa el idDepartamento como parámetro GET
    if (isset($_GET['idDepartamento'])) { //Verificacmos si exitse el parametro del "idDepartamento", tambien sirve para identificar al departamento que se va a editar
        $datosDepa = $miobjeto->getDepaById($_GET['idDepartamento']); //Obtenemos los datos del departamento al que se le haya llamado
        $idDepartamento = $datosDepa['idDepartamento'];
        $nomDepartamento = $datosDepa['nomDepartamento'];
        $descripcion = $datosDepa['descripcion'];
		$numTel = $datosDepa['numTel'];
    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomDepartamento($_POST['nomDepartamento']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setDescripcion($_POST['descripcion']);
		$miobjeto->setTelDepa($_POST['numTel']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateDepa($_POST['idDepartamento']);
    }
    header('Location: gestionDepa.php');
?>
hola
