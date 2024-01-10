<?php
require '../../App/authentication.php';
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
				echo '<div id="photo"><img src="../../img/profiles_pics/usuario.png" alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Supervisor</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="../indexSupervisor.php">
					<div class="icon"><img src="../../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menú Principal</span></div>
				</a>
			</div>

			<?php if($_SESSION['departamento'] != '3') { ?>
			<div class="item">
				<a href="revisionSolicitudesSupervisor.php">
					<div class="icon"><img src="../../img/solicitudImagen.png" alt=""></div>
					<div class="title"><span>Revisar solicitudes</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item separator"></div>


			<?php if($_SESSION['departamento'] == '3') { ?>
			<div class="item">
				<a href="asignarTareasSupervisor.php">
					<div class="icon"><img src="../../img/tareasImagen.png" alt=""></div>
					<div class="title"><span>Asignar Tareas</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item separator"></div>
			<?php
			if ($_SESSION['category'] == '3' && $_SESSION['departamento'] == '3') {?> <!--PRUEBAAAA-->
			<div class="item">
				<a href="historialSolicitudesTec.php">
					<div class="icon"><img src="../../img/soliTecnicasMant.png" alt=""></div>
					<div class="title"><span>Historial</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item">
				<a href="notificacionesSupervisor.php">
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
    <h1>Historial General de Solicitudes Técnicas</h1>
	<table class="containerT">
	<thead>
    	<tr>
        	<th><h1>Numero de Solicitud</h1></th>
        	<th><h1>Fecha de Solicitud</h1></th>
        	<th><h1>Descripción</h1></th>
        	<th><h1>Ubicación</h1></th>
			<th><h1>Departamento</h1></th>
        	<th><h1>Técnico Asignado</h1></th>
        	<th><h1>Usuario Solicitante</h1></th>
			<th><h1>Estado</h1></th>
			<th><h1>Fecha de Resolucion</h1></th>
			<th><h1>Fecha de Terminado</h1></th>
			<th>
    	</tr>
	</thead>
	<tbody>
		<?php
				include('../../Data/Requisicion.php');
				$miobjeto = new Requisicion();
    			$dataset = $miobjeto->getAllSolicitudTec();
				while ($tupla = mysqli_fetch_assoc($dataset)){
					if ($tupla['estado'] == 'Asignado' || $tupla['estado'] == 'En Revisión' || $tupla['estado'] == 'Completado' || $tupla['estado'] == 'pendiente'|| $tupla['estado'] == 'Pendiente')
            			echo '<tr>';
            				echo '<td>' .$tupla['idSolicitudesTec'] . '</td>';
            				echo '<td>' .$tupla['fechaSolicitud'] . '</td>';
            				echo '<td>' .$tupla['descripcion'] . '</td>';
            				echo '<td>' .$miobjeto->getNombreUbicacion($tupla['ubicacion']) . '</td>';
							echo '<td>' .$miobjeto->getDepaSolicitante($tupla['idUserSolicitudTec']) . '</td>';
							if (!empty($tupla['idTecnicoAsignado'])) { // función "empty"
								echo '<td>' . $miobjeto->getNombreCompletoUsuario($tupla['idTecnicoAsignado']) . '</td>';
							} else {
								echo '<td>No hay técnico asignado</td>';
							}
            				echo '<td>' .$miobjeto->getNombreCompletoUsuario($tupla['idUserSolicitudTec']) . '</td>';
							echo '<td>' .$tupla['estado'] . '</td>';
							if($tupla['estado']=='Denegado'){
								echo "<td colspan = '2'>No Autorizado  - [Motivo]: ".$tupla['comentarioDeTecnico']."</td>";
							}else{
								if (!empty($tupla['fechaResolucion'])) { // función "empty"
								echo "<td>" .$tupla['fechaResolucion']. "</td>";
								} else {
								echo '<td> - </td>';
								}
								if (!empty($tupla['fechaResolucion'])) { // función "empty"
								echo "<td>" .$tupla['fechFin']. "</td>";
								} else {
								echo '<td> - </td>';
								}
							}
            			echo '</tr>';
					}
		?>
	</table>
	</main>
</div>
</body>
</html>