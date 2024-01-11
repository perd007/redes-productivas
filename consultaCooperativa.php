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

$maxRows_cooperativa = 15;
$pageNum_cooperativa = 0;
if (isset($_GET['pageNum_cooperativa'])) {
  $pageNum_cooperativa = $_GET['pageNum_cooperativa'];
}
$startRow_cooperativa = $pageNum_cooperativa * $maxRows_cooperativa;

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva";
$query_limit_cooperativa = sprintf("%s LIMIT %d, %d", $query_cooperativa, $startRow_cooperativa, $maxRows_cooperativa);
$cooperativa = mysql_query($query_limit_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);

if (isset($_GET['totalRows_cooperativa'])) {
  $totalRows_cooperativa = $_GET['totalRows_cooperativa'];
} else {
  $all_cooperativa = mysql_query($query_cooperativa);
  $totalRows_cooperativa = mysql_num_rows($all_cooperativa);
}
$totalPages_cooperativa = ceil($totalRows_cooperativa/$maxRows_cooperativa)-1;

$queryString_cooperativa = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_cooperativa") == false && 
        stristr($param, "totalRows_cooperativa") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_cooperativa = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_cooperativa = sprintf("&totalRows_cooperativa=%d%s", $totalRows_cooperativa, $queryString_cooperativa);

//verificar si existen redes Registradas
if($totalRows_cooperativa==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cooperativas Registradas'); location.href='sistemenus.php' </script>";
exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta Cooperativas'</title>
<style type="text/css">
<!--
.border2 {border-bottom-width: thin;
	border-bottom-style: solid;
	border-bottom-color: #FF0000;
}
.border3 {	border-right-width: thin;
	border-right-style: solid;
	border-right-color: #FF0000;
	border-left-style: none;
}
.borderg {	border-top-width: thin;
	border-right-width: thin;
	border-bottom-width: thin;
	border-left-width: thin;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-top-color: #FF0000;
	border-right-color: #FF0000;
	border-bottom-color: #FF0000;
	border-left-color: #FF0000;
}
.navenlace {	font-weight:bold;
	padding:1px;
	margin-top: 3;
	margin-right: 0;
	margin-bottom: 3;
	margin-left: 10px;
}
.Estilo6 {font-size: 18px}
.Estilo7 {
	font-size: 24px;
	font-weight: bold;
}
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
<p align="center"><span class="Estilo5 Estilo2 Estilo7">Consulta de Cooperativas </span></p>
<table width="830" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="228" scope="col"><span class="Estilo6">Nombre </span></th>
    <th width="315" scope="col"><span class="Estilo6">Rif</span></th>
    <th width="94" scope="col"><span class="Estilo6">Opcion</span></th>
    <th width="91" scope="col"><span class="Estilo6">Opcion</span></th>
    <th width="92" scope="col"><span class="Estilo6">Opcion</span></th>
  </tr>
  <?php do { ?>
  <?php

			$modulo=$cont%2;
			
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			}
			
	
	  ?>
  <tr bgcolor="<?php echo $color; ?>">
    <td><div align="center" class="Estilo6"><?php echo $row_cooperativa['nombre']; ?></div></td>
    <td><div align="center" class="Estilo6"><?php echo $row_cooperativa['rif']; ?></div></td>
    <td><div align="center" class="Estilo6"><? echo "<a href='sistemenus.php?rif=$row_cooperativa[rif]&valor=mc&link=link3'>Modificar</a>" ?></div></td>
    <td><div align="center" class="Estilo6"><? echo "<a onClick='return validar()' href='sistemenus.php?rif=$row_cooperativa[rif]&valor=ec&link=link3'>Eliminar</a>" ?></div></td>
    <td><div align="center" class="Estilo6"><? echo "<a href='sistemenus.php?rif=$row_cooperativa[rif]&valor=dc&link=link3'>Detalles</a>" ?></div></td>
  </tr>
  <?php 
		$cont++;
		} while ($row_cooperativa = mysql_fetch_assoc($cooperativa)); ?>
  <table border="0"  width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_cooperativa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_cooperativa=%d%s", $currentPage, 0, $queryString_cooperativa); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_cooperativa > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_cooperativa=%d%s", $currentPage, max(0, $pageNum_cooperativa - 1), $queryString_cooperativa); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_cooperativa < $totalPages_cooperativa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_cooperativa=%d%s", $currentPage, min($totalPages_cooperativa, $pageNum_cooperativa + 1), $queryString_cooperativa); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_cooperativa < $totalPages_cooperativa) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_cooperativa=%d%s", $currentPage, $totalPages_cooperativa, $queryString_cooperativa); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cooperativa);
?>
