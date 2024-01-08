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
	<link rel="stylesheet" href="../../CSS/form.css">
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
    include ('Producto.php');
    $miobjeto = new Producto();
    if (isset($_GET['idProducto'])) { //Verificacmos si exitse el parametro del "idProducto", tambien sirve para identificar al departamento que se va a editar
        $datosProducto = $miobjeto->getProductoById($_GET['idProducto']); //Obtenemos los datos del producto al que se le haya llamado
        $idProducto = $datosProducto['idProducto'];
        $nomProducto = $datosProducto['nomProducto'];
        $descripcion = $datosProducto['descripcion'];
		$tipoEntrega = $datosProducto['tipoEntrega'];

    }
    if (isset($_POST['submit'])) { //aqui se verifica si se enviaron datos desde un formulario con ayuda del metodo POST y si existe un input con el numbre "submit"
        $miobjeto->setNomProducto($_POST['nomProducto']);//Se obtinen los nuevos valores del formulario, el metodo POST recupera esos datos
        $miobjeto->setDescProducto($_POST['descripcion']);
		$miobjeto->setTipoEntrega($_POST['tipoEntrega']);
        //Manda los datos nuevo a la base de datos
        $miobjeto->setUpdateProducto($_POST['idProducto']);
    }
    ?>
    <!-- Formulario de para editar los datos del producto -->
    <h2>Editar Producto/Servicio</h2>
	<div class="container">
    <form class="form" method="post" action="actualizarProducto.php">
        <input type="hidden" name="idProducto" value="<?php echo $idProducto; ?>" ><br> <!--Aqui solo lee el "idProducto"--->
        Nombre del Producto: <input type="text" name="nomProducto" value="<?php echo $nomProducto; ?>" readonly><br><br> <!--El echo nos ayuda a mostrar el dato del producto actual--->
        Descripción del Producto: <input type="text" name="descripcion" value="<?php echo $descripcion; ?>"><br><br>
		Tipo de Entrega (Retornable/No retorble): <input type="text" name="tipoEntrega" value="<?php echo $tipoEntrega;?>" readonly><br><br>
        <input type="submit" name="submit" value="Actualizar">
		<a href="gestionProducto.php">Regresar</a>
    </form>
	</div>