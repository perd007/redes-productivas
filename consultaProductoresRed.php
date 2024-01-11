<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='sistemenu.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenu.php'  </script>";
 exit;
}
?>
<?php

$red=$_GET["redes"];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_productores = 50;
$pageNum_productores = 0;
if (isset($_GET['pageNum_productores'])) {
  $pageNum_productores = $_GET['pageNum_productores'];
}
$startRow_productores = $pageNum_productores * $maxRows_productores;

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where id_red='$red' or id_red2='$red' or id_red3='$red' or id_red4='$red' order by cedula asc";
$query_limit_productores = sprintf("%s LIMIT %d, %d", $query_productores, $startRow_productores, $maxRows_productores);
$productores = mysql_query($query_limit_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);

if (isset($_GET['totalRows_productores'])) {
  $totalRows_productores = $_GET['totalRows_productores'];
} else {
  $all_productores = mysql_query($query_productores);
  $totalRows_productores = mysql_num_rows($all_productores);
}
$totalPages_productores = ceil($totalRows_productores/$maxRows_productores)-1;


$queryString_productores = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_productores") == false && 
        stristr($param, "totalRows_productores") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_productores = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_productores = sprintf("&totalRows_productores=%d%s", $totalRows_productores, $queryString_productores);

//verificar si existen productores Registrados
if($totalRows_productores==0){
echo"<script type=\"text/javascript\">alert ('No Existen Productores Registrados'); location.href='sistemenus.php?valor=p1&link=link2' </script>";
exit;
}


?>
<html >
<head>
<title>Consulta de Productores</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	text-align: center;
}
.Estilo2 {
	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Productor?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
//-->
</script>

<body>
<p align="center" class="Estilo5 Estilo2">Consulta de Productores por Red</p>
<table width="853" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="154" scope="col"><span class="Estilo1">Cedula</span></th>
    <th width="163" scope="col"><span class="Estilo1">Nombre </span></th>
    <th width="163" scope="col"><span class="Estilo1">Apellido</span></th>
    <th width="177" scope="col"><span class="Estilo1">Red</span></th>
    <th width="57" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="57" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="68" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  <?php do { ?>
  <?php

			$modulo=$cont%2;
			
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			}
			
			
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id='$row_productores[id_red]' or id='$row_productores[id_red2]' or id='$row_productores[id_red3]' or id='$row_productores[id_red4]'";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);
	
	
	  ?>
  <tr bgcolor="<?php echo $color; ?>">
    <td><div class="Estilo1"><?php echo $row_productores['cedula']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_productores['nombre']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_productores['apellido']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_redes['nombre']; ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a href='sistemenus.php?cedula=$row_productores[cedula]&valor=mpr&link=link2&codigo=$red&consu=2'>Modificar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a onClick='return validar()' href='sistemenus.php?cedula=$row_productores[cedula]&valor=epr&link=link2&consu=2&red=$red'>Eliminar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a href='sistemenus.php?cedula=$row_productores[cedula]&valor=dpr&link=link2'>Detalles</a>" ?></div></td>
  </tr>
  <?php 
		$cont++;
		} while ($row_productores = mysql_fetch_assoc($productores)); ?>
  <table border="0" align="center">
    <tr>
      <td  align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, 0, $queryString_productores); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, max(0, $pageNum_productores - 1), $queryString_productores); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, min($totalPages_productores, $pageNum_productores + 1), $queryString_productores); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, $totalPages_productores, $queryString_productores); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productores);

mysql_free_result($redes);
?>
