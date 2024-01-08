<?php
/*session_start();
if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header('Location: ../View/formLogin.php');
    exit;
}*/
// Inicia la sesión si aún no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Revisa si el usuario está logueado y activo
if ((!isset($_SESSION['logged'])) || ($_SESSION['logged'] !== true) || ($_SESSION['estado_user'] == 'inactivo')) {
    // Construye la URL
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'];

    $path = '/Proyecto-3erCuatrimestre/View/formLogin.php'; // Path relativo desde la raíz del proyecto

    // Redirección final
    header('Location: ' . $protocol . $domainName . $path);
    exit;
}


