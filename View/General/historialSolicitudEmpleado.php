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
		<br>

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
    <h1>Historial de Solicitudes Generadas</h1>
	<table class="containerT">
		<tr>
			<th><h1>No.</h1></th>
			<th><h1>Fecha de Creación</h1></th>
			<th><h1>Producto / Servicio</h1></th>
			<th><h1>Motivo</h1></th>
			<th><h1>Comentario</h1></th>
			<th><h1>Estado</h1></th>
			<th title="Despues de un lapso de 7 días la solicitud podrá ser renovada"><h1>Volver a notificar</h1></th>
		</tr>
			<?php
			include('../../Data/Usuario.php');
			$miObjeto = new Usuario();
			$dataset = $miObjeto->getHistorialSolicitudes($_SESSION['user_id']);
			if($dataset != "error"){
				$i = 0;
				while($tupla = mysqli_fetch_assoc($dataset)){
					$reenvio = $miObjeto->notificacionReenviada($tupla['id_Solicitud']);
					$i++;
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td>".$tupla['fecha']."</td>";
					echo "<td>".$tupla['producto_solicitado']."</td>";
					echo "<td>".$tupla['justificacion']."</td>";
					if($tupla['comentario']!= null){
						echo "<td>".$tupla['comentario']."</td>";
					}else{
						echo "<td>Sin Anotaciones</td>";
					}
					echo "</td>";
					echo "<td>".$tupla['estado']."</td>";
					if($tupla['estado'] == 'Denegado'){
						echo "<td>Solicitud Rechazada - [Motivo]: ".$tupla['comentarioDenegado']."<td>";
					}else{

						//este contador irá aumentando en funcion de los dias que han pasado desde la creacion de la solicitud para que
						//cuando este numero sea mayor o igual a 7, se habilite la funcion del boton
						$contador = 0;

						//Obtenemos tiempo actual para comparar con el de creación
						$fechaActual = getdate();
						$minutoActual = $fechaActual['minutes'];
						$horaActual = $fechaActual['hours'];
						$diaActual = $fechaActual['mday'];
						$mesActual = $fechaActual['mon'];
						$anioActual = $fechaActual['year'];

						$fechaDeLaBaseDeDatos = $tupla['fecha'];

						// Convierte la fecha de MySQL a formato de tiempo de PHP
						$timestamp = strtotime($fechaDeLaBaseDeDatos);

						$minutoBD = date('i', $timestamp);
						$horaBD = date('H', $timestamp);
						$diasBD = date('d', $timestamp);
						$mesBD = date('m', $timestamp);
						$anioBD = date('Y', $timestamp);

						// Calculo de difetencia de 7 dias en caso de ser meses continuos
						//devuelve el día máximo del mes en que se creó la solicitud
						$diasMaxMesSoli = cal_days_in_month(CAL_GREGORIAN, $mesBD, $anioBD);

						if($anioBD == $anioActual){
							if($mesBD == $mesActual){
								//si la fecha de consulta es en el mismo mes de su creacion, se calcula la diferencia de dias directa
								$contador = $diaActual - $diasBD;
							}elseif(($anioBD <= $anioActual)&&($mesActual - $mesBD)==1){
								//si no, y es un mes continuo. Se calculan los dias que pasaron del mes anterior en el lapso de la crecion de la solicitud hasta el dia máximo del mes, 
								//mas los días que lleva el mes entrante
								$diferenciaMes = $diasMaxMesSoli - $diasBD;

								$contador += ($diaActual + $diferenciaMes);						
							}

							if((($mesActual - $mesBD) >= 2) || $contador >= 7 && $reenvio){
								echo '<td><input type="button" value="Renovar" onclick="location.href=\'../../Data/notificacionRenovar.php?idSolicitudUser='.$tupla['id_Usuario'].'&idSolicitud='.$tupla['id_Solicitud'].'\'" class="edit-btn"></td>';
							}else{
								echo '<td><input type="button" value="No disponible" readonly></td>';
							}

							echo "</tr>";
						}elseif($anioBD < $anioActual){
							//caso Diciembre - Enero de años continuos 
							if(($mesBD - $mesActual ) == 11){
								$diferenciaMes = $diasMaxMesSoli - $diasBD;
								$contador += ($diaActual + $diferenciaMes);	
							}else{
								$contador = 7;
							}
							if($contador >=7 && $reenvio){
								echo '<td><input type="button" value="Renovar" onclick="location.href=\'../../Data/notificacionRenovar.php?idSolicitudUser='.$tupla['id_Usuario'].'&idSolicitud='.$tupla['id_Solicitud'].'\'" class="edit-btn"></td>';
							}else{
								echo '<td><input type="button" value="No disponible" readonly></td>';
							}	
						}
					}
				}
			}
			?>
			</table>
			<h1>Historial de Solicitudes Técnicas en Curso</h1>
			<table class="containerT">
		<tr>
			<th><h1>No.</h1></th>
			<th><h1>Fecha de Creación</h1></th>
			<th><h1>Área</h1></th>
			<th><h1>Motivo</h1></th>
			<th><h1>Estado</h1></th>
			<th><h1>Acción</h1></th>
			<th title="Despues de un lapso de 7 días la solicitud podrá ser renovada"><h1>Volver a notificar</h1></th>
		</tr>
			<?php
			$miObjeto = new Usuario();
			$dataset = $miObjeto->getHistorialSolicitudesTech($_SESSION['user_id']);
			if($dataset != "error"){
				$i = 0;
				while($tupla = mysqli_fetch_assoc($dataset)){
					$reenvio = $miObjeto->notificacionReenviadaTech($tupla['idSolicitudesTec']);				
					if ($tupla['estado'] == 'En Revisión' || $tupla['estado'] == 'pendiente' || $tupla['estado'] == 'Pendiente' || $tupla['estado'] == 'Asignado' ){
					$i++;
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td>".$tupla['fechaSolicitud']."</td>";
					echo "<td>".$miObjeto->getNombreUbicacion($tupla['ubicacion'])."</td>";
					echo "<td>".$tupla['descripcion']."</td>";
					echo "<td>".$tupla['estado']."</td>";
					if ($tupla['estado'] == 'pendiente' || $tupla['estado'] == 'Pendiente' || $tupla['estado'] == 'Asignado'){
						?>
						<td>Sin acciones</td>
						<?php
					} else {
					?> 
                    <form method="get" action="../../Data/autorizarRequisicion.php">
                        <td class="actions">
                            <input type="hidden" name="idSolicitudesTec" value="<?php echo $tupla['idSolicitudesTec']; ?>">
                            <input type="hidden" name="idTecnicoAsignado" value="<?php echo $tupla['idTecnicoAsignado']; ?>">
                            <input type="submit" value="Resuelto" class="edit-btn">
                        </td>
					</form>
					<?php
					}
					$contador = 0;

					//Obtenemos tiempo actual para comparar con el de creación
					$fechaActual = getdate();
					$minutoActual = $fechaActual['minutes'];
					$horaActual = $fechaActual['hours'];
					$diaActual = $fechaActual['mday'];
					$mesActual = $fechaActual['mon'];
					$anioActual = $fechaActual['year'];

					$fechaDeLaBaseDeDatos = $tupla['fechaSolicitud'];

					// Convierte la fecha de MySQL a formato de tiempo de PHP
					$timestamp = strtotime($fechaDeLaBaseDeDatos);

					$minutoBD = date('i', $timestamp);
					$horaBD = date('H', $timestamp);
					$diasBD = date('d', $timestamp);
					$mesBD = date('m', $timestamp);
					$anioBD = date('Y', $timestamp);

					// Calculo de difetencia de 7 dias en caso de ser meses continuos
					//devuelve el día máximo del mes en que se creó la solicitud
					$diasMaxMesSoli = cal_days_in_month(CAL_GREGORIAN, $mesBD, $anioBD);

					if($anioBD == $anioActual){
						if($mesBD == $mesActual){
							//si la fecha de consulta es en el mismo mes de su creacion, se calcula la diferencia de dias directa
							$contador = $diaActual - $diasBD;
						}elseif(($anioBD <= $anioActual)&&($mesActual - $mesBD)==1){
							//si no, y es un mes continuo. Se calculan los dias que pasaron del mes anterior en el lapso de la crecion de la solicitud hasta el dia máximo del mes, 
							//mas los días que lleva el mes entrante
							$diferenciaMes = $diasMaxMesSoli - $diasBD;

							$contador += ($diaActual + $diferenciaMes);						
						}

						if((($mesActual - $mesBD) >= 2) || $contador >= 7 && $reenvio && $tupla['estado'] == 'Pendiente'){
							echo '<td><input type="button" value="Renovar" onclick="location.href=\'../../Data/notificacionRenovar.php?idUserSolicitudTec='.$tupla['idUserSolicitudTec'].'&idSolicitud='.$tupla['idSolicitudesTec'].'\'" class="edit-btn"></td>';
						}else{
							echo '<td><input type="button" value="Aún no disponible" readonly></td>';
						}

						echo "</tr>";
					}elseif($anioBD < $anioActual){
						//caso Diciembre - Enero de años continuos 
						if(($mesBD - $mesActual ) == 11){
							$diferenciaMes = $diasMaxMesSoli - $diasBD;
							$contador += ($diaActual + $diferenciaMes);	
						}else{
							$contador = 7;
						}
						if($contador >=7 && $reenvio && $tupla['estado'] == 'Pendiente'){
							echo '<td><input type="button" value="Renovar" onclick="location.href=\'../../Data/notificacionRenovar.php?idUserSolicitudTec='.$tupla['idUserSolicitudTec'].'&idSolicitud='.$tupla['idSolicitudesTec'].'\'" class="edit-btn"></td>';
						}else{
							echo '<td><input type="button" value="Aún no disponible" readonly></td>';
						}
					}
				}//FIN DEL WHILE DE SOLICITUD
			}
		}
			?>
			</table>
			<h1>Historial de Solicitudes Técnicas Cerradas</h1>
			<table class="containerT">
		<tr>
			<th><h1>No.</h1></th>
			<th><h1>Fecha de Creación</h1></th>
			<th><h1>Área</h1></th>
			<th><h1>Motivo</h1></th>
			<th><h1>Estado</h1></th>
		</tr>
			<?php
			$dataset = $miObjeto->getHistorialSolicitudesTech($_SESSION['user_id']);
			if($dataset != "error"){
				$i = 0;
				while($tupla = mysqli_fetch_assoc($dataset)){
					if ($tupla['estado'] == 'Completado' || $tupla['estado'] == 'Denegado'){
					$i++;
					echo "<tr>";
					echo "<td>".$i."</td>";
					echo "<td>".$tupla['fechaSolicitud']."</td>";
					echo "<td>".$miObjeto->getNombreUbicacion($tupla['ubicacion'])."</td>";
					echo "<td>".$tupla['descripcion']."</td>";
					if($tupla['estado'] == 'Denegado'){
						echo "<td>".$tupla['estado']." - [Motivo]: ".$tupla['comentarioDeTecnico']."</td>";

					}else{
						echo "<td>".$tupla['estado']."</td>";
					}
					}
				}
			}
		?>
		</main>
</body>
</html>