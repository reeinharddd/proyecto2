<?php
    include ('Usuario.php');
    $miobjeto = new Usuario();
    //Obtener detalles del usuario si se pasa el user_id como parámetro GET
    if (isset($_GET['user_id'])) { //Verificacmos si exitse el parametro del "user_id", tambien sirve para identificar al usuario que se va a editar
        $datosUsuario = $miobjeto->getUsuarioById($_GET['user_id']); //Obtenemos los datos del usuario al que se le haya llamado
        $user_id = $datosUsuario['user_id'];
        $first_name = $datosUsuario['first_name'];
        $last_name = $datosUsuario['last_name'];
        $email = $datosUsuario['email'];
        $password = $datosUsuario['password'];
        $numTel = $datosUsuario['numTel'];
        $nickname = $datosUsuario['nickname'];
        $categoria = $datosUsuario['category'];
        $idDepaUsuario = $datosUsuario['idDepaUsuario'];
    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setFirst_Name($_POST['first_name']); //Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setLast_Name($_POST['last_name']);
        $miobjeto->setEmail($_POST['email']);
        $miobjeto->setTelefono($_POST['numTel']);
        $miobjeto->setCategoria($_POST['listCategoria']);
        $miobjeto->setIdDepaUsuario($_POST['listDepartamento']);
        $miobjeto->setUpdateUsuario($_POST['user_id']);
    }
    header('Location: ../View/Admin/gestionUsuarios.php');