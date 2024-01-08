<?php
require '../App/authentication.php';
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
				<a href="../../View/Admin/catalogo.php">
					<div class="icon"><img src="../../img/catalogo.png" alt=""></div>
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
    <?php
    include ('Usuario.php');
    $miobjeto = new Usuario();
    // Obtener detalles del usuario si se pasa el user_id como parámetro GET
    if (isset($_GET['user_id'])) { //Verificacmos si exitse el parametro del "user_id", tambien sirve para identificar al usuario que se va a editar
        $datosUsuario = mysqli_fetch_assoc($miobjeto->getUsuarioById($_GET['user_id'])); //Obtenemos los datos del usuario al que se le haya llamado
        $user_id = $datosUsuario['user_id'];
        $first_name = $datosUsuario['first_name'];
        $last_name = $datosUsuario['last_name'];
		$email = $datosUsuario['email'];
        $password = $datosUsuario['password'];
        $numTel = $datosUsuario['numTel'];
        $nickname = $datosUsuario['nickname'];
        $categoria = $datosUsuario['category'];
		$idDepaUsuario = $datosUsuario['idDepaUsuario'];
    }
    ?>
    <!-- Formulario de para editar los datos del usuario -->
    <h2>Editar usuario</h2>
	<div class="container">
    <form class = "form" method="post" action="actualizarUsuario.php" enctype = "multipart/form-data">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" ><br> <!--Aqui solo lee el "user_id"--->
        Nombre: <input type="text" name="first_name" value="<?php echo $first_name; ?>" readonly><br><br> <!--El echo nos ayuda a mostrar el dato del usuario actual--->
        Apellido: <input type="text" name="last_name" value="<?php echo $last_name; ?>" readonly><br><br>
		Correo: <input type="text" name="email" value="<?php echo $email; ?>"><br><br>
        <!--Contraseña: <input type="text" name="password" value="<?php echo $password; ?>"><br><br>-->
        Numero de telefono: <input type="text" name="numTel" placeholder="XXX-XXX-XXXX" oninput="formatoTelefono(this)"value="<?php echo $numTel; ?>"><br><br>
        <!--Apodo: <input type="text" name="nickname" value="<?php echo $nickname; ?>"><br><br>-->
        <label for="listCategoria">Rol:</label>
		<select name="listCategoria" id=listCategoria  onchange="controlarSelectDepartamento(this)">
			<?php
			$dataset = $miobjeto->getAllRoles();
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				echo "<option name = \"listCategoria\" value=\"" . $tupla['idRol'] . "\" title=\"" . $tupla['nombre'] . "\">" . $tupla['nombre'] . "</option>";
			}
			?>
		</select>
		<br><br>
		<label for="listDepartamento" style="display:none;" id = "labelDepartamento">Departamento:</label>
		<select name="listDepartamento" id=listDepartamento  style="display:none;" readonly title="Mantenimiento" value="3">
			<?php
			$dataset = $miobjeto->getAllDepartamento();
			while ($tupla = mysqli_fetch_assoc($dataset)) {
				echo "<option name = \"listDepartamento\" value=\"" . $tupla['idDepartamento'] . "\" title=\"" . $tupla['nomDepartamento'] . "\">" . $tupla['nomDepartamento'] . "</option>";
			}
			?>
		</select>
        <input type="submit" name="submit" value="Actualizar">
		<a href="../View/Admin/gestionUsuarios.php">Regresar</a>
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