<?php require_once('Connections/conexion.php'); ?>
<?php

//capturar id red
$red=$_GET["redes"];
$currentPage = $_SERVER["PHP_SELF"];


$maxRows_miembros = 10;
$pageNum_miembros = 0;
if (isset($_GET['pageNum_miembros'])) {
  $pageNum_miembros = $_GET['pageNum_miembros'];
}
$startRow_miembros = $pageNum_miembros * $maxRows_miembros;

mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT  count(cooperativa) as miembros, cooperativa  FROM miembrosc where red=$red  group by cooperativa order by cooperativa desc";
$query_limit_miembros = sprintf("%s LIMIT %d, %d", $query_miembros, $startRow_miembros, $maxRows_miembros);
$miembros = mysql_query($query_limit_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);

if (isset($_GET['totalRows_miembros'])) {
  $totalRows_miembros = $_GET['totalRows_miembros'];
} else {
  $all_miembros = mysql_query($query_miembros);
   $totalRows_miembros= mysql_num_rows($all_miembros);
}
$totalPages_miembros = ceil($totalRows_miembros/$maxRows_miembros)-1;

mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id=$red";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);


$queryString_miembros = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_miembros") == false && 
        stristr($param, "totalRows_miembros") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_miembros = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_miembros = sprintf("&totalRows_miembros=%d%s", $totalRows_miembros, $queryString_miembros);



if( $totalRows_miembros==0){
	echo "<script type=\"text/javascript\">alert ('No existen miembros de Cooperativas Registrados en esta Red'); location.href='sistemenus.php' </script>";
    exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estadistica de Miembrs de Cooperativas por Red</title>
<style type="text/css">
<!--
.Estilo3 {font-size: 14px;
	font-weight: bold;
	font-style: italic;
}
.Estilo4 {font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo4">Estadisticas de Miembros de Cooperativas </span> <span class="Estilo4">por Red </span></p>
<table width="670" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="3" bgcolor="#FFFFFF" scope="col">Red:
      <?php  echo $row_redes['nombre']; ?></th>
  </tr>
  <tr>
    <th width="272" bgcolor="#FF0000" scope="col">Nombre de la Cooperativa </th>
    <th width="192" bgcolor="#FF0000" scope="col">Rif de la Cooperativa </th>
    <th width="184" bgcolor="#FF0000" scope="col">Cantidad de Miembros </th>
  </tr>
  <?php do { 
		  
		  mysql_select_db($database_conexion, $conexion);
		  $query_cooperativa = "SELECT * FROM cooperatva where red=$red and rif='$row_miembros[cooperativa]'";
		  $cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
		  $row_cooperativa = mysql_fetch_assoc($cooperativa);
		  $totalRows_cooperativa = mysql_num_rows($cooperativa);
		  
		  if($totalRows_cooperativa==0){
		echo "<script type=\"text/javascript\">alert ('No existen Cooperativas Registradas en esta Red'); 	location.href='sistemenus.php' </script>";
    exit;
}
		  
		  if($row_cooperativa['rif']==$row_miembros['cooperativa']){
		  
		  ?>
  <tr>
    <td bgcolor="#FFFFFF"><div align="center"><?php echo $row_cooperativa['nombre']; ?></div></td>
    <td bgcolor="#FFFFFF"><div align="center"><?php echo $row_cooperativa['rif']; ?> </div></td>
    <td bgcolor="#FFFFFF"><div align="center"><?php echo $row_miembros['miembros']; ?></div></td>
  </tr>
  <?php 
			} //fin del if
			} while ($row_miembros = mysql_fetch_assoc($miembros)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, 0, $queryString_miembros); ?>">Primero</a>
          <?php } // Show if not first page ?>
      </td>
      <td width="31%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, max(0, $pageNum_miembros - 1), $queryString_miembros); ?>">Anterior</a>
          <?php } // Show if not first page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, min($totalPages_miembros, $pageNum_miembros + 1), $queryString_miembros); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, $totalPages_miembros, $queryString_miembros); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
      </td>
    </tr>
  </table>
</table>
<p align="center">&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($redes);


?>
