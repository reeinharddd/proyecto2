<?php
session_start();
if(isset($_SESSION['nick'])){
    $menuadmin = true;
    $user = 'Welcome '.$_SESSION['nick'];
}else{
    $menuadmin = false;
    $user = '';
}
?>