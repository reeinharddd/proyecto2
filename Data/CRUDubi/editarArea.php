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
    include ('Area.php');
    $miobjeto = new Area();
    // Obtener detalles del area si se pasa el idArea como parámetro GET
    if (isset($_GET['idArea'])) { //Verificacmos si exitse el parametro del "idArea", tambien sirve para identificar al area que se va a editar
        $datosArea = $miobjeto->getAreaById($_GET['idArea']); //Obtenemos los datos del area al que se le haya llamado
        $idArea = $datosArea['idArea'];
        $nombre = $datosArea['nombre'];
        $ubicacion = $datosArea['ubicacion'];
		$idDepartamento = $datosArea['idDepartamento'];

    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomArea($_POST['nombre']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setUbi($_POST['ubicacion']);
		$miobjeto->setDepa($_POST['idDepartamento']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateArea($_POST['idArea']);
    }
    ?>
    <!-- Formulario de para editar los datos del area -->
    <h2>Editar Area de Trabajo</h2>
    <form method="post" action="actualizarArea.php">
        <input type="hidden" name="idArea" value="<?php echo $idArea; ?>" ><br> <!--Aqui solo lee el "idArea"--->
        Nombre de la Area: <input type="text" name="nombre" value="<?php echo $nombre; ?>" $readonly><br><br> <!--El echo nos ayuda a mostrar el dato del producto actual--->
        Ubicacion del Area: <input type="text" name="ubicacion" value="<?php echo $ubicacion; ?>"><br><br>
        <input type="submit" name="submit" value="Actualizar">
		<a href="gestionArea.php">Regresar</a>
    </form>