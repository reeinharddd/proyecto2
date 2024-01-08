<?php
require '../../App/authentication.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Administrador</title>
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
			<div id="name"><span>Administrador</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="../indexAdmin.php">
					<div class="icon"><img src="../../img//homeImagen.png" alt=""></div>
					<div class="title"><span>Menu Principal</span></div>
				</a>
			</div>

			<div class="item">
				<a href="gestionUsuarios.php">
					<div class="icon"><img src="../../img/gestionUsuarioImagen.png" alt=""></div>
					<div class="title"><span>Gestión de usuarios</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="controlTecnico.php">
					<div class="icon"><img src="../../img/controlTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Control tecnico</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="solicitudes.php">
					<div class="icon"><img src="../../img/requisicionesImagen.png" alt=""></div>
					<div class="title"><span>Requisiciones</span></div>
				</a>
			</div>

			<!---
			<div class="item">
				<a href="adminCategorias.php">
					<div class="icon"><img src="../../img/administrarCategoriasImagen.png" alt=""></div>
					<div class="title"><span>Administrar categorias</span></div>
				</a>
			</div>
			---->
			
			<div class="item">
				<a href="catalogo.php">
					<div class="icon"><img src="../../img/catalogo.png" alt=""></div>
					<div class="title"><span>Catálogos</span></div>
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
    <h1>Control de Solicitudes Tecnico</h1>
	<?php include('SolTecnica.php');
				$miobjeto = new SolTecnica();
				$dataset = $miobjeto->getAllSolicitudTec();
			?>
	<h2>Solicitudes Tecnicas</h2>
	<table class="custom-table">
    	<thead>
        	<tr>
            	<th>Numero de Solicitud</th>
            	<th>Fecha de la Solicitud</th>
            	<th>Estado de la Solicitud</th>
            	<th>Descripción</th>
            	<th>Evidencia</th>
            	<th>Departamento Ubicado</th>
            	<th>Usuario Solicitante</th>
    		</tr>
    	</thead>
    	<tbody>
        	<?php while ($tupla = mysqli_fetch_assoc($dataset)) { ?>
				<?php
					switch ($tupla['ubicacion']) {
						case 1:
							$ubi = "Area 1";
							break;
						case 2:
							$ubi = "Area 2";
							break;
						case 3:
							$ubi = "Area 3";
							break;
						default:
							$ubi = "Area desconocida";
							break;
					}
					?>
            	<tr>
                	<td><?php echo $tupla['idSolicitudesTec']; ?></td>
                	<td><?php echo $tupla['fechaSolicitud']; ?></td>
                	<td><?php echo $tupla['estado']; ?></td>
                	<td><?php echo $tupla['descripcion']; ?></td>
                	<td><?php echo $tupla['evidencia']; ?></td>
                	<td><?php echo $ubi ?></td>
                	<td><?php echo $miobjeto->getNombreCompletoUsuario($tupla['idUserSolicitudTec']);?></td>
            	</tr>
        	<?php } ?>
    	</tbody>
</table>
</body>
</html>