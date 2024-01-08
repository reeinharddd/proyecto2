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
<?php
    include ('Departamento.php');
    $miobjeto = new Departamento();
    // Obtener detalles del departamento si se pasa el idDepartamento como parámetro GET
    if (isset($_GET['idDepartamento'])) { //Verificacmos si exitse el parametro del "idDepartamento", tambien sirve para identificar al departamento que se va a editar
        $datosDepa = $miobjeto->getDepaById($_GET['idDepartamento']); //Obtenemos los datos del departamento al que se le haya llamado
        $idDepaUsuario = $datosDepa['idDepartamento'];
        $nomDepartamento = $datosDepa['nomDepartamento'];
        $descripcion = $datosDepa['descripcion'];
		$numTel = $datosDepa['numTel'];
    }
    //Se obtinen los valores del formulario
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomDepartamento($_POST['nomDepartamento']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setDescripcion($_POST['descripcion']);
		$miobjeto->setTelDepa($_POST['numTel']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateDepa($_POST['idDepartamento']);
    }
    ?>
    <!-- Formulario de para editar los datos del departamento -->
    <h2>Editar Departamento</h2>
    <form method="post" action="actualizarDepa.php">
        <input style="display: none;" type="text" name="idDepartamento" value="<?php echo $_GET['idDepartamento'];?>" ><br> <!--Aqui solo lee el "idDepartamento"--->
        Nombre del Departamento: <input type="text" name="nomDepartamento"  required value="<?php echo $nomDepartamento;?>" $readonly ><br><br> <!--El echo nos ayuda a mostrar el dato del departamento actual--->
        Descripción del Departamento: <input type="text" name="descripcion" required value="<?php echo $descripcion; ?>"><br><br>
		Número de Telefono del Departamento: <input type="text" name="numTel" minlength="12" maxlength="12" placeholder="XXX-XXX-XXXX" oninput="formatoTelefono(this)" required value="<?php echo $numTel; ?>" $readonly><br><br>
        <input type="submit" name="submit" value="Actualizar">
		<a href="gestionDepa.php">Regresar</a>
    </form>
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