<?php
include('../../Data/conexionDB.php');
require '../../App/authentication.php';
include("../../Data/Requisicion.php");
include("../../Data/Usuario.php");

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
    <?php
    $imagen = isset($_GET['imagen']) ? $_GET['imagen'] : '';
    if (!empty($imagen)) {
    ?>
        <img src="<?php echo $imagen; ?>" alt="Evidencia">
    <?php
    }
    ?>
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
			
			<?php
			if ($_SESSION['category'] == '3' && $_SESSION['departamento'] == '3') {?> <!--PRUEBAAAA-->
			<div class="item">
				<a href="historialSolicitudesTec.php">
					<div class="icon"><img src="../../img/soliTecnicasMant.png" alt=""></div>
					<div class="title"><span>Historial</span></div>
				</a>
			</div>
			<?php }?>

			<div class="item separator"></div>

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
    <h1>Asignación de tareas soporte técnico</h1>
	<table class="containerT">
	<thead>
		<tr>
		    <th><h1>No.</h1></th>
			<th><h1>Fecha</h1></th>
			<th><h1>Descripción</h1></th>
			<th><h1>Ubicación</h1></th>
			<th><h1>Departamento</h1></th>
			<th><h1>Usuario Solicitante</h1></th>
			<th><h1>Evidencia</h1></th>
			<th><h1>Estado</h1></th>
			<th><h1>Asignar Técnico</h1></th>
			<th></th><h1>Acciones</h1></th>
		</tr>
			</thead>
		<?php
        $myObjetoSelect = new Requisicion(); // aqui el supervisor asigna las tareas a los tecnicos discponibles
        $dataset = $myObjetoSelect->getSolicitudesGeneradasSupervisorTecnico();
		if ($dataset == "error") {
			echo "hay un error en la consulta";
		} else {
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				if ($tupla['estado'] == 'pendiente' || $tupla['estado'] == 'Pendiente') {
					?>
					<form method="get" action="../../Data/asignarTecnico.php">
						<tr>
							<td> <?php echo $tupla['idSolicitudesTec']; ?> </td>
							<td> <?php echo $tupla['fechaSolicitud']; ?> </td>
							<td> <?php echo $tupla['descripcion']; ?></td>
							<td> <?php echo $myObjetoSelect->getNombreUbicacion($tupla['ubicacion']); ?></td>
							<td> <?php echo $myObjetoSelect->getDepaSolicitante($tupla['idUserSolicitudTec']); ?></td>
							<td> <?php echo $myObjetoSelect->getNombreCompletoUsuario($tupla['idUserSolicitudTec']); ?></td>
							<td>
                                <div class="imagen-container">
                            <?php
                                if (!empty($tupla['evidencia'])) {
                                // Ruta a la carpeta donde se almacenan las imágenes (ajusta según tu estructura)
                                $carpetaEvidencias = '../../img/evidenciasTecnicas/';
                                $rutaImagen = $carpetaEvidencias . $tupla['evidencia'];
                            ?>
                                <a href="../../img/evidenciasTecnicas/pagina_imagen.php?imagen=<?php echo $rutaImagen; ?>" target="_blank">
                                    <span>Ver Evidencia</span>
                                </a>
                            <?php
                                }
                            ?>
                                </div>
                            </td>
							<td> <?php echo $tupla['estado']; ?></td>
							<td>
								<select name="idTecnicoAsignado" id="opcionesProducto<?php echo $tupla['idSolicitudesTec']; ?>">
									<?php
									$myRequisicion = new Usuario();
									$dataTecnico = $myRequisicion->getTecnico();
									$hayOpciones = false; 
									while ($tuplaTecnico = mysqli_fetch_assoc($dataTecnico)) {
										if ($tuplaTecnico['cantidadTrabajosAsignados'] < 5 && $tuplaTecnico['status'] == 'activo') {
											echo "<option value=\"" . $tuplaTecnico['user_id'] . "\" title=\"" . $tuplaTecnico['first_name'] . "\">" . $tuplaTecnico['first_name'] . "</option>";
											$hayOpciones = true; 
										}
									}
									?>
								</select>
							</td>
							<td class="actions">
								<?php if ($hayOpciones) { ?>
									<input type="hidden" name="idSolicitudesTec" value="<?php echo $tupla['idSolicitudesTec']; ?>">
									<input type="hidden" name="idUserSolicitudTec" value="<?php echo $tupla['idUserSolicitudTec']; ?>">
									<input type="submit" value="Asignar Técnico" class="edit-btn">
									<?php } else { ?>
									<span> No hay técnicos disponibles </span>
								<?php } ?>
									<?php echo '<input type="button" class="delete-btn" data-id-solicitud="' . $tupla['idSolicitudesTec'] . '" data-user-id="' . $_SESSION['user_id'] . '" value="No Autorizar">'; ?>
					<?php 
					?>
            </form>
            <?php	
        }
    }
}
?>
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
	</table>
	</main>
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
   	 				location.href = `../../Data/denegarRequisicionSupervisor.php?idSolicitudesTec=${idSolicitud}&user_id=${userId}&comentario=${encodeURIComponent(comentario)}`;
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