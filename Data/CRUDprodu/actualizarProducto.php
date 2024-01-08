<?php
    include ('Producto.php');
    $miobjeto = new Producto();
    // Obtener detalles del producto si se pasa el idProducto como parámetro GET
    if (isset($_GET['idProducto'])) { //Verificacmos si exitse el parametro del "idProducto", tambien sirve para identificar al departamento que se va a editar
        $datosProducto = $miobjeto->getProductoById($_GET['idProducto']); //Obtenemos los datos del producto al que se le haya llamado
        $idProducto = $datosProducto['idProducto'];
        $nomProducto = $datosProducto['nomProducto'];
        $descripcion = $datosProducto['descripcion'];
        $tipoEntrega = $datosProducto['tipoEntrega'];

    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomProducto($_POST['nomProducto']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setDescProducto($_POST['descripcion']);
        $miobjeto->setTipoEntrega($_POST['tipoEntrega']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateProducto($_POST['idProducto']);
    }
    header('Location: gestionProducto.php');