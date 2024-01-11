<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

//capturar el municipio
$municipio=$_GET["municipio"];

$maxRows_cooperativas = 7;
$pageNum_cooperativas = 0;
if (isset($_GET['pageNum_cooperativas'])) {
  $pageNum_cooperativas = $_GET['pageNum_cooperativas'];
}
$startRow_cooperativas = $pageNum_cooperativas * $maxRows_cooperativas;

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where muncipip='$municipio'";
$query_limit_cooperativas = sprintf("%s LIMIT %d, %d", $query_cooperativas, $startRow_cooperativas, $maxRows_cooperativas);
$cooperativas = mysql_query($query_limit_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);

if (isset($_GET['totalRows_cooperativas'])) {
  $totalRows_cooperativas = $_GET['totalRows_cooperativas'];
} else {
  $all_cooperativas = mysql_query($query_cooperativas);
  $totalRows_cooperativas = mysql_num_rows($all_cooperativas);
}
$totalPages_cooperativas = ceil($totalRows_cooperativas/$maxRows_cooperativas)-1;

$queryString_cooperativas = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_cooperativas") == false && 
        stristr($param, "totalRows_cooperativas") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_cooperativas = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_cooperativas = sprintf("&totalRows_cooperativas=%d%s", $totalRows_cooperativas, $queryString_cooperativas);

if($totalRows_cooperativas==0){
echo "<script type=\"text/javascript\">alert ('No existen Cooperativas que Pertenezcan a este Municipio'); location.href='sistemenus.php' </script>";
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
<p align="center"><span class="Estilo3">Listados de Cooperativas por Municipio</span></p>
<table width="679" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th colspan="4" bgcolor="#FFFFFF" scope="col"><span class="Estilo1">Cooperativas del Municipio: <? echo $municipio; ?> </span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th width="138" scope="col"><span class="Estilo1">Rif</span></th>
    <th width="210" scope="col"><span class="Estilo1">Nombre</span></th>
    <th colspan="2" scope="col"><span class="Estilo1">Coordenadas</span></th>
  </tr>
  <?php do { ?>
    <tr bgcolor="#FF0000">
      <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_cooperativas['rif']; ?></span></th>
      <th bgcolor="#FFFFFF" scope="col"><span class="Estilo1"><?php echo $row_cooperativas['nombre']; ?></span></th>
      <th width="158" bgcolor="#FFFFFF" scope="col"><div align="center" class="Estilo1">Norte: <?php echo $row_cooperativas['norte']; ?></div></th>
      <th width="173" bgcolor="#FFFFFF" scope="col"><div align="left" class="Estilo1"> Sur:<?php echo $row_cooperativas['sur']; ?></div></th>
    </tr>
	 <?php } while ($row_cooperativas = mysql_fetch_assoc($cooperativas)); ?>
    <table border="0" width="50%" align="center">
      <tr>
        <td width="23%" align="center"><?php if ($pageNum_cooperativas > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_cooperativas=%d%s", $currentPage, 0, $queryString_cooperativas); ?>">Primero</a>
              <?php } // Show if not first page ?>        </td>
        <td width="31%" align="center"><?php if ($pageNum_cooperativas > 0) { // Show if not first page ?>
              <a href="<?php printf("%s?pageNum_cooperativas=%d%s", $currentPage, max(0, $pageNum_cooperativas - 1), $queryString_cooperativas); ?>">Anterior</a>
              <?php } // Show if not first page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_cooperativas < $totalPages_cooperativas) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_cooperativas=%d%s", $currentPage, min($totalPages_cooperativas, $pageNum_cooperativas + 1), $queryString_cooperativas); ?>">Siguiente</a>
              <?php } // Show if not last page ?>        </td>
        <td width="23%" align="center"><?php if ($pageNum_cooperativas < $totalPages_cooperativas) { // Show if not last page ?>
              <a href="<?php printf("%s?pageNum_cooperativas=%d%s", $currentPage, $totalPages_cooperativas, $queryString_cooperativas); ?>">&Uacute;ltimo</a>
              <?php } // Show if not last page ?>        </td>
      </tr>
    </table>
</table>
</body>
</html>
<?php
mysql_free_result($cooperativas);
?>
