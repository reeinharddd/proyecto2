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
	<link rel="stylesheet" href="../../CSS/form.css">

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
	<h1>Agregar nuevo Productos/Servicios</h1>
	Ingresa los datos correspondientes del producto o servicio que deseas agregar. <br>
	<br>
	<div class="agregarForm">
	<div class="container">
		<div class="agregarForm">
		<form action="addProducto.php" method="post">
			<label class="labelProdu">Nombre del Producto/Servicio:</label> <br>
			<input type="text" name="txtNom"  required> <br><br>
			<label class="labelDescrip">Descripción del Producto/Servicio</label> <br>
			<input type="text" name="txtDesc" required> <br><br>
			<label class="labelEntrega">Tipo de Entrega del Producto/Servicio</label> <br>
			<select name="listEntrega" id="listEntrega" onchange="controlarSelectCate(this)">
				<option value="Retornable">Retornable</option>
				<option value="No retornable">No retornable</option>
			</select> <br> <br>
			<label for="listCate">Categoria:</label>
			<select name="listCate" id="listCate" onchange="controlarSelectCate(this)">
				<?php
				include('Producto.php');
				$miobjeto = new Producto();
				$dataset = $miobjeto->getAllCategorias();
				while ($tupla = mysqli_fetch_assoc($dataset)) {
					echo "<option name = \"listCate\" value=\"" . $tupla['idCategoria'] . "\" title=\"" . $tupla['nomCategoria'] . "\">" . $tupla['nomCategoria'] . "</option>";
				}
				?>
			</select>
			<br><br>
			<label for="listDepa">Departamento:</label>
			<select name="listDepa" id=listDepa>
				<?php
					$dataset = $miobjeto->getAllDepa();
					while ($tupla = mysqli_fetch_assoc($dataset)) {	
						if ($tupla['nomDepartamento'] !== 'Mantenimiento') {
							echo "<option name=\"listDepa\" value=\"" . $tupla['idDepartamento'] . "\" title=\"" . $tupla['nomDepartamento'] . "\">" . $tupla['nomDepartamento'] . "</option>";
						}
					}
				?>
			</select>
			<br>
			<input type="submit" value="Agregar">
			<a href="gestionProducto.php">Regresar</a>
	<script>
	var esPrimeraCarga = true;
	function controlarSelectCate() {
	var selectDepartamento = document.getElementById('listDepa');
	var selectCategoria = document.getElementById('listCate');
	var tipoProducto = document.getElementById('listEntrega').value; //Tipo de producto
	if (esPrimeraCarga) {
		selectCategoria.innerHTML = '';
		if (tipoProducto === 'Retornable') {
			agregarOpciones(selectCategoria, [{value: '4', text: 'Mantenimiento'}, {value: '3', text: 'Suministros'}]);
		} else if (tipoProducto === 'No retornable') {
			agregarOpciones(selectCategoria, [{value: '1', text: 'Documentos'}, {value: '2', text: 'Interpersonal'}]);
		}
		esPrimeraCarga = false;
	}
		selectDepartamento.innerHTML = '';
		if (tipoProducto === 'Retornable') {
			agregarOpcion(selectDepartamento, '2', 'Almacén');
		} else if (tipoProducto === 'No retornable') {
			agregarOpcion(selectDepartamento, '1', 'Recursos Humanos');
		}
	}
	function agregarOpciones(selectElement, opciones) {
	opciones.forEach(function(opcion) {
		agregarOpcion(selectElement, opcion.value, opcion.text);
			}
		);
	}
	function agregarOpcion(selectElement, value, text) {
	var option = document.createElement('option');
		option.value = value;
		option.text = text;
		selectElement.appendChild(option);
	}

	document.getElementById('listEntrega').onchange = function() {
	esPrimeraCarga = true;
	controlarSelectCate();
	};
	window.onload = controlarSelectCate;
	</script>
	</div>
</body>
</html>
</html>