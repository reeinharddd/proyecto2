<?php
require '../App/authentication.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Menu Tecnico</title>
	<title>Menu Usuario</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/normalize.css">
	<link rel="stylesheet" href="../CSS/sidemenu.css">
	<link rel="stylesheet" href="../CSS/indexA.css">
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
				echo '<div id="photo"><img src="../img/profiles_pics/tecnico.png alt="Usuario"></div>';
			}else{
            	echo '<div id="photo"><img src="../img/profiles_pics/'.$_SESSION['profile_pic'].'" alt="Usuario"></div>';
			}
			?>
			<div id="name"><span>Técnico</span></div>
		</div>
		<!---ITEMS-->
		<div id="menu-items">
			<div class="item">
				<a href="indexTech.php">
					<div class="icon"><img src="../img/homeImagen.png" alt=""></div>
					<div class="title"><span>Menú Principal</span></div>
				</a>
			</div>

			<!--<div class="item">
				<a href="../View/Tecnico/tareasDisponiblesTecnico.php">
					<div class="icon"><img src="../img/tareaDisponibleTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Tareas Disponibles</span></div>
				</a>
			</div>-->

			<div class="item separator"></div>

			<div class="item">
				<a href="../View/Tecnico/tareasAsignadasTecnico.php">
					<div class="icon"><img src="../img/asignacionTecnicoImagen.png" alt=""></div>
					<div class="title"><span>Tareas Asignadas</span></div>
				</a>
			</div>

			<div class="item separator"></div>

			<div class="item">
				<a href="../View/Tecnico/historialSolicitudEmpleado.php">
					<div class="icon"><img src="../img/historialSolicitudesImagen.png" alt=""></div>
					<div class="title"><span>Historial de Solicitudes</span></div>
				</a>
			</div>

			<div class="item">
				<a href="../View/Tecnico/notificacionesTecnico.php">
					<div class="icon"><img src="../img/notificacionesImagen.png" alt=""></div>
					<div class="title"><span>Notificaciones</span></div>
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
				<div class="centroNotis">
				<h1>Centro de Notificaciones</h1>
				<table class="containerT">
				<tr>
					<th><h1>No.</h1></th>
					<th><h1>Asunto</h1></th>
					<th><h1>Estado</h1></th>
					<th><h1>Fecha</h1></th>
					<th><h1>Remitente</h1></th>
				</tr>
				<?php
				$i = 0;
				$dataset = $miObjeto->getNotificacionesNoLeidas( $_SESSION['user_id']); 
				while ($tupla = mysqli_fetch_assoc($dataset)) { 
					?>
					<tr>
						<td> <?php echo ++$i; ?> </td>
						<td> <?php echo $tupla['asunto']; ?></td>
						<td> <?php echo $tupla['estado']; ?></td>
						<td> <?php echo $tupla['fecha']; ?></td>
						<td> <?php echo $miObjeto->getNombreCompletoUsuario($tupla['idRemitente']); ?></td>
				<?php }
			echo '</table>';
        		echo '</div>';
        	echo '</main>';
        echo '</div>';
    
    ?>
</div>
</body>
</html>