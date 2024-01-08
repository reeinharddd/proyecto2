<?php
require '../App/authentication.php';
include('Requisicion.php');
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
    <link rel="stylesheet" href="../CSS/normalize.css">
	<link rel="stylesheet" href="../CSS/form.css">

	<link rel="stylesheet" href="../CSS/sidemenu.css">
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
				echo '<div id="photo"><img src="../../img/profiles_pics/usuario.png alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
		</div>
    	<div id="name"><span>Administrador</span></div>
		<!---ITEMS-->
		<div id="menu-items">
		    <div class="item">
		        <a href="../View/indexAdmin.php">
					<div class="icon"><img src="../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menu Principal</span></div>
				</a>
			</div>
			<div class="item">
				<a href="../View/Admin/gestionUsuarios.php">
					<div class="icon"><img src="../img/gestionUsuarioImagen.png" alt=""></div>
					<div class="title"><span>Gestión de usuarios</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="../View/Admin/controlTecnico.php">
					<div class="icon"><img src="../img/controlTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Control tecnico</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="../View/Admin/solicitudes.php">
					<div class="icon"><img src="../img/requisicionesImagen.png" alt=""></div>
					<div class="title"><span>Requisiciones</span></div>
				</a>
			</div>

			<div class="item">
				<a href="../View/Admin/catalogo.php">
					<div class="icon"><img src="../img/catalogo.png" alt=""></div>
					<div class="title"><span>Catálogos</span></div>
				</a>
			</div>
			<div class="item">
				<a href="../App/logout.php">
					<div class="icon"><img src="../img/logout.png" alt=""></div>
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
	Ingresa los datos correspondientes del usuario que deseas agregar. <br>
	<br>
	<div class="container">
    <form class="form" action="addUsuario.php" method="post" enctype = "multipart/form-data">
        <label class="labelUser">Nombre Usuario:</label> <br>
        <input type="text" name="txtUser" pattern="[A-Z][a-z]*" title="La primer letra debe ser Mayuscula" required> <br><br>
        <label class="labelApellido">Apellido</label> <br>
        <input type="text" name="txtApe" pattern="[A-Z][a-z]*" title="La primer letra debe ser Mayuscula" required> <br><br>
		<label class="labelCorreo">Correo</label> <br>
		<input type="email" name="txtEmail" placeholder="nombre@dominio.com" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Ingresa un correo electrónico válido" required> <br><br>
		<label class="labelNick">Nickname:</label><br>
        <input type="text" name="txtNick" required> <br><br>
        <label class="labelContra">Contraseña</label> <br>
        <input type="password" name="txtPass" required> <br><br>
        <label class="labelCorreo">Numero de telefono</label> <br>
        <input type="text" name="numTele" minlength="12" maxlength="12" placeholder="XXX-XXX-XXXX" oninput="formatoTelefono(this)" required> <br><br>
		<label for="listCategoria">Rol:</label> <br>
		<select name="listCategoria" id="listCategoria" onchange="controlarSelectDepartamento(this)">
			<?php
			$myRequisicion = new Requisicion();
			$dataset = $myRequisicion->getAllRoles();
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				echo "<option name=\"listCategoria\" value=\"" . $tupla['idRol'] . "\" title=\"" . $tupla['nombre'] . "\">" . $tupla['nombre'] . "</option>";
			}
			?>
		</select>
		<br><br>

		<label for="listDepartamento" style="display:none;" id = "labelDepartamento">Departamento:</label> <br>
		<select name="listDepartamento" style="display:none;" id="listDepartamento" readonly title="Mantenimiento" value="3">
			<?php
			$dataset = $myRequisicion->getAllDepartamento();
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				echo "<option name=\"listDepartamento\" value=\"" . $tupla['idDepartamento'] . "\" title=\"" . $tupla['nomDepartamento'] . "\">" . $tupla['nomDepartamento'] . "</option>";
			}
			?>
		</select>

		<br>
		<label for="imgPerfil">Imágen de Perfil:</label> 
		<br><input type="file" accept = "image/jpeg" name = "imgPerfil" id="imgPerfil" required>
		<br>
        <input type="submit" value="Agregar">
		<a href="../View/Admin/gestionUsuarios.php">Regresar</a>
		<script>
       function controlarSelectDepartamento(selectCategoria) {
			var selectDepartamento = document.getElementById('listDepartamento');
			var labelDepartamento = document.getElementById('labelDepartamento');
			var seleccion = selectCategoria.options[selectCategoria.selectedIndex];

			// Ocultar si la selección es 'Tecnico' o 'Admin'
			if (seleccion.title === "Tecnico" || seleccion.title === "Admin") {
				selectDepartamento.style.display = "none";
				labelDepartamento.style.display = "none";

				// Configuraciones para 'Tecnico'
				if (seleccion.title === "Tecnico") {
					selectDepartamento.readOnly = true;
					selectDepartamento.title = "Mantenimiento";
					selectDepartamento.value = 3;
				}
			} else {
				// Mostrar si la selección no es 'Tecnico' o 'Admin'
				selectDepartamento.style.display = "block";
				labelDepartamento.style.display = "block";
			}
		}
    </script>
    </form>
	</div>
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
</body>
</html>