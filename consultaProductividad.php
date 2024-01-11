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

$productores=$_GET["productores"];
$cooperativas=$_GET["cooperativa"];
$red=$_GET["red"];

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula='$productores'";
$productores2 = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores2 = mysql_fetch_assoc($productores2);
$totalRows_productores = mysql_num_rows($productores2);

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where rif='$cooperativas'";
$cooperativas2 = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas2 = mysql_fetch_assoc($cooperativas2);
$totalRows_cooperativas = mysql_num_rows($cooperativas2);


if($productores!="null"){

$tipo="Productor";
$nombre=$row_productores2["nombre"]." ".$row_productores2["apellido"];
$ruta="mP";

mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where id_productor=$row_productores2[cedula]";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos1 = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

$maxRows_produccion = 1;
$pageNum_produccion = 0;
if (isset($_GET['pageNum_produccion'])) {
  $pageNum_produccion = $_GET['pageNum_produccion'];
}
$startRow_produccion = $pageNum_produccion * $maxRows_produccion;

mysql_select_db($database_conexion, $conexion);
$query_produccion = "SELECT * FROM produccion where producto=$row_productos1[id]";
$query_limit_produccion = sprintf("%s LIMIT %d, %d", $query_produccion, $startRow_produccion, $maxRows_produccion);
$produccion = mysql_query($query_limit_produccion, $conexion) or die(mysql_error());
$row_produccion = mysql_fetch_assoc($produccion);




if (isset($_GET['totalRows_produccion'])) {
  $totalRows_produccion = $_GET['totalRows_produccion'];
} else {
  $all_produccion = mysql_query($query_produccion);
  $totalRows_produccion = mysql_num_rows($all_produccion);
}
$totalPages_produccion = ceil($totalRows_produccion/$maxRows_produccion)-1;


}else{
if($cooperativas!="null"){
$tipo="Cooperativa";
$nombre=$row_cooperativas2["nombre"];
$ruta="mPC";



mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where rif='$row_cooperativas2[rif]'";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos2 = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

mysql_select_db($database_conexion, $conexion);
$query_produccion = "SELECT * FROM produccion where producto='$row_productos2[id]'";
$produccion = mysql_query($query_produccion, $conexion) or die(mysql_error());
$row_produccion = mysql_fetch_assoc($produccion);
$totalRows_produccion = mysql_num_rows($produccion);


$queryString_produccion = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_produccion") == false && 
        stristr($param, "totalRows_produccion") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_produccion = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_produccion = sprintf("&totalRows_produccion=%d%s", $totalRows_produccion, $queryString_produccion);
}
}


mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id=$red";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

if($totalRows_productos==0){
echo "<script type=\"text/javascript\">alert ('No existen ProdUctos Registrados para Este Productor o Cooperativa'); location.href='sistemenus.php' </script>";
exit;
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 18px;
text-align:center}
.Estilo3 {
	font-size: 24px;
	font-weight: bold;
}


-->
</style>
</head>

<body>
<p align="center"><span class="Estilo5 Estilo3">Consulta de Productividad </span></p>
<table width="744" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th colspan="7" scope="col"><table width="939" border="0">
      <tr>
        <th width="438" class="Estilo2" scope="col"><div align="left">Red: <? echo $row_redes["nombre"]; ?></div></th>
        <th width="491" class="Estilo2" scope="col"><div align="left"><? echo $tipo.": ".$nombre; ?></div></th>
      </tr>
    </table></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th colspan="7" bgcolor="#FFFFFF" scope="col"><span class="Estilo2">Cantidades (Unidad): <?php echo $row_productos['medida']; ?></span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th width="66" scope="col"><div align="center"><span class="Estilo2">Producto</span></div></th>
    <th width="66" scope="col"><div align="center"><span class="Estilo2">Elaborada</span></div></th>
    <th width="72" scope="col"><div align="center"><span class="Estilo2">Disponible</span></div></th>
    <th width="89" scope="col"><div align="center"><span class="Estilo2">Procesada</span></div></th>
    <th width="89" scope="col"><div align="center"><span class="Estilo2">Fecha</span></div></th>
    <th width="58" scope="col"><div align="center"><span class="Estilo2">Opcion</span></div></th>
    <th width="62" scope="col"><div align="center"><span class="Estilo2">Opcion</span></div></th>
  </tr>
  <?php do {
			 $modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			  
	?>
  <tr bgcolor="<?php echo $color; ?>">
    <td><div align="center"><span class="Estilo2"><?php echo $row_productos1['nombre']; ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><?php echo $row_produccion['elaborada']; ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><?php echo $row_produccion['disponible']; ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><?php echo $row_produccion['procesada']; ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><?php echo $row_produccion['fecha']; ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><? echo "<a href='sistemenus.php?id=$row_produccion[id]&valor=mpcA&link=link4&red=$red&productores=$productores&cooperativa=$cooperativa'>Modificar</a>" ?></span></div></td>
    <td><div align="center"><span class="Estilo2"><? echo "<a onClick='return validar()' href='sistemenus.php?id=$row_produccion[id]&valor=ep&link=link4&red=$red&productores=$productores&cooperativa=$cooperativa'>Eliminar</a>" ?></span></div></td>
  </tr>
  <?php 
				$cont++;
				} while ($row_produccion = mysql_fetch_assoc($produccion)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_produccion > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_produccion=%d%s", $currentPage, 0, $queryString_produccion); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_produccion > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_produccion=%d%s", $currentPage, max(0, $pageNum_produccion - 1), $queryString_produccion); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_produccion < $totalPages_produccion) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_produccion=%d%s", $currentPage, min($totalPages_produccion, $pageNum_produccion + 1), $queryString_produccion); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_produccion < $totalPages_produccion) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_produccion=%d%s", $currentPage, $totalPages_produccion, $queryString_produccion); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($produccion);

mysql_free_result($redes);

mysql_free_result($productos);
?>
