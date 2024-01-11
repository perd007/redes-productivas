<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];


$maxRows_miembros = 10;
$pageNum_miembros = 0;
if (isset($_GET['pageNum_miembros'])) {
  $pageNum_miembros = $_GET['pageNum_miembros'];
}
$startRow_miembros = $pageNum_miembros * $maxRows_miembros;

mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT  count(cooperativa) as miembros, cooperativa  FROM miembrosc group by cooperativa order by cooperativa desc";
$query_limit_miembros = sprintf("%s LIMIT %d, %d", $query_miembros, $startRow_miembros, $maxRows_miembros);
$miembros = mysql_query($query_limit_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);

if (isset($_GET['totalRows_miembros'])) {
  $totalRows_miembros = $_GET['totalRows_miembros'];
} else {
  $all_miembros = mysql_query($query_miembros);
  $totalRows_miembros = mysql_num_rows($all_miembros);
}
$totalPages_miembros = ceil($totalRows_miembros/$maxRows_miembros)-1;

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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estadisca de Miembros</title>
<style type="text/css">
<!--
.Estilo4 {font-size: 18px}
.Estilo5 {font-size: 24px}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo7 Estilo2 Estilo5"><strong>Consulta de Miembros de Cooperativas </strong></span></p>
<table width="757" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="344" bgcolor="#FF0000" scope="col"><span class="Estilo4">Nombre de la Cooperativa </span></th>
    <th width="222" bgcolor="#FF0000" scope="col"><span class="Estilo4">Rif de la Cooperativa </span></th>
    <th width="191" bgcolor="#FF0000" scope="col"><span class="Estilo4">Cantidad de Miembros </span></th>
  </tr>
  <?php do { 
		  
		  mysql_select_db($database_conexion, $conexion);
		  $query_cooperativa = "SELECT * FROM cooperatva where rif=' $row_miembros[cooperativa]'";
		  $cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
		  $row_cooperativa = mysql_fetch_assoc($cooperativa);
		  $totalRows_cooperativa = mysql_num_rows($cooperativa);
		  
		  if($row_cooperativa['rif']==$row_miembros['cooperativa']){
		  
		  ?>
  <tr>
    <td bgcolor="#FFFFFF"><span class="Estilo4"><?php echo $row_cooperativa['nombre']; ?></span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo4"><?php echo $row_cooperativa['rif']; ?> </span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo4"><?php echo $row_miembros['miembros']; ?></span></td>
  </tr>
  <?php 
			} //fin del if
			} while ($row_miembros = mysql_fetch_assoc($miembros)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, 0, $queryString_miembros); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, max(0, $pageNum_miembros - 1), $queryString_miembros); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, min($totalPages_miembros, $pageNum_miembros + 1), $queryString_miembros); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, $totalPages_miembros, $queryString_miembros); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cooperativa);

mysql_free_result($miembros);
?>
