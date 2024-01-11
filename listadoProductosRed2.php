<?php require_once('Connections/conexion.php'); ?>
<?php

$red=$_GET['redes'];
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_producto = 10;
$pageNum_producto = 0;
if (isset($_GET['pageNum_producto'])) {
  $pageNum_producto = $_GET['pageNum_producto'];
}
$startRow_producto = $pageNum_producto * $maxRows_producto;

mysql_select_db($database_conexion, $conexion);
$query_producto = "SELECT * FROM productos where red='$red'";
$query_limit_producto = sprintf("%s LIMIT %d, %d", $query_producto, $startRow_producto, $maxRows_producto);
$producto = mysql_query($query_limit_producto, $conexion) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);




if (isset($_GET['totalRows_producto'])) {
  $totalRows_producto = $_GET['totalRows_producto'];
} else {
  $all_producto = mysql_query($query_producto);
  $totalRows_producto = mysql_num_rows($all_producto);
}
$totalPages_producto = ceil($totalRows_producto/$maxRows_producto)-1;



$queryString_producto = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_producto") == false && 
        stristr($param, "totalRows_producto") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_producto = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_producto = sprintf("&totalRows_producto=%d%s", $totalRows_producto, $queryString_producto);


if($totalRows_producto==0){
echo "<script type=\"text/javascript\">alert ('No existen Productos Registrados que Pertenezcan a esta Red'); location.href='sistemenus.php' </script>";
 exit;
}

mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id='$red'";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {
	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Listados de Productos por Red </span></p>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="5" bgcolor="#FFFFFF" scope="col"><span class="Estilo1">Red: <?php echo $row_redes['nombre']; ?></span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <td width="231"><div align="center" class="Estilo1"><strong>Nombre del Producto </strong></div></td>
    <td width="154"><div align="center" class="Estilo1"><strong>Unidad</strong></div></td>
    <td width="197"><div align="center" class="Estilo1"><strong>Tiempo de Produccion </strong></div></td>
    <td width="153"><div align="center" class="Estilo1"><strong>Cantidad</strong></div></td>
    <td width="169"><div align="center" class="Estilo1"><strong>Costo</strong></div></td>
  </tr>
  <?php do { ?>
  <tr bgcolor="#FFFFFF">
    <td><div align="center"><span class="Estilo1"><?php echo $row_producto['nombre']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_producto['medida']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_producto['tiempo2']." ".$row_producto['tiempo']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_producto['cantidad']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_producto['costo']; ?>Bs</span></div></td>
  </tr>
  <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_producto > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_producto=%d%s&redes=$red", $currentPage, 0, $queryString_producto); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_producto > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_producto=%d%s&redes=$red", $currentPage, max(0, $pageNum_producto - 1), $queryString_producto); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_producto < $totalPages_producto) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_producto=%d%s&redes=$red", $currentPage, min($totalPages_producto, $pageNum_producto + 1), $queryString_producto); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_producto < $totalPages_producto) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_producto=%d%s&redes=$red", $currentPage, $totalPages_producto, $queryString_producto); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p>&nbsp;</p>
<p></p>
</body>
</html>
<?php
mysql_free_result($producto);

mysql_free_result($redes);


?>
