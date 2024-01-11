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

$maxRows_productos = 15;
$pageNum_productos = 0;
if (isset($_GET['pageNum_productos'])) {
  $pageNum_productos = $_GET['pageNum_productos'];
}
$startRow_productos = $pageNum_productos * $maxRows_productos;

mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos";
$query_limit_productos = sprintf("%s LIMIT %d, %d", $query_productos, $startRow_productos, $maxRows_productos);
$productos = mysql_query($query_limit_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);

if (isset($_GET['totalRows_productos'])) {
  $totalRows_productos = $_GET['totalRows_productos'];
} else {
  $all_productos = mysql_query($query_productos);
  $totalRows_productos = mysql_num_rows($all_productos);
}
$totalPages_productos = ceil($totalRows_productos/$maxRows_productos)-1;

mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT nombre FROM redes where id='$row_productos[red]'";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

$queryString_productos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_productos") == false && 
        stristr($param, "totalRows_productos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_productos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_productos = sprintf("&totalRows_productos=%d%s", $totalRows_productos, $queryString_productos);


//verificar si existen productos Registrados
if($totalRows_productos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Productos Registrados'); location.href='sistemenus.php' </script>";
exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta de Productos</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo2 {font-size: 24px}

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
<p align="center"><span class="Estilo5 Estilo2"><strong>Consulta Productos </strong></span></p>
<table width="727" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="149" scope="col"><span class="Estilo1">Nombre</span></th>
    <th width="146" scope="col"><span class="Estilo1">Medida</span></th>
    <th width="220" scope="col"><span class="Estilo1">Distribucion</span></th>
    <th width="73" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="63" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="64" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  <?php do {
			 $modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			
			if($row_productos["rif"]==0)
			$valor2="mp";
			else
			if($row_productos["id_productor"]==0)
			$valor2="mpc";
	

			  
	?>
  <tr bgcolor="<?php echo $color; ?>">
    <td><div align="center"><span class="Estilo1"><?php echo $row_productos['nombre']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_productos['medida']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_productos['distribucion']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo "<a href='sistemenus.php?id=$row_productos[id]&valor=dp&link=link4'>Detalle</a>"; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><? echo "<a href='sistemenus.php?id=$row_productos[id]&valor=$valor2&link=link4'>Modificar</a>";?></span></div></td>
    <td><div align="center"><span class="Estilo1"><? echo "<a onClick='return validar()' href='sistemenus.php?id=$row_productos[id]&valor=ep&link=link4'>Eliminar</a>"; ?></span></div></td>
  </tr>
  <?php 
				$cont++;
				} while ($row_productos = mysql_fetch_assoc($productos)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_productos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, 0, $queryString_productos); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_productos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, max(0, $pageNum_productos - 1), $queryString_productos); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productos < $totalPages_productos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, min($totalPages_productos, $pageNum_productos + 1), $queryString_productos); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_productos < $totalPages_productos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_productos=%d%s", $currentPage, $totalPages_productos, $queryString_productos); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php

?>
