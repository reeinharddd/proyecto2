<?php
require '../App/authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Supervisor</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/normalize.css">
	<link rel="stylesheet" href="../CSS/sidemenu.css">
	<link rel="stylesheet" href="../CSS/popUp.css">
	<link rel="stylesheet" href="../CSS/form.css">
</head>
<body>
	<div id="sidemenu" class="menu-collapsed">
		<div id="header">
			<div id="title"><span>Menu</span></div>	
			<div id="menu-btn">
				<div class="btn-hamburger"></div>
				<div class="btn-hamburger"></div>
				<div class="btn-hamburger"></div>
			</div>
		</div>
		<!-- PROFILE-->
		<div id="profile">
			<?php
			if (!isset($_SESSION['profile_pic'])) {
				echo '<div id="photo"><img src="../img/profiles_pics/usuario.png" alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Supervisor</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="../View/indexSupervisor.php">
					<div class="icon"><img src="../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menú Principal</span></div>
				</a>
			</div>
			<?php if($_SESSION['departamento'] != '3') { ?>
			<div class="item">
				<a href="../View/Supervisor/revisionSolicitudesSupervisor.php">
					<div class="icon"><img src="../img/solicitudImagen.png" alt=""></div>
					<div class="title"><span>Revisar solicitudes</span></div>
				</a>
			</div>
			<?php }?>
			<div class="item separator"></div>


			<?php if($_SESSION['departamento'] == '3') { ?>
			<div class="item">
				<a href="../View/Supervisor/asignarTareasSupervisor.php">
					<div class="icon"><img src="../img/tareasImagen.png" alt=""></div>
					<div class="title"><span>Asignar Tareas</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item separator"></div>
			<?php
			if ($_SESSION['category'] == '3' && $_SESSION['departamento'] == '3') {?> <!--PRUEBAAAA-->
			<div class="item">
				<a href="../View/Supervisor/historialSolicitudesTec.php">
					<div class="icon"><img src="../img/soliTecnicasMant.png" alt=""></div>
					<div class="title"><span>Historial</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item">
				<a href="../View/Supervisor/notificacionesSupervisor.php">
					<div class="icon"><img src="../img/notificacionesImagen.png" alt=""></div>
					<div class="title"><span>Notificaciones</span></div>
				</a>
			</div>
			<div class="item">
				<a href="../App/logout.php">
					<div class="icon"><img src="../img/logout.png" alt=""></div>
					<div class="title"><span>Cerrar Sesión</span></div>
				</a>
			</div>
			<script>
				const btn = document.querySelector('#menu-btn');
				const menu = document.querySelector('#sidemenu');
				btn.addEventListener('click', e =>{
					menu.classList.toggle("menu-expanded");
					menu.classList.toggle("menu-collapsed");

					document.querySelector('body').classList.toggle('body-expanded');
				});
			</script>
		</div>
	</div>
    <h1>Editar detalles Solicitud</h1>
    <br>
    <input type="button" value="Volver a Revisión de Solicitudes"  onclick="location.href='../View/Supervisor/revisionSolicitudesSupervisor.php'">
    <br>
<?php
    include('Requisicion.php');
    $miobjeto = new Requisicion();
    if(isset($_GET['idSolicitud'])){
        $datosPrevios = $miobjeto->getDatosSolicitud($_GET['idSolicitud']);
        // Asumiendo que estas son todas las variables que has obtenido de $datosPrevios
        $fecha = $datosPrevios['fechaSolicitud']; 
        $estado = $datosPrevios['estadoSolicitud']; 
        $justificacion = $datosPrevios['justificacion'];
        $comentario = $datosPrevios['comentario'];
        $cantidad = $datosPrevios['cantidad'];
        $idProducto = $datosPrevios['idSolicitudProducto'];
        $idSolicitante = $datosPrevios['idSolicitudUser']; 
        $idPrioridad = $datosPrevios['idPrioridad'];
    }
    $datosUsuario = $miobjeto->getUsuarioById($idSolicitante);
    while($tupla  =  mysqli_fetch_assoc($datosUsuario)){
        $nombre = $tupla['first_name'];
        $apellido = $tupla['last_name'];
    }
    $contable = $miobjeto->getProductoContable($idProducto);
    $nombreProducto = $miobjeto->getNombreProducto($idProducto)
    ?>
	<div class="container">
        <form class="form" method="post" action="actualizarRequisicion.php">
            <input type="hidden" name="idSolicitud" value="<?php echo $_GET['idSolicitud']; ?>">
            <label for="listPrioridades">Fecha de Solicitud:</label><input type="date" name="fechaSolicitud" value="<?php echo date('Y-m-d', strtotime($fecha)); ?>" readonly></input><br><br>
            <label for="listPrioridades">Solicitante:</label><input type="text" name="solicitante" value="<?php echo $nombre." ".$apellido?>" readonly></input><br><br>
            <label for="listPrioridades">Producto:</label><input type="text" name="<?php echo $nombreProducto?>" value="<?php echo $nombreProducto ?>" readonly></input><br><br> 
            <label for="listPrioridades">Justificación:</label> <input name="txtJustificacion" value="<?php echo $justificacion; ?>"></input><br><br>
            <label for="listPrioridades">Prioridad:</label>
            <select name="listPrioridades" id=opcionesProducto>
			<?php
			$dataset = $miobjeto->getAllPrioridades();
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				echo "<option name = \"listPrioridades\" value=\"" . $tupla['idPrioridad'] . "\" title=\"" . $tupla['nombre'] . "\">" . $tupla['nombre'] . "</option>";
			}
			?>
		</select><br>
            Comentario: <textarea name="txtComentario"><?php echo $comentario; ?></textarea><br><br>            <?php
                if($contable){
                    echo 'Cantidad: <input type="number" name="numCantidad" value="'.$cantidad.'"><br><br>';
                    echo '<input type="submit" name="submit" value="Actualizar">';
                }else{
                    echo '<input type="submit" name="submit" value="Actualizar">';
                    echo '<input type="hidden" name="numCantidad" value= '.$cantidad.'><br><br>';
                }
            ?>
        </form>
	</div>
</body>
</html>