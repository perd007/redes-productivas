<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

//capturar valor red
$red=$_GET['redes'];


$maxRows_hijos = 10;
$pageNum_hijos = 0;
if (isset($_GET['pageNum_hijos'])) {
  $pageNum_hijos = $_GET['pageNum_hijos'];
}
$startRow_hijos = $pageNum_hijos * $maxRows_hijos;

mysql_select_db($database_conexion, $conexion);
$query_hijos = "SELECT  count(productor) as hijos, productor  FROM hijos where red=$red group by productor order by productor desc";
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

mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id=$red";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

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

if($totalRows_hijos==0){
echo"<script type=\"text/javascript\">alert ('No existen Hijos de Productores que Pertenescan a esta Red'); location.href='sistemenus.php' </script>";
exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estadisticas de Hijos por Red</title>
<style type="text/css">
<!--
.Estilo4 {font-size: 18px}
.Estilo3 {font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Estadisticas de Hijos</span> <span class="Estilo3">por Red </span></p>
<table width="904" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FFFFFF">
    <th colspan="4" scope="col"><span class="Estilo4">RED:
      <?php  echo $row_redes['nombre']; ?>
    </span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th width="174" scope="col"><span class="Estilo4">Nombre</span></th>
    <th width="191" scope="col"><span class="Estilo4">Apellido</span></th>
    <th width="188" scope="col"><span class="Estilo4">Esposa/Esposo</span></th>
    <th width="133" scope="col"><span class="Estilo4">Cant. Hijos </span></th>
  </tr>
  <?php do { 
	  
	mysql_select_db($database_conexion, $conexion);
	$query_productores = "SELECT * FROM productores where id_red=$red and cedula='$row_hijos[productor]'";
	$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
	$row_productores = mysql_fetch_assoc($productores);
	$totalRows_productores = mysql_num_rows($productores);
	
	if($row_hijos['productor']==$row_productores['cedula']){
	  
	  ?>
  <tr bgcolor="#FF0000">
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo4"><?php echo $row_productores['nombre']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo4"><?php echo $row_productores['apellido']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo4"><?php echo $row_productores['esposa']; ?></span></th>
    <th bgcolor="#FFFFFF" scope="col"><span class="Estilo4"><?php echo $row_hijos['hijos']; ?></span></th>
  </tr>
  <? }// fin del if ?>
  <?php } while ($row_hijos = mysql_fetch_assoc($hijos)); ?>
  <table border="0" width="50%" align="center">
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
  <tr bgcolor="#FFFFFF"> </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productores);

mysql_free_result($hijos);

mysql_free_result($redes);
?>
