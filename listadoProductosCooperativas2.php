<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

if( $totalRows_cooperativa==0){
echo "<script type=\"text/javascript\">alert ('No existen Cooperativas Registradas'); location.href='sistemenus.php' </script>";
 exit;
}

$maxRows_productos = 10;
$pageNum_productos = 0;
if (isset($_GET['pageNum_productos'])) {
  $pageNum_productos = $_GET['pageNum_productos'];
}
$startRow_productos = $pageNum_productos * $maxRows_productos;

mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where rif='$row_cooperativa[rif]'";
$query_limit_productos = sprintf("%s LIMIT %d, %d", $query_productos, $startRow_productos, $maxRows_productos);
$productos = mysql_query($query_limit_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);

if (isset($_GET['totalRows_productos'])) {
  $totalRows_productos = $_GET['totalRows_productos'];
} else {
  $all_productos = mysql_query($query_productos);
  $totalRows_productos = mysql_num_rows($all_productos);
}
$totalPages_productos = ceil($totalRows_productos/$maxRows_productos)-1;

$queryString_productos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_productos") == false && 
        stristr($param, "totalRows_productos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_productos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_productos = sprintf("&totalRows_productos=%d%s", $totalRows_productos, $queryString_productos);


if( $totalRows_productos==0){
echo "<script type=\"text/javascript\">alert ('No existen Productores Registrados que Pertenezcan a esta Cooperativa'); location.href='sistemenus.php' </script>";
 exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listados de Productos por Cooperativa</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Listados de Productos por Cooperativa </span></p>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th colspan="5" bgcolor="#FFFFFF" scope="col"><span class="Estilo1">Cooperativa: <?php echo $row_cooperativa['nombre']; ?></span></th>
  </tr>
  <tr>
    <th width="157" bgcolor="#FF0000" scope="col"><span class="Estilo1">Nombre del Producto </span></th>
    <th width="154" bgcolor="#FF0000" scope="col"><span class="Estilo1">Unidad </span></th>
    <th width="164" bgcolor="#FF0000" scope="col"><span class="Estilo1">Cantidad</span></th>
    <th width="151" bgcolor="#FF0000" scope="col"><span class="Estilo1">Tiempo</span></th>
    <th width="165" bgcolor="#FF0000" scope="col"><span class="Estilo1">Costo </span></th>
  </tr>
  <?php do { ?>
  <tr>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_productos['nombre']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_productos['medida']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_productos['cantidad']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_productos['tiempo2']." ".$row_productos['tiempo']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_productos['costo']; ?> Bs </span></th>
  </tr>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_productos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, 0, $queryString_productos); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_productos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, max(0, $pageNum_productos - 1), $queryString_productos); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productos < $totalPages_productos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, min($totalPages_productos, $pageNum_productos + 1), $queryString_productos); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productos < $totalPages_productos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, $totalPages_productos, $queryString_productos); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
  <?php } while ($row_productos = mysql_fetch_assoc($productos)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($cooperativa);

mysql_free_result($productos);
?>
