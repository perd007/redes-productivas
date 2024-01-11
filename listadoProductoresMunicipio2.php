<?php require_once('Connections/conexion.php'); ?>
<?php
//capturar el municipio
$municipio=$_GET["municipio"];

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_productores = 7;
$pageNum_productores = 0;
if (isset($_GET['pageNum_productores'])) {
  $pageNum_productores = $_GET['pageNum_productores'];
}
$startRow_productores = $pageNum_productores * $maxRows_productores;

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where municipio='$municipio'";
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


if($totalRows_productores==0){
echo "<script type=\"text/javascript\">alert ('No existen Productores que Pertenezcan a este Municipio'); location.href='sistemenus.php' </script>";
 exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
<p align="center"><span class="Estilo3">Listados de Productores por Municipio </span></p>
<table width="1148" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th colspan="8" bgcolor="#FFFFFF" scope="col"><span class="Estilo1">Productores del Municipio: <? echo $municipio; ?> </span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th scope="col"><span class="Estilo1">Cedula</span></th>
    <th scope="col"><span class="Estilo1">Nombre</span></th>
    <th scope="col"><span class="Estilo1">Apellido</span></th>
    <th scope="col"><span class="Estilo1">Direccion</span></th>
    <th scope="col"><span class="Estilo1">Localidad</span></th>
    <th scope="col"><span class="Estilo1">Parroquia</span></th>
    <th colspan="2" scope="col"><span class="Estilo1">Coordenadas</span></th>
  </tr>
  <?php do { ?>
    <tr>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['cedula']; ?></div></td>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['nombre']; ?></div></td>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['apellido']; ?></div></td>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['direccion']; ?></div></td>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['localidad']; ?></div></td>
      <td><div align="center" class="Estilo1"><?php echo $row_productores['parroquia']; ?></div></td>
      <td><div align="center" class="Estilo1"><strong>Norte:</strong><?php echo $row_productores['norte']; ?></div></td>
      <td><div align="center" class="Estilo1"><strong>Sur:</strong><?php echo $row_productores['sur']; ?></div></td>
    </tr>
    <?php } while ($row_productores = mysql_fetch_assoc($productores)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, 0, $queryString_productores); ?>">Primero</a>
            <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, max(0, $pageNum_productores - 1), $queryString_productores); ?>">Anterior</a>
            <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, min($totalPages_productores, $pageNum_productores + 1), $queryString_productores); ?>">Siguiente</a>
            <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, $totalPages_productores, $queryString_productores); ?>">&Uacute;ltimo</a>
            <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($productores);
?>
