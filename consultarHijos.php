<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='sistemenu.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenu.php'  </script>";
 exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_hijos = 10;
$pageNum_hijos = 0;
if (isset($_GET['pageNum_hijos'])) {
  $pageNum_hijos = $_GET['pageNum_hijos'];
}
$startRow_hijos = $pageNum_hijos * $maxRows_hijos;

mysql_select_db($database_conexion, $conexion);
$query_hijos = "SELECT * FROM hijos";
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

//verificar si existen Hijos Registrados
if($totalRows_hijos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Hijos Registrados'); location.href='registroHijos.php' </script>";
exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta de Hijos de los Productores</title>
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
<p align="center"><span class="Estilo3">Consulta de Hijos </span></p>
<table width="904" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="229" scope="col"><span class="Estilo1">Nombre</span></th>
    <th width="330" scope="col"><span class="Estilo1">Productor</span></th>
    <th width="65" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="66" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="73" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  <?php do { 
			$modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			
			mysql_select_db($database_conexion, $conexion);
			$query_productores = "SELECT * FROM productores where cedula='$row_hijos[productor]'";
			$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
			$row_productores = mysql_fetch_assoc($productores);
			$totalRows_productores = mysql_num_rows($productores);

			?>
  <tr bgcolor="<?php echo $color; ?>" >
    <td height="42"><div align="left" class="Estilo1"><?php echo $row_hijos['nombre']; ?> <?php echo $row_hijos['apellido']; ?> </div></td>
    <td><span class="Estilo1"><?php echo $row_productores['nombre']; ?> <?php echo $row_productores['apellido']; ?></span></td>
    <td><div align="center" class="Estilo1"><? echo "<a href='sistemenus.php?id=$row_hijos[id]&valor=mh&link=link2'>Modificar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a onClick='return validar()' href='sistemenus.php?id=$row_hijos[id]&valor=eh&link=link2'>Eliminar</a>" ?></div></td>
    <td><div align="center" class="Estilo1"><? echo "<a href='sistemenus.php?id=$row_hijos[id]&valor=dh&link=link2'>Detalles</a>" ?></div></td>
  </tr>
  <?php $cont++;} while ($row_hijos = mysql_fetch_assoc($hijos)); ?>
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
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($hijos);

mysql_free_result($productores);
?>
