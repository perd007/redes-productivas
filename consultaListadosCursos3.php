<?php require_once('Connections/conexion.php'); ?>
<?php


$productores=$_GET["productores"];
$cooperativas=$_GET["cooperativa"];

if($productores!=""){
$sql="where productor=".$productores;
}else{
if($cooperativas!="")
$sql="where cooperativa=".$cooperativas;
}


$currentPage = $_SERVER["PHP_SELF"];


$maxRows_regicur = 10;
$pageNum_regicur = 0;
if (isset($_GET['pageNum_regicur'])) {
  $pageNum_regicur = $_GET['pageNum_regicur'];
}
$startRow_regicur = $pageNum_regicur * $maxRows_regicur;

mysql_select_db($database_conexion, $conexion);
$query_regicur = "SELECT * FROM regicur $sql ";
$query_limit_regicur = sprintf("%s LIMIT %d, %d", $query_regicur, $startRow_regicur, $maxRows_regicur);
$regicur = mysql_query($query_limit_regicur, $conexion) or die(mysql_error());
$row_regicur = mysql_fetch_assoc($regicur);

if (isset($_GET['totalRows_regicur'])) {
  $totalRows_regicur = $_GET['totalRows_regicur'];
} else {
  $all_regicur = mysql_query($query_regicur);
  $totalRows_regicur = mysql_num_rows($all_regicur);
}
$totalPages_regicur = ceil($totalRows_regicur/$maxRows_regicur)-1;

$queryString_regicur = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_regicur") == false && 
        stristr($param, "totalRows_regicur") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_regicur = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_regicur = sprintf("&totalRows_regicur=%d%s", $totalRows_regicur, $queryString_regicur);

if($totalRows_regicur==0){
	echo "<script type=\"text/javascript\">alert ('Este Productor o Cooperativa no ha Realizado Ningun Curso'); location.href='sistemenus.php' </script>";
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
.Estilo2 {	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo2"> Listados de Cursos </span></p>
<table width="829" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th scope="col"><span class="Estilo1">Nombre</span></th>
    <th scope="col"><span class="Estilo1">Facilitador</span></th>
    <th scope="col"><span class="Estilo1">Estado</span></th>
    <th scope="col"><span class="Estilo1">Fecha</span></th>
    <th scope="col"><span class="Estilo1">Tipo</span></th>
    <th scope="col"><span class="Estilo1">Horas</span></th>
  </tr>
  <?php do { 
  
  	mysql_select_db($database_conexion, $conexion);
	$query_cursos = "SELECT * FROM cursos where id_curso='$row_regicur[curso]'";
	$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
	$row_cursos = mysql_fetch_assoc($cursos);
	$totalRows_cursos = mysql_num_rows($cursos);
  
  ?>
    <tr>
      <td><span class="Estilo1"><?php echo $row_cursos['nombre']; ?></span></td>
      <td><div align="center"><span class="Estilo1"><?php echo $row_cursos['facilitador']; ?></span></div></td>
      <td><div align="center"><span class="Estilo1"><?php echo $row_cursos['estado']; ?></span></div></td>
      <td><div align="center"><span class="Estilo1"><?php echo $row_cursos['fecha']; ?></span></div></td>
      <td><div align="center"><span class="Estilo1"><?php echo $row_cursos['tipo']; ?></span></div></td>
      <td><div align="center"><span class="Estilo1"><?php echo $row_cursos['horas']; ?></span></div></td>
    </tr>
    <?php } while ($row_regicur = mysql_fetch_assoc($regicur)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_regicur > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_regicur=%d%s", $currentPage, 0, $queryString_regicur); ?>">Primero</a>
            <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_regicur > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_regicur=%d%s", $currentPage, max(0, $pageNum_regicur - 1), $queryString_regicur); ?>">Anterior</a>
            <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_regicur < $totalPages_regicur) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_regicur=%d%s", $currentPage, min($totalPages_regicur, $pageNum_regicur + 1), $queryString_regicur); ?>">Siguiente</a>
            <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_regicur < $totalPages_regicur) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_regicur=%d%s", $currentPage, $totalPages_regicur, $queryString_regicur); ?>">&Uacute;ltimo</a>
            <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($cursos);

mysql_free_result($regicur);
?>
