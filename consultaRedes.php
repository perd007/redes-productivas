<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario

if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_redes = 30;
$pageNum_redes = 0;
if (isset($_GET['pageNum_redes'])) {
  $pageNum_redes = $_GET['pageNum_redes'];
}
$startRow_redes = $pageNum_redes * $maxRows_redes;

mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes";
$query_limit_redes = sprintf("%s LIMIT %d, %d", $query_redes, $startRow_redes, $maxRows_redes);
$redes = mysql_query($query_limit_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);

if (isset($_GET['totalRows_redes'])) {
  $totalRows_redes = $_GET['totalRows_redes'];
} else {
  $all_redes = mysql_query($query_redes);
  $totalRows_redes = mysql_num_rows($all_redes);
}
$totalPages_redes = ceil($totalRows_redes/$maxRows_redes)-1;

$queryString_redes = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_redes") == false && 
        stristr($param, "totalRows_redes") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_redes = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_redes = sprintf("&totalRows_redes=%d%s", $totalRows_redes, $queryString_redes);

//verificar si existen redes Registradas
if($totalRows_redes==0){
echo"<script type=\"text/javascript\">alert ('No Existen Redes Registradas'); location.href='ingresoRedes.php' </script>";
exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Redes Registradas </title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {font-size: 24px; font-weight: bold; }

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
<p align="center"><span class="Estilo3">Consulta de Redes </span></p>
<table width="904" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="205" scope="col"><span class="Estilo1">Nombre</span></th>
    <th width="247" scope="col"><span class="Estilo1">Actividad</span></th>
    <th width="75" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="70" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="80" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  <?php do { 
			$modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			?>
  <tr bgcolor="<?php echo $color; ?>" >
    <td height="25"><div align="center" class="Estilo1"><?php echo $row_redes['nombre']; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo $row_redes['actividad']; ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a href='sistemenus.php?id=$row_redes[id]&valor=mr&link=link1'>Modificar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a onClick='return validar()' href='sistemenus.php?id=$row_redes[id]&valor=er&link=link1'>Eliminar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a  href='sistemenus.php?id=$row_redes[id]&valor=dr&link=link1'>detalles</a>" ?></div></td>
  </tr>
  <?php $cont++;} while ($row_redes = mysql_fetch_assoc($redes)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_redes > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_redes=%d%s", $currentPage, 0, $queryString_redes); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_redes > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_redes=%d%s", $currentPage, max(0, $pageNum_redes - 1), $queryString_redes); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_redes < $totalPages_redes) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_redes=%d%s", $currentPage, min($totalPages_redes, $pageNum_redes + 1), $queryString_redes); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_redes < $totalPages_redes) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_redes=%d%s", $currentPage, $totalPages_redes, $queryString_redes); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p></p>
</body>
</html>
<?php
mysql_free_result($redes);
?>
