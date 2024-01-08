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
    <h1>Historial de Área</h1>
	<h2>Solicitudes Cerradas</h2>
	<?php
    include("../../Data/Requisicion.php");
    $miobjeto = new Requisicion();
	$idDepartamento = $_SESSION['departamento'];
    $dataset = $miobjeto->getSolicitudesPorDepa($idDepartamento); ?>
	<table class="custom-table">
    <tr>
        <th>Número de Solicitud</th>
        <th>Fecha de Creación</th>
        <th>Motivo</th>
        <th>Comentario</th>
        <th>Usuario Solicitante</th>
        <th>Producto Solicitado</th>
		<?php if ($idDepartamento == 2) {?>
	    <th>Cantidad</th>
		<?php } ?>
        <th>Prioridad de la Solicitud</th>
	</tr>
    <?php
	while($tupla = mysqli_fetch_assoc($dataset)) {	
		if ($tupla['estadoSolicitud'] == 'Completada') {
		?>
        <tr>
            <td> <?php echo $tupla['idSolicitud']; ?> </td>
            <td> <?php echo $tupla['fechaSolicitud']; ?> </td>
            <td> <?php echo $tupla['justificacion']; ?> </td>
            <td> <?php echo $tupla['comentario']; ?> </td>
            <td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idSolicitudUser']); ?></td>
            <td> <?php echo $miobjeto->getNombreProducto($tupla['idSolicitudProducto']); ?> </td>
			<?php if ($idDepartamento == 2) {?>
			<td> <?php echo $tupla['cantidad']; ?> </td>
			<?php } ?>
            <td> <?php echo $miobjeto->getNombrePrioridad($tupla['idPrioridad']); ?> </td>
			<form method="get" action="../../Data/solicitudLista.php">

            <script>
                function mostrarMensaje(id) {
                    document.getElementById('mensaje-' + id).style.display = 'block';
                }

                function ocultarMensaje(id) {
                    document.getElementById('mensaje-' + id).style.display = 'none';
                }
            </script>
        </tr>
        <?php
       }
    }
	?>
</table>
</body>
</htm