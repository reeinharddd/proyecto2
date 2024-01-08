<?php
require '../../App/authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Tecnico</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/normalize.css">
	<link rel="stylesheet" href="../../CSS/sidemenu.css">
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
				echo '<div id="photo"><img src="../../img/profiles_pics/usuario.png alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Técnico</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="../indexTech.php">
					<div class="icon"><img src="../../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menú Principal</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="tareasAsignadasTecnico.php">
					<div class="icon"><img src="../../img/asignacionTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Tareas Asignadas</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<!--- Generar solicitud oomo empleado tecnico
			<div class="item">
				<a href="generarSolicitudEmpleado.php">
					<div class="icon"><img src="../../img/generarSolicitudImagen.png" alt=""></div>
					<div class="title"><span></span>Generar Solicitud</div>
				</a>
			</div>
			--->
			<div class="item">
				<a href="historialSolicitudEmpleado.php">
					<div class="icon"><img src="../../img/historialSolicitudesImagen.png" alt=""></div>
					<div class="title"><span>Historial de Solicitudes</span></div>
				</a>
			</div>

			
			<div class="item">
				<a href="notificacionesTecnico.php">
					<div class="icon"><img src="../../img/notificacionesImagen.png" alt=""></div>
					<div class="title"><span>Notificaciones</span></div>
				</a>
			</div>
			<div class="item">
				<a href="../../App/logout.php">
					<div class="icon"><img src="../../img/logout.png" alt=""></div>
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
    <h1>Notificaciones</h1>
	<?php include("../../Data/Usuario.php");
	$miobjeto = new Usuario();
	$user_id = $_SESSION['user_id'];
	$dataset = $miobjeto->getNotificaciones($user_id); ?>
	<table class="custom-table">
    <tr>
        <th>No.</th>
        <th>Asunto</th>
        <th>Estado</th>
        <th>Fecha</th>
		<th>Remitente</th>
        <th>Destinatario</th>
    </tr>
    <?php
	while ($tupla = mysqli_fetch_assoc($dataset)) { 
		$miobjeto->marcarLeido($tupla['idNotificacion']);
		?>
		<tr>
    		<td> <?php echo $tupla['idNotificacion']; ?> </td>
    		<td> <?php echo $tupla['asunto']; ?></td>
    		<td> <?php echo $tupla['estado']; ?></td>
    		<td> <?php echo $tupla['fecha']; ?></td>
    		<td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idRemitente']); ?></td>
    		<td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idDestinatario']); ?></td>
	<?php }?>
</body>
</html>