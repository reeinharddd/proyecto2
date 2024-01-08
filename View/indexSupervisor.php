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
				echo '<div id="photo"><img src="../img/profiles_pics/supervisor.png" alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Supervisor</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="indexSupervisor.php">
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
		<!--Agregue el mensaje de bienvenida para el usuario que inicio sesion-->
		<div id="welcome-container">
    <?php
	include('../Data/Usuario.php');
	$miObjeto = new Usuario();
	$departamento = $miObjeto->getNombreDepartamento($_SESSION['departamento']);
	$rol = $miObjeto->getNombreRol($_SESSION['category']);
    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
        echo '<aside id="sidebar">';
        echo '<img id="welcome-image" src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario">';
        echo '</aside>';
        	echo '<div id="content-wrapper">';
        	echo '<header id="welcome-header">';
        		echo '<p id="welcome-message">Iniciaste sesión como Supervisor: ' . $_SESSION['nick'] . '</p>';
        	echo '</header>';
        	echo '<main id="main-content">';
        		echo '<div id="user-data-container">';
				echo '<div class="contenedorGRID">';
				echo '<div class="grid">';
					echo '<div class="cont">Nombre: '.$_SESSION['first_name'].'</div>
						<div class="cont">Apellido: '.$_SESSION['last_name'].' </div>';
					echo '</div>';
					echo '<div class="grid">
							<div class="cont"> Correo Electronico: '.$_SESSION['mail'].' </div>
							<div class="cont"> Número Telefónico: '.$_SESSION['numeroTel'].' </div>
							<div class="cont"> Rol: '.$rol.' </div>
							<div class="cont"> Departamento: '.$departamento.' </div>
					</div>';
				echo '</div>';
				echo '<div class="centroNotis">';
					echo '<h1>Centro de Notificaciones</h1>';?>
					<table class="custom-table">
					<tr>
						<th>No.</th>
						<th>Asunto</th>
						<th>Estado</th>
						<th>Fecha</th>
						<th>Remitente</th>
					</tr>
					<?php
					$i = 0;
					$dataset = $miObjeto->getNotificacionesNoLeidas( $_SESSION['user_id']); 
					while ($tupla = mysqli_fetch_assoc($dataset)) { 
						?>
						<tr>
							<td> <?php echo ++$i; ?> </td>
							<td> <?php echo $tupla['asunto']; ?></td>
							<td> <?php echo $tupla['estado']; ?></td>
							<td> <?php echo $tupla['fecha']; ?></td>
							<td> <?php echo $miObjeto->getNombreCompletoUsuario($tupla['idRemitente']); ?></td>
					<?php }
				echo '</table>';
        		echo '</div>';
        	echo '</main>';
        echo '</div>';
    }
	?>
</body>
</html>