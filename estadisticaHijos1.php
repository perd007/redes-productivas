<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_hijos = 10;
$pageNum_hijos = 0;
if (isset($_GET['pageNum_hijos'])) {
  $pageNum_hijos = $_GET['pageNum_hijos'];
}
$startRow_hijos = $pageNum_hijos * $maxRows_hijos;

mysql_select_db($database_conexion, $conexion);
$query_hijos = "SELECT  count(productor) as hijos, productor  FROM hijos group by productor order by productor desc";
$query_limit_hijos = sprintf("%s LIMIT %d, %d", $query_hijos, $startRow_hijos, $maxRows_hijos);
$hijos = mysql_query($query_limit_hijos, $conexion) or die(mysql_error());
$row_hijos = mysql_fetch_assoc($hijos);

if (isset($_GET['totalRows_hijos'])) {
  $totalRows_hijos = $_GET['totalRows_hijos'];
} else {
  $all_hijos = mysql_query($query_hijos);
  $totalRows_hijos = mysql_num_rows($all_hijos);
}
$totalPages_hijos = ceil($totalRows_hijos/$maxRows_hijos)-1;

$queryString_hijos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_hijos") == false && 
        stristr($param, "totalRows_hijos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_hijos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_hijos = sprintf("&totalRows_hijos=%d%s", $totalRows_hijos, $queryString_hijos);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estadisticas de Hijos</title>
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
<p align="center"><span class="Estilo3">Estadisticas de Hijos </span></p>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="174" scope="col"><span class="Estilo1">Nombre</span></th>
    <th width="191" scope="col"><span class="Estilo1">Apellido</span></th>
    <th width="188" scope="col"><span class="Estilo1">Esposa/Esposo</span></th>
    <th width="133" scope="col"><span class="Estilo1">Cant. Hijos </span></th>
  </tr>
  <?php do { 
	  
	  
	  mysql_select_db($database_conexion, $conexion);
	  $query_prodcutores = "SELECT * FROM productores where cedula='$row_hijos[productor]'";
	  $prodcutores = mysql_query($query_prodcutores, $conexion) or die(mysql_error());
	  $row_prodcutores = mysql_fetch_assoc($prodcutores);
	  $totalRows_prodcutores = mysql_num_rows($prodcutores);
		
		if($row_hijos['productor']==$row_prodcutores['cedula']){
	  ?>
  <tr bgcolor="#FFFFFF">
    <td><div align="center" class="Estilo1"><?php echo $row_prodcutores['nombre']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_prodcutores['apellido']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_prodcutores['esposa']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_hijos['hijos']; ?></div></td>
  </tr>
  <?php 
		}//fin del if
		} while ($row_hijos = mysql_fetch_assoc($hijos)); ?>
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_hijos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_hijos=%d%s", $currentPage, 0, $queryString_hijos); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_hijos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_hijos=%d%s", $currentPage, max(0, $pageNum_hijos - 1), $queryString_hijos); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_hijos < $totalPages_hijos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_hijos=%d%s", $currentPage, min($totalPages_hijos, $pageNum_hijos + 1), $queryString_hijos); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_hijos < $totalPages_hijos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_hijos=%d%s", $currentPage, $totalPages_hijos, $queryString_hijos); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($hijos);

mysql_free_result($prodcutores);
?>
