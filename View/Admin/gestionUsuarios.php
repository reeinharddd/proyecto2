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
					<div class="icon"><img src="../../img/homeImagen.png" alt=""></div>
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
    <h1>Menu de Gestion de Usuarios</h1>
	<br>
	<?php include ('../../Data/Usuario.php'); ?>
            <?php $miobjeto = new Usuario (); ?>
            <?php $dataset = $miobjeto->getAllUsuario(); 
			$userDepa = $_SESSION['user_id']?>
		<h2>Usuarios registrados.</h2>
		<br>
		<a href="../../Data/agregarUsuario.php" class="btn-agregar">Agregar nuevo</a>
			<table class="custom-table">
    		<tr>
        		<th>ID</th>
        		<th>Nombre</th>
        		<th>Apellido</th>
        		<th>Correo</th>
        		<th>Numero de Telefono</th>
        		<th>Nickname</th>
        		<th>Estado del Usuario</th>
        		<th>Categoria</th>
        		<th>Departamento</th>
        		<th>Acciones</th>
    	</tr>
			<?php while ($tupla = mysqli_fetch_assoc($dataset)) {
        		$idUser = $tupla['user_id'];
        		echo "<tr>";
        			echo "<td>" .$tupla['user_id']. "</td>";
        			echo "<td>" .$tupla['first_name']. "</td>";
        			echo "<td>" .$tupla['last_name']. "</td>";
					echo "<td>" .$tupla['email']. "</td>";
					echo "<td>" .$tupla['numTel']. "</td>";
					echo "<td>" .$tupla['nickname']. "</td>";
					echo "<td>" .$tupla['status']. "</td>";
					echo "<td>" .$miobjeto->getNombreRol($tupla['category']). "</td>";
					echo "<td>" .$miobjeto->getNombreDepartamento($tupla['idDepaUsuario']). "</td>";
					echo "<td class='actions'>";
						echo "<input type='button' value='Editar' onclick='location.href=\"../../Data/editarUsuario.php?user_id=$idUser\"' class='edit-btn'>";
						if ($idUser != $userDepa) {
							echo "<input type='button' value='Eliminar' onclick='location.href=\"../../Data/eliminarUsuario.php?user_id=$idUser\"' class='delete-btn'>";
						}
					echo "</td>";
				echo "</tr>";
					}?>
		</table>
</body>
</html>