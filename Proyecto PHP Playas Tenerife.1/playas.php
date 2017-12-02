<!doctype html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style.css">
	<title>Playas Tenerife</title>
</head>
<body>
<?PHP
	session_start();
	if(ISSET($_SESSION["user"]) && ISSET($_SESSION["privilegios"]))	{
		$user = $_SESSION["user"];
		$privilegios = $_SESSION["privilegios"];
	} else{
		$privilegios = 0;
		session_destroy();
	}
?>
	<div class="header">
		<div class="titulo">
		<p class="linkshead">
				<a class="menulinks" href="todas.php" >Todas las playas </a>| <a href="grafica.php" class="menulinks" >Gráfico</a> |<a class="menulinks" href="login.php" > Log-in </a>| <?PHP if(ISSET($_SESSION["user"])){ echo $user." |"; echo "<a class='menulinks' href='logout.php'> Salir</a> ". "| ";} if($privilegios == 1) echo "<a class='menulinks' href='insertar.php'> Actualizar registros</a> ";?>
		</p>
		<p>
		Playas de Tenerife
		</p>
		</div>
	</div>
	<?PHP 
		function conexion($consulta){ //funcion a la que le paso un string de consulta y devuelve una variable con el array de los resultados
			$servername = "localhost";
			$username = "adminPlayas";
			$password = "cjwSA2F2mEpZZrBc";
			$dbname = "playasdb";
			//Create connection
			$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
			//Check connection
			if($conn->connect_error){
				die("La conexión ha fallado: " .$conn->connect_error);
			}
			//Cambiamos la codificación		
			if(!$conn->set_charset("utf8")){
				printf("Error cargando el conjunto de caracteres utf8: %s\n");
			}else{
			}
			$resultado = mysqli_query($conn, $consulta);
			return($resultado);
		}
	?>
	<?PHP 
		if(isset($_GET["id"]) && !EMPTY($_GET["id"])){
			$idPlaya = $_GET["id"];
			//echo $idPlaya;
		}else{
			header("Location: error.php");
		}
		function conexionDropDown(){//Funcion para llenar el dropdown
		
			$servername = "localhost";
			$username = "adminPlayas";
			$password = "cjwSA2F2mEpZZrBc";
			$dbname = "playasdb";
			//Create connection
			$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
			//Check connection
			if($conn->connect_error){
				die("La conexión ha fallado: " .$conn->connect_error);
			}
			//Cambiamos la codificación		
			if(!$conn->set_charset("utf8")){
				printf("Error cargando el conjunto de caracteres utf8: %s\n");
			}else{
			}
			$selectDropDownList = "SELECT idMunicipio, nombreMun FROM municipio";
			$result = mysqli_query($conn, $selectDropDownList);
			echo "<div class='selectdiv'>";
			echo "<form class='demo' action='inicio.php' method='POST'>";
			echo "<select class='black' name='municipios' onchange='this.form.submit()'>";
			echo "<option>Seleccione un municipio</option>";
			while ($row = mysqli_fetch_array($result)){
				echo "<option value=".$row['idMunicipio']." >".$row['nombreMun']."</option>";
			
			}
			echo "</select>";	
			echo "</div>";
			echo "</form>";

			$conn->close();
		}
		conexionDropDown(); //FUNCION QUE RELLENA EL DROPDOWNLIST
		function mostrarResultadosPlaya($idPlaya){
			$servername = "localhost";
			$username = "adminPlayas";
			$password = "cjwSA2F2mEpZZrBc";
			$dbname = "playasdb";
			//Create connection
			$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
			//Check connection
			if($conn->connect_error){
				die("La conexión ha fallado: " .$conn->connect_error);
			}
			//Cambiamos la codificación		
			if(!$conn->set_charset("utf8")){
				printf("Error cargando el conjunto de caracteres utf8: %s\n");
			}else{
			}
			/////////////ESTAMOS CONECTADOS////////////////
			$selectPlaya = "SELECT nombre, descripcion, idPlaya, direccion, idMun,playaSize, longitud, latitud, imagen, municipio.nombreMun FROM playas INNER JOIN municipio ON idMun = municipio.idMunicipio WHERE idPlaya = $idPlaya";
			$result = mysqli_query($conn, $selectPlaya);
			while ($row = mysqli_fetch_array($result)){ //Vamos a mostrar los resultados construyendo un lenguaje de marcas adaptado al CSS
				echo "<h2>".$row["nombre"]."</h2><br>";
				echo "<p class='beachind'>";
				echo "<span class='label'>Dirección: </span>".$row["direccion"]."<br>";
				echo "<span class='label'>Municipo: </span>" .$row["nombreMun"]."<br>"; 
				echo "<span class='label'>Tamaño de la playa: </span>" .$row["playaSize"]."<br>";
				echo "<span class='label'>Descripcion: </span><br>";
				echo $row["descripcion"]."<br>";
				//MAPA DE GOOGLE//////////////////////////////////////
				error_reporting(E_ALL ^ E_NOTICE);
				require_once("include/GoogleMap.php");
				require_once("include/JSMin.php");
				$gmap = new GoogleMapAPI();
				$gmap->addMarkerByCoords($row["latitud"], $row["longitud"]);
				require_once('include/gmap_template.php');
			}
			echo "</p>";
			$selectMedia = "SELECT AVG(puntuacion) as media FROM valoraciones WHERE idPlaya = $idPlaya";
			$result = mysqli_query($conn, $selectMedia);
			while ($row = mysqli_fetch_array($result)){
				echo "<h2 class='media'>";
				echo "Nota media: ".round($row["media"]);
				echo "</h2>";
			}
		}
	?>
			<div class="playa">
				<?PHP mostrarResultadosPlaya($idPlaya); ?>
			</div>
			<div class="comentarios">
			<h2>Deja tu comentario sobre esta playa</h2>
				<?PHP echo "<form action='comentarios.php?id=".$idPlaya."' method='post'>" ?>
				<!--<form action="" method='post'> <!--ME QUEDE POR AQUI TENGO QUE PASAR EL ID AL COMENTARIO-->
				<p>
					Introduce tu nombre:<br>
					<input name="nombre" type="text"/><br>
					Deja tu valoración:<br>
					<input name="puntuacion" type="number" name="puntuacion" min="1" max="10"><br>
					Deja tu comentario:<br>
					<textarea name="comentario" rows="4" cols="60" maxlength="50"></textarea><br>
					<input type="hidden" name="id" value="<?PHP $idPlaya; ?>">
					<input type="submit" value="Enviar"><hr>	
				</p>
				</form>
	<!--		<h2>Comentarios</h2>
				<?PHP
				/*
					$cadena = "SELECT comentario, nickname, puntuacion  FROM valoraciones WHERE idPlaya = $idPlaya";
					$result = conexion($cadena);
					while ($row = mysqli_fetch_array($result)){
						echo "<p class='comentario'>";
						echo "Nombre: " . $row["nickname"]."<br>";
						echo "Valoró con un " .$row["puntuacion"]."<br>";
						echo "Comentó: " .$row["comentario"]."<br>";
						echo "</p>";
					}
				*/
				?>
			
			</div>-->
			
</body>
</html>