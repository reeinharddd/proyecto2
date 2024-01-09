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
		<main class = "mainE">
    <h1>Menu de Gestion de Productos/Servicios</h1>
	<br>
	<?php include ('Producto.php'); ?>
            <?php $miobjeto = new Producto (); ?>
            <?php $dataset = $miobjeto->getAllProductos();?>
			<a href="../../View/Admin/catalogo.php" class="cata">Regresar al catalogo</a>
		<h2>Almacen.</h2>
		<br>
		<a href="agregarProducto.php" class="btn-agregar">Agregar nuevo Producto/Servicio</a>
		<table class="containerT">
			<thead>
    <tr>
        <th><h1>Numero de Producto</h1></th>
        <th><h1>Nombre del Producto</h1> </th>
        <th><h1>Descripción del Producto</h1></th>
		<th><h1>Tipo de Producto</h1></th>
        <th><h1>Categoria del Producto</h1></th>
        <th><h1>Departamento del Producto</h1></th>
		<th><h1>Acciones</h1></th>
    </tr>
	</thead>
    <?php while ($tupla = mysqli_fetch_assoc($dataset)) { ?>
		<?php
			switch ($tupla['idCatProducto']) {
				case 1:
					$catProdu = "Documentos";
				break;
				case 2:
					$catProdu = "Interpersonal";
				break;
				case 3:
					$catProdu = "Suministros";
				break;
				case 4:
					$catProdu = "Mantenimiento";
				break;
				default:
					$catProdu = "Categoria no registrada";
				break;
			}
				switch ($tupla['idDepaProducto']) {
					case 1:
						$depaProdu = "Recursos Humanos";
					break;
					case 2:
						$depaProdu = "Almacén";
					break;
					case 3:
						$depaProdu = "Mantenimiento";
					break;
					default:
						$catProdu = "Departamento no registrado";
						break;
			}?>
			<tbody>
		<tr>
    		<td> <?php echo $tupla['idProducto']; ?> </td>
    		<td> <?php echo $tupla['nomProducto'];  ?></td>
    		<td> <?php echo $tupla['descripcion']; ?></td>
			<td> <?php echo $tupla['tipoEntrega']; ?></td>
    		<td> <?php echo $catProdu ?></td>
            <td> <?php echo $depaProdu ?></td>
    		<td class="actions">
        		<input type="button" value="Editar" onclick="location.href='editarProducto.php?idProducto=<?php echo $tupla['idProducto']; ?>'" class="edit-btn">
        		<input type="button" value="Eliminar" onclick="location.href='eliminarProducto.php?idProducto=<?php echo $tupla['idProducto']; ?>'" class="delete-btn">
    		</td>
		</tr>
		</tbody>
    <?php } ?>
</table>
</main>
</body>
</html>
</html>