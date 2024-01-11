<?php require_once('Connections/conexion.php'); ?>
<?php

$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where id=$id";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

//verificar si elpriducto pertenece a una cooperativa o a un productor
if($row_productos["id_productor"]!="null"){

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula='$row_productos[id_productor]'";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

$nombre=$row_productores["nombre"]." ".$row_productores["apellido"];
$tipo="Productor Independiente";

}//fin del if
else{

if($row_productos["rif"]!="null"){

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where rif='$row_productos[rif]'";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

$nombre=$row_cooperativas["nombre"];
$tipo="Cooperativa";

}//fin del segundo if

}//fin del else
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 18px}
.Estilo3 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Detalles de Productos </span></p>
<table border="0" align="center" cellspacing="0" >
  <tr valign="baseline">
    <td width="295" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo1 Estilo2"><strong><?php echo $tipo; ?></strong></div></td>
    <td width="231" bgcolor="#FF0000"><span class="Estilo1 Estilo2"><strong>
      <label><?php echo $nombre; ?></label>
    </strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" ><div align="left" class="Estilo1 Estilo2"><strong>Distribucion o Comercializacion:</strong></div></td>
    <td  ><span class="Estilo2"><strong><?php echo $row_productos['distribucion']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"> <div align="left" class=" Estilo2"><strong>Nombre del Producto:</strong></div></td>
    <td bgcolor="#FF0000" ><span class=" Estilo2"><strong><?php echo $row_productos['nombre']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class=" Estilo2"><strong>Unidad Productiva:</strong></div></td>
    <td bgcolor="#FFFFFF" ><span class=" Estilo2"><strong><?php echo $row_productos['medida']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td height="26" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class=" Estilo2"><strong>Periodo de Cosecha:</strong></div></td>
    <td bgcolor="#FF0000" ><span class=" Estilo2"><strong><?php echo $row_productos['tiempo']." ".$row_productos['tiempo2']; ?></strong></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FFFFFF">
    <td align="right" nowrap="nowrap"  ><div align="left" class="1 Estilo2"><strong>Cantidad Estimada el Producto:</strong></div></td>
    <td ><span class=" Estilo2"><strong><?php echo $row_productos['cantidad']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000" ><div align="left" class="Estilo1 Estilo2"><strong>Costo de la Unidad:</strong></div></td>
    <td bgcolor="#FF0000" ><span class=" Estilo2"><strong><?php echo $row_productos['costo']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF" ><div align="left" class="Estilo1 Estilo2"><strong>&Aacute;rea de cultivo o de pesca /  Tama&ntilde;o del reba&ntilde;o: </strong></div></td>
    <td bgcolor="#FFFFFF" ><span class=" Estilo2"><strong><?php echo $row_productos['area']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo1 Estilo2"><strong>Capacidad Instalada: </strong></div></td>
    <td bgcolor="#FF0000" ><span class=" Estilo2"><strong><?php echo $row_productos['instalada']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" > <div align="left" class="Estilo2"><strong>Capacidad de Procesamiento: </strong></div></td>
    <td  ><span class=" Estilo2"><strong><?php echo $row_productos['procesamiento']; ?></strong></span></td>
  </tr>
  <tr valign="baseline">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class=" Estilo2"><strong>Capacidad de Producci&oacute;n: </strong></div></td>
    <td bgcolor="#FF0000"><span class="Estilo1 Estilo2"><strong><?php echo $row_productos['produccion']; ?></strong></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FFFFFF">
    <td colspan="2" align="right" nowrap="nowrap" ><div align="center" class="Estilo1">
      <form action="sistemenus.php">
        <input name="submit" type="submit" class="Estilo2" value="Regresar" />
			  <input type="hidden" name="valor" value="pr3" />
 	 <input type="hidden" name="link" value="link4" />
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($productos);

?>
