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
	<main class = "mainE">
    <h1>Mi Área</h1>
	<h2>Solicitudes entrantes</h2>
	<?php
    include("../../Data/Requisicion.php");
    $miobjeto = new Requisicion();
	$idDepartamento = $_SESSION['departamento'];
    $dataset = $miobjeto->getSolicitudesPorDepa($idDepartamento); ?>
	<table class="containerT">
    <tr>
        <th><h1>Número de Solicitud</h1></th>
        <th><h1>Fecha de Creación</h1></th>
        <th><h1>Estado de la Solicitud</h1></th>
        <th><h1>Motivo</h1></th>
        <th><h1>Comentario</h1></th>
        <th><h1>Usuario Solicitante</h1></th>
        <th><h1>Producto Solicitado</h1></th>
		<?php if ($idDepartamento == 2) {?>
	    <th><h1>Cantidad</h1></th>
		<?php } ?>
        <th><h1>Prioridad de la Solicitud</h1></th>
		<th><h1>Acciones</h1></th>
	</tr>
    <?php
	while($tupla = mysqli_fetch_assoc($dataset)) {
		if ($tupla['estadoSolicitud'] == 'Autorizado') {
		?>
        <tr>
            <td> <?php echo $tupla['idSolicitud']; ?> </td>
            <td> <?php echo $tupla['fechaSolicitud']; ?> </td>
			<td> <?php echo $tupla['estadoSolicitud']; ?> </td>
            <td> <?php echo $tupla['justificacion']; ?> </td>
            <td> <?php echo $tupla['comentario']; ?> </td>
            <td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idSolicitudUser']); ?></td>
            <td> <?php echo $miobjeto->getNombreProducto($tupla['idSolicitudProducto']); ?> </td>
			<?php if ($idDepartamento == 2) {?>
			<td> <?php echo $tupla['cantidad']; ?> </td>
			<?php } ?>
            <td> <?php echo $miobjeto->getNombrePrioridad($tupla['idPrioridad']); ?> </td>
			<td class="actions">
                <form method="get" action="../../Data/solicitudLista.php">
                    <input type="hidden" name="idSolicitud" value="<?php echo $tupla['idSolicitud']; ?>">
                    <input type="submit" value="Listo" class="edit-btn" onmouseover="mostrarMensaje('<?php echo $tupla['idSolicitud']; ?>')" onmouseout="ocultarMensaje('<?php echo $tupla['idSolicitud']; ?>')">
                    <div id="mensaje-<?php echo $tupla['idSolicitud']; ?>" style="display: none;">¡Listo para entregar!</div>
                </form>
            </td>
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
	</div>
	<h2>En curso</h2>
	<table class="containerT">
    <tr>
        <th><h1>Número de Solicitud</h1></th>
        <th><h1>Fecha de Creación</h1></th>
        <th><h1>Estado de la Solicitud</h1></th>
        <th><h1>Motivo</h1></th>
        <th><h1>Comentario</h1></th>
        <th><h1>Usuario Solicitante</h1></th>
        <th><h1>Producto Solicitado</h1></th>
		<?php if ($idDepartamento == 2) {?>
	    <th><h1>Cantidad</h1></th>
		<?php } ?>
        <th><h1>Prioridad de la Solicitud</h1></th>
		<th><h1>Acciones</h1></th>
	</tr>
    <?php
	$dataset = $miobjeto->getSolicitudesPorDepa($idDepartamento); 
	while($tupla = mysqli_fetch_assoc($dataset)) {	
	if ($tupla['estadoSolicitud'] == 'Lista para Recoger' || $tupla['estadoSolicitud'] == 'En Prestamo') {
		?>
        <tr>
            <td> <?php echo $tupla['idSolicitud']; ?> </td>
            <td> <?php echo $tupla['fechaSolicitud']; ?> </td>
			<td> <?php echo $tupla['estadoSolicitud']; ?> </td>
            <td> <?php echo $tupla['justificacion']; ?> </td>
            <td> <?php echo $tupla['comentario']; ?> </td>
            <td> <?php echo $miobjeto->getNombreCompletoUsuario($tupla['idSolicitudUser']); ?></td>
            <td> <?php echo $miobjeto->getNombreProducto($tupla['idSolicitudProducto']); ?> </td>
			<?php if ($idDepartamento == 2) {?>
			<td> <?php echo $tupla['cantidad']; ?> </td>
			<?php } ?>
            <td> <?php echo $miobjeto->getNombrePrioridad($tupla['idPrioridad']); ?> </td>
			<?php if ($tupla['tipoEntrega'] == 'Retornable' && $tupla['estadoSolicitud'] == 'Lista para Recoger') {?>
						<td class="actions">
						<form method="get" action="../../Data/prestamoRequisicionUsuario.php">
							<input type="hidden" name="idSolicitud" value="<?php echo $tupla['idSolicitud']; ?>">
							<input type="hidden" name="idSolicitudUser" value="<?php echo $tupla['idSolicitudUser']; ?>">
							<input type="submit" value="Prestar" class="edit-btn" onmouseover="mostrarMensaje('<?php echo $tupla['idSolicitud']; ?>')" onmouseout="ocultarMensaje('<?php echo $tupla['idSolicitud']; ?>')">
							<div id="mensaje-<?php echo $tupla['idSolicitud']; ?>" style="display: none;">¡Marcalo como prestado!</div>
						</form>
					</td>
					<script>
                function mostrarMensaje(id) {
                    document.getElementById('mensaje-' + id).style.display = 'block';
                }

                function ocultarMensaje(id) {
                    document.getElementById('mensaje-' + id).style.display = 'none';
                }
            </script>
			<?php } else { ?>
			<td class="actions">
                <form method="get" action="../../Data/autorizarRequisicionUsuario.php">
                    <input type="hidden" name="idSolicitud" value="<?php echo $tupla['idSolicitud']; ?>">
					<input type="hidden" name="idSolicitudUser" value="<?php echo $tupla['idSolicitudUser']; ?>">
                    <input type="submit" value="Completado" class="edit-btn" onmouseover="mostrarMensaje('<?php echo $tupla['idSolicitud']; ?>')" onmouseout="ocultarMensaje('<?php echo $tupla['idSolicitud']; ?>')">
                    <div id="mensaje-<?php echo $tupla['idSolicitud']; ?>" style="display: none;">¡Marcalo como recibido!</div>
                </form>
            </td>
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
}
?>
</table>
</main>
</body>
</htm