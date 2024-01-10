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
	<main class = "mainE">
    <h1>Historial de Solicitudes</h1>
	<?php include('../../Data/Requisicion.php');
		$miobjeto = new Requisicion();
		$dataset = $miobjeto->getSolicitudAsignada();
	?>
<div class="solicitudes-container">
    <h3>Solicitudes Completadas</h3>
    <table class="containerT">
    <thead>
        <tr>
            <th><h1>Numero de Solicitud</h1></th>
			<th><h1>Fecha de Solicitud</h1></th>
			<th><h1>Descripción</h1></th>
			<th><h1>Ubicación</h1></th>
			<th><h1>Departamento</h1></th>
			<th><h1>Solicitante</h1></th>
			<th><h1>Estado</h1></th>
			<th><h1>Fecha Resolucion</h1></th>
			<th><h1>Fecha Fin</h1></th>
        </tr>
    </thead>
    <tbody>
        <?php 
		while ($tupla = mysqli_fetch_assoc($dataset)) { 
			if ($tupla['estado'] == 'Completado'){
			?>
            <tr>
                <td> <?php echo $tupla['idSolicitudesTec']; ?></td>
				<td> <?php echo $tupla['fechaSolicitud']; ?></td>
				<td> <?php echo $tupla['descripcion']; ?></td>
				<td> <?php echo $miobjeto->getNombreUbicacion($tupla['ubicacion']); ?></td>
				<td> <?php echo $miobjeto->getDepaSolicitante($tupla['idUserSolicitudTec']); ?></td>
				<td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idUserSolicitudTec']); ?></td>
				<td> <?php echo $tupla['estado']; ?></td> 
				<td> <?php echo $tupla['fechaResolucion']; ?></td> 
				<td> <?php echo $tupla['fechFin']; ?></td> 
            </tr>
        <?php 
			}
		}	
		?>
	    </table>
</div>
<?php
	$dataset = $miobjeto->getSolicitudAsignada();
?>
<div class="solicitudes-container">
    <h3>Solicitudes en Revisión</h3>
    <table class="containerT">
    <thead>
        <tr>
		    <th><h1>Numero de Solicitud</h1></th>
			<th><h1>Fecha de Solicitud</h1></th>
			<th><h1>Descripción</h1></th>
			<th><h1>Ubicación</h1></th>
			<th><h1>Departamento</h1></th>
			<th><h1>Solicitante</h1></th>
			<th><h1>Estado</h1></th>
			<th><h1>Fecha Resolucion</h1></th>
			<th><h1>Fecha Fin</h1></th>
        </tr>
    </thead>
    <tbody>
        <?php 
		while ($tupla = mysqli_fetch_assoc($dataset)) { 
			if ($tupla['estado'] == 'En Revisión'){
			?>
            <tr>
                <td> <?php echo $tupla['idSolicitudesTec']; ?></td>
				<td> <?php echo $tupla['fechaSolicitud']; ?></td>
				<td> <?php echo $tupla['descripcion']; ?></td>
				<td> <?php echo $miobjeto->getNombreUbicacion($tupla['ubicacion']); ?></td>
				<td> <?php echo $miobjeto->getDepaSolicitante($tupla['idUserSolicitudTec']); ?></td>
				<td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idUserSolicitudTec']); ?></td>
				<td> <?php echo $tupla['estado']; ?></td> 
				<td> <?php echo $tupla['fechaResolucion']; ?></td> 
				<?php
				if (!empty($tupla['fechFin'])) { // función "empty"
					echo "<td>" .$tupla['fechaResolucion']. "</td>";
				} else {
					echo '<td> En espera... </td>';
				}
				?>
            </tr>
        <?php 
			}
		}			
		?>
    </table>
</div>
</main>
</body>
</html>