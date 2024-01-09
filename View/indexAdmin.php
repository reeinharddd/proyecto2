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
    <link rel="stylesheet" href="../CSS/indexA.css">
	<link rel="stylesheet" href="../CSS/sidemenu.css">
</head>
<body>
	<div id="sidemenu" class="menu-collapsed">
		<div id="header">
			<div id="menu-btn">
				<div class="btn-hamburger"></div>
				<div class="btn-hamburger"></div>
				<div class="btn-hamburger"></div>
			</div>
			<div id="title"><span>Menu</span></div>	
			
		</div>
		<!-- PROFILE-->
		<div id="profile">
		<?php
			if (!isset($_SESSION['profile_pic'])) {
				echo '<div id="photo"><img src="../img/profiles_pics/administrador.png alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Administrador</span></div>
		</div>
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

			<!---
			<div class="item">
				<a href="adminCategorias.php">
					<div class="icon"><img src="../../img/administrarCategoriasImagen.png" alt=""></div>
					<div class="title"><span>Administrar categorias</span></div>
				</a>
			</div>
			---->
			
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
	<!--Agregue el mensaje de bienvenida para el usuario que inicio sesion-->
	<main class = "mainE">
		<h1>BIENVENIDO DE NUEVO</h1>
	<div class='profile'>
        <div class='top'>
            <?php
            include ('../Data/Usuario.php');
            $miObjeto = new Usuario();
	$departamento = $miObjeto->getNombreDepartamento($_SESSION['departamento']);
	$rol = $miObjeto->getNombreRol($_SESSION['category']);
    if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
        
           echo  '<p>'.$_SESSION['first_name'].'</p>';
           echo  '<img src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"  />';
            echo '<p>'.$_SESSION['last_name'].'</p>';
        echo '</div>';
       echo '<div class="profile-info">';
            echo '<div class="info followers">';
                echo '<a href="#">';
                   echo  ' <span>'.$departamento.'</span>';
                   
               echo  '</a>';
            echo '</div>';
           echo '<div class="info following">';			
                echo '<a href="#">';
                    echo '<span>'.$_SESSION['mail'].'</span>';
                   
                echo '</a>';
            echo '</div>';
        echo '</div>';
        echo '<div class="contact">';
            echo '<button>Rol: <span>'.$rol.'</span></button>';
            echo  '</div>';	
    echo '</div>';
    }
    ?>	
</main>
<script>
$(".profile").find(".contact").find("button").on('click', function(e){
	e.preventDefault();
	
	if ($(this).hasClass("active")){
		$(this).removeClass("active")
		$(this).find("span").fadeOut(150, function(){
			$(this).text("Contact")
			$(this).fadeIn(150)
		});
		$(this).parent(".contact").removeClass("active")
	}else{
		$(this).addClass("active")
		$(this).find("span").fadeOut(150, function(){
			$(this).text("Back")
			$(this).fadeIn(150)
		});
		$(this).parent(".contact").addClass("active")
	}
	
});
</script>
</body>
</html>