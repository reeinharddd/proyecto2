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
		        <a href="../../View/indexAdmin.php">
					<div class="icon"><img src="../../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menu Principal</span></div>
				</a>
			</div>

			<div class="item">
				<a href="../../View/Admin/gestionUsuarios.php">
					<div class="icon"><img src="../../img/gestionUsuarioImagen.png" alt=""></div>
					<div class="title"><span>Gestión de usuarios</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="../../View/Admin/controlTecnico.php">
					<div class="icon"><img src="../../img/controlTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Control tecnico</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="../../View/Admin/solicitudes.php">
					<div class="icon"><img src="../../img/requisicionesImagen.png" alt=""></div>
					<div class="title"><span>Requisiciones</span></div>
				</a>
			</div>

			<div class="item">
				<a href="../../View/Admin/catalogo.php">
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
	<h1>Menu de Gestion de Departamentos</h1>
	Ingresa los datos correspondientes del usuario que deseas agregar. <br>
	<br>
	<div class="agregarForm">
    <form action="addDepa.php" method="post">
        <label class="labelDepa">Nombre del Departamento:</label> <br>
        <input type="text" name="txtNom" title="La primer letra debe ser Mayuscula"> <br><br>
        <label class="labelDesc" title="Campo Obligatorio" required>Descripción del Departamento</label> <br>
        <input type="text" name="txtDesc"> <br><br>
		<label class="labelNum">Número de Telefono:</label> <br>
		<input type="text" name="numTel" minlength="12" maxlength="12" placeholder="XXX-XXX-XXXX" oninput="formatoTelefono(this)" title="Campo Obligatorio" required> <br><br>
		<br>
		<input type="submit" value="Agregar">
		<a href="gestionDepa.php">Regresar</a>
		<script>
    	function formatoTelefono(input) {
      	// Eliminar caracteres no numéricos
    	var phoneNumber = input.value.replace(/\D/g, '');

      	// Aplicar el formato XXX-XXX-XXXX
    	if (phoneNumber.length > 0) {
        phoneNumber = phoneNumber.match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
        input.value = !phoneNumber[2] ? phoneNumber[1] : phoneNumber[1] + '-' + phoneNumber[2] + (phoneNumber[3] ? '-' + phoneNumber[3] : '');
    		}
    	}
		</script>
	</div>
</body>
</html>
</html>