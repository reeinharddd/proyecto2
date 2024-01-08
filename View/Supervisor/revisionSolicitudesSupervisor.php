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
	<link rel="stylesheet" href="../../CSS/popUp.css">
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
	<header>
	<?php
    include("../../Data/Requisicion.php");
    $miobjeto = new Requisicion();
	$idDepartamento = $_SESSION['departamento'];
    $dataset = $miobjeto->getSolicitudesPorDepaSupervisor($idDepartamento); ?>
        <h1>Revisión de Solicitudes</h1>
		<input type="button" value="Historiales" onclick="location.href='cataSoli.php'" class="cata">
	<table class="custom-table">
		<tr>
			<th>Fecha</th>
			<th>Usuario</th>	
			<th>Descripción</th>
			<th>Comentario</th>
			<th>Estado</th>
			<th>Producto</th>
			<?php if ($idDepartamento == 2) {?>
	        <th>Cantidad</th>
		    <?php } ?>
			<th>Prioridad</th>
			<th>Acciones</th>
		</tr>
		<?php
		$myObjetoSelect = new Requisicion();
		$idDepartamento = $_SESSION['departamento'];
		while ($tupla = mysqli_fetch_assoc($dataset)) {
			echo "<tr>";
				echo "<td>" . $tupla['fechaSolicitud'] . "</td>";
				echo "<td>" . $miobjeto->getNombreCompletoUsuario($tupla['idSolicitudUser']) . "</td>";
				echo "<td>" . $tupla['justificacion'] . "</td>";
				echo "<td>" . $tupla['comentario'] . "</td>";
				echo "<td>" . $tupla['estadoSolicitud'] . "</td>";
				echo "<td>" . $miobjeto->getNombreProducto($tupla['idSolicitudProducto']) . "</td>";
				if ($idDepartamento == 2) {
					echo "<td>" . $tupla['cantidad'] . "</td>";
				}
				echo "<td>" .$miobjeto->getNombrePrioridad($tupla['idPrioridad']) . "</td>";
				echo '<td class="actions">';
					echo '<input type="button" class="edit-btn" data-id-solicitud="' . $tupla['idSolicitud'] . '" data-user-id="' . $_SESSION['user_id'] . '" value="Aprobar">';
					echo '<input type="button" class="delete-btn" data-id-solicitud="' . $tupla['idSolicitud'] . '" data-user-id="' . $_SESSION['user_id'] . '" value="Denegar">';
					echo '<input type="button" value="Modificar Detalles" onclick="location.href=\'../../Data/editRequisicionDetalles.php?idSolicitud='.$tupla['idSolicitud'].'\'" class="btn-modificar">';
				echo "</td>";
			echo "</tr>";
		}
	?>
	</table>
	
	<div class="fondoPopUp" id="fondoPopUp"></div>
	<div class="popUpAprobar" id="popUpAprobar">
		<input type="button" value="Autorizar">
		<button id="cerrarPopUpAprobar">Cancelar</button>
	</div>
	<div class="popUpDenegar" id="popUpDenegar">
		<textarea id="comentarioDenegar" placeholder="Motivos:"></textarea>
		<input type="button" value="Denegar">
		<button id="cerrarPopUpDenegar">Cancelar</button>
	</div>


	<script>
		const mostrarPopUpAprobar = document.querySelectorAll(".edit-btn");
		const popUpAprobar = document.getElementById("popUpAprobar");
		const cerrarPopUpAprobar = document.getElementById("cerrarPopUpAprobar");

		const mostrarPopUpDenegar = document.querySelectorAll(".delete-btn");
		const popUpDenegar = document.getElementById("popUpDenegar");
		const cerrarPopUpDenegar = document.getElementById("cerrarPopUpDenegar");

		const fondoPopUp = document.getElementById("fondoPopUp");

		mostrarPopUpAprobar.forEach(btn => {
			btn.addEventListener("click", () => {
				const idSolicitud = btn.getAttribute("data-id-solicitud");
				const userId = btn.getAttribute("data-user-id"); // Obtiene user_id
				fondoPopUp.style.display = "block";
				popUpAprobar.style.display = "block";
				// Utiliza idSolicitud y user_id en el enlace
				popUpAprobar.querySelector("input[type='button']").onclick = function () {
					location.href = `../../Data/autorizarRequisicion.php?idSolicitud=${idSolicitud}&user_id=${userId}`;
				};
			});
		});

		mostrarPopUpDenegar.forEach(btn => {
			btn.addEventListener("click", () => {
				const idSolicitud = btn.getAttribute("data-id-solicitud");
                const userId = btn.getAttribute("data-user-id");
				fondoPopUp.style.display = "block";
				popUpDenegar.style.display = "block";
				// Utiliza idSolicitud en el enlace
				popUpDenegar.querySelector("input[type='button']").onclick = function () {
					const comentario = document.getElementById("comentarioDenegar").value;
   	 				location.href = `../../Data/denegarRequisicion.php?idSolicitud=${idSolicitud}&user_id=${userId}&comentario=${encodeURIComponent(comentario)}`;
				};
			});
		});
		// Cerrar el popup cuando se hace clic en "Cancelar"
		cerrarPopUpAprobar.addEventListener("click", () => {
			fondoPopUp.style.display = "none";
			popUpAprobar.style.display = "none";
		});

		cerrarPopUpDenegar.addEventListener("click", () => {
			fondoPopUp.style.display = "none";
			popUpDenegar.style.display = "none";
		});
	</script>

</body>
</html>