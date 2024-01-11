<?php require_once('Connections/conexion.php'); ?>
<?php

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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_personal = 20;
$pageNum_personal = 0;
if (isset($_GET['pageNum_personal'])) {
  $pageNum_personal = $_GET['pageNum_personal'];
}
$startRow_personal = $pageNum_personal * $maxRows_personal;

mysql_select_db($database_conexion, $conexion);
$query_personal = "SELECT * FROM regicur2";
$query_limit_personal = sprintf("%s LIMIT %d, %d", $query_personal, $startRow_personal, $maxRows_personal);
$personal = mysql_query($query_limit_personal, $conexion) or die(mysql_error());
$row_p = mysql_fetch_assoc($personal);

if (isset($_GET['totalRows_personal'])) {
  $totalRows_personal = $_GET['totalRows_personal'];
} else {
  $all_personal = mysql_query($query_personal);
  $totalRows_personal = mysql_num_rows($all_personal);
}
$totalPages_personal = ceil($totalRows_personal/$maxRows_personal)-1;

$queryString_personal = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_personal") == false && 
        stristr($param, "totalRows_personal") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_personal = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_personal = sprintf("&totalRows_personal=%d%s", $totalRows_personal, $queryString_personal);

if( $totalRows_personal==0){
echo"<script type=\"text/javascript\">alert ('No Existe Personal Registrado'); location.href='sistemenus.php?valor=cr6&link=link5' </script>";
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
-->
</style>
</head>

<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar esta Persona?');
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
<table width="736" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="105" scope="col">Cedula</th>
    <th width="135" scope="col"><span class="Estilo1">Nombre </span></th>
    <th width="166" scope="col"><span class="Estilo1">Apellido</span></th>
    <th width="64" scope="col">Sexo</th>
    <th width="138" scope="col"><strong>Procedencia:</strong></th>
    <th width="57" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="57" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  
  <?php
 do { 
			$modulo=$cont%2;
			
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			}
			
		
	
	  ?>

    <tr bgcolor="<?php echo $color; ?>">
      <td><div align="center"><?php echo $row_p['cedula']; ?></div></td>
      <td><div align="center" class="Estilo1">
        <div align="center"><?php echo $row_p['nombre']; ?></div>
      </div></td>
      <td><div align="center" class="Estilo1">
        <div align="center"><?php echo $row_p['apellido']; ?></div>
      </div></td>
      <td><div align="center" class="Estilo1">
        <div align="center"><?php echo $row_p['sexo']; ?></div>
      </div></td>
      <td><div align="center"><?php echo $row_p['provenencia']; ?></div></td>
      <td><div align="center" class="Estilo1">
        <div align="center"><? echo "<a href='sistemenus.php?cedula=$row_p[cedula]&valor=cr8&link=link5'>Modificar</a>" ?></div>
      </div></td>
      <td><div align="center" class="Estilo1">
        <div align="center"><? echo "<a onClick='return validar()' href='sistemenus.php?cedula=$row_p[cedula]&valor=cr9&link=link5'>Eliminar</a>" ?></div>
      </div></td>
    </tr>
    <?php $cont++;} while ($row_p = mysql_fetch_assoc($personal)); ?>

  <table border="0" align="center">
    <tr>
      <td  align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, 0, $queryString_productores); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, max(0, $pageNum_productores - 1), $queryString_productores); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, min($totalPages_productores, $pageNum_productores + 1), $queryString_productores); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td  align="center"><?php if ($pageNum_productores < $totalPages_productores) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productores=%d%s", $currentPage, $totalPages_productores, $queryString_productores); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>

<table border="0" width="50%" align="center">
  <tr>
    <td width="23%" align="center"><?php if ($pageNum_personal > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_personal=%d%s", $currentPage, 0, $queryString_personal); ?>">Primero</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="31%" align="center"><?php if ($pageNum_personal > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_personal=%d%s", $currentPage, max(0, $pageNum_personal - 1), $queryString_personal); ?>">Anterior</a>
          <?php } // Show if not first page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_personal < $totalPages_personal) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_personal=%d%s", $currentPage, min($totalPages_personal, $pageNum_personal + 1), $queryString_personal); ?>">Siguiente</a>
          <?php } // Show if not last page ?>
    </td>
    <td width="23%" align="center"><?php if ($pageNum_personal < $totalPages_personal) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_personal=%d%s", $currentPage, $totalPages_personal, $queryString_personal); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>
    </td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($personal);
?>
