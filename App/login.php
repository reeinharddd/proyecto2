<?php
include('../Data/Usuario.php');
$myUser = new Usuario();
$myUser->setNick($_POST['txtUser']);
$myUser->setContraseña($_POST['txtPassword']);
$dataset = $myUser->getUsuario();
if ($dataset !== null) { 
    $count = mysqli_num_rows($dataset);
    if ($count == 1) {
        session_start();
        $tupla = mysqli_fetch_assoc($dataset);
        $_SESSION['nick'] = $tupla['nickname'];
        $_SESSION['first_name'] = $tupla['first_name'];
        $_SESSION['last_name'] = $tupla['last_name'];
        $_SESSION['user_id'] =  $tupla['user_id'];
        $_SESSION['mail'] = $tupla['email'];
        $_SESSION['profile_pic'] = $tupla['profile_pic'];
        $_SESSION['numeroTel'] = $tupla['numTel'];
        $_SESSION['departamento'] = $tupla['idDepaUsuario'];
        $_SESSION['estado_user'] = $tupla['status'];
        
        $rol = $tupla['category'];
        $_SESSION['logged'] = true;
        $_SESSION['category'] = $rol;
        if($_SESSION['estado_user'] == 'activo'){
            if ($rol == '1') {
                header('Location: ../View/indexAdmin.php');
            } elseif ($rol == '4') {
                header('Location: ../View/indexTech.php');
            } elseif ($rol == '2') {
                header('Location: ../View/indexGeneral.php');
            } elseif ($rol == '3') {
                header('Location: ../View/indexSupervisor.php');
            } 
            require '../App/authentication.php';
        }
    }
}  
if ((session_status() == PHP_SESSION_NONE) || ($_SESSION['estado_user'] == 'inactivo')){
    header('Location: ../View/formLogin.php');
}
?>
