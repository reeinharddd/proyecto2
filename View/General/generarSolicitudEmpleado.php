<?php
require '../../App/authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Usuario</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../CSS/normalize.css">
	<link rel="stylesheet" href="../../CSS/sidemenu.css">
	<link rel="stylesheet" href="../../CSS/req-body.css">
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
			<div id="name"><span>Usuario</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item separator"></div>
			<div class="item">
				<a href="../indexGeneral.php">
					<div class="icon"><img src="../../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menú Principal</span></div>
				</a>
			</div>

			<div class="item">
				<a href="generarSolicitudEmpleado.php">
					<div class="icon"><img src="../../img/generarSolicitudImagen.png" alt=""></div>
					<div class="title"><span></span>Generar Solicitud</div>
				</a>
			</div>

			<div class="item">
				<a href="historialSolicitudEmpleado.php">
					<div class="icon"><img src="../../img/historialSolicitudesImagen.png" alt=""></div>
					<div class="title"><span>Historial de Solicitudes</span></div>
				</a>
			</div>

			<div class="item">
				<a href="notificacionesUsuario.php">
					<div class="icon"><img src="../../img/notificacionesImagen.png" alt=""></div>
					<div class="title"><span>Notificaciones</span></div>
				</a>
			</div>
			
			<div class="item">
				<a href="miarea.php">
					<div class="icon"><img src="../../img/MiArea.png" alt=""></div>
					<div class="title"><span>Mi Area</span></div>
				</a>
			</div>


			<div class="item">
				<a href="miareaHistorial.php">
				<div class="icon"><img src="../../img/miAreaHistorial.png" alt=""></div>
					<div class="title"><span>Mi Area Historial</span></div>
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

	<!-- Aqui inicia el contenido de la pagina --->
    <h1>Genera una solicitud</h1>
    <!--Cada div es el inicio de un segmento de tipo de requisicion para dirigir hacia la pantalla de solicitud-->
	
	<!--Aqui inicia el contenedor completo del campo Supplies/Inzumos-->
	<div class="container">
  <div class="catalog-section">
    <!-- Sección de Suministros -->
    <div class="req-selection">
      <img src="../../img/soliSuministros.png" alt="Suministros">
      <div class="content">
        <h2>Suministros:</h2>
        <p>Esta categoría abarca todos los insumos y elementos necesarios para tu comodidad y seguridad en el trabajo. Aquí puedes solicitar desde equipo de protección personal hasta herramientas y productos de limpieza.</p>
        <a href="../General/formGeneralReqSupplies.php" class="go-to-button">Solicitar</a>
      </div>
    </div>
    <!-- Sección de Tramite de Documentos -->
    <div class="req-selection">
      <img src="../../img/soliDocu.png" alt="Documentos">
      <div class="content">
        <h2>Tramite de Documentos:</h2>
        <p>¿Necesitas trámites o documentos relacionados con tu empleo o la empresa? Esta categoría está diseñada para solicitar todo tipo de documentos, desde identificaciones y permisos hasta certificados y formularios internos.</p>
        <a href="../General/formGeneralReqDocs.php" class="go-to-button">Solicitar</a>
      </div>
    </div>
    <!-- Sección de Mantenimiento -->
    <div class="req-selection">
      <img src="../../img/soliMant.png" alt="Mantenimiento">
      <div class="content">
        <h2>Mantenimiento:</h2>
        <p>Si es de carácter técnico o necesitas servicios de reparación, esta categoría es tu punto de partida. Desde solicitar mantenimiento para equipos y maquinaria hasta servicios especializados, aquí puedes abordar cualquier necesidad técnica que tengas en tu área de trabajo.</p>
        <a href="../General/formGeneralReqTech.php" class="go-to-button">Solicitar</a>
      </div>
    </div>
  </div>
</div>

</body>
</html>