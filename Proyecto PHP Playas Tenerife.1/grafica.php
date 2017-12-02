<?PHP 
	$conn = new mysqli("localhost", "adminPlayas", "cjwSA2F2mEpZZrBc", "playasdb");
	//Check connection
	if($conn->connect_error){
	die("La conexión ha fallado: " .$conn->connect_error);
	}
	//Cambiamos la codificación		
	if(!$conn->set_charset("utf8")){
	printf("Error cargando el conjunto de caracteres utf8: %s\n");
	}else{
			//printf("Conjunto de caracteres actual: %s\n <br>", $conn->character_set_name());
	}
	class ElementoDataset{
		var $value;
		var $label;
		function __construct($label, $value){
			$this->label = $label;
			$this->value = $value;
		}
	}
	$sql = "SELECT COUNT(nombre) as nombre, nombreMun FROM playas INNER JOIN municipio ON idMun = idMunicipio GROUP BY nombreMun";
	$result = mysqli_query($conn, $sql);
	$dataset = array(["Municipio", "Cantidad"]);
	while ($row = mysqli_fetch_array($result)){
		$nombreMun = $row["nombreMun"];
		$nombre =  intval($row["nombre"]);
		array_push($dataset, array($nombreMun, $nombre));
	}
	//var_dump(json_encode($dataset));
?>
<html>
  <head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?PHP echo json_encode($dataset); ?>);
        var options = {
          title: 'Densidad de playas por municipio',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
	<style type="text/css">
		body { background-color: white; }
	</style>
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
		<a class="menulinks" href="todas.php" >Todas las playas </a>| Gráfico |<a class="menulinks" href="login.php" > Log-in </a>| <?PHP if(ISSET($_SESSION["user"])){ echo $user." |"; echo "<a class='menulinks' href='logout.php'> Salir</a> ". "| ";} if($privilegios == 1) echo "<a class='menulinks' href='insertar.php'> Actualizar registros</a> ";?> 
		</p>
		<p>
		Playas de Tenerife
		</p>
		</div>
	</div>
    <div class="grafico" id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>