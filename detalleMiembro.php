<?php require_once('Connections/conexion.php'); ?>
<?php

$cedula=$_GET['cedula'];
mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT * FROM miembrosc where cedula='$cedula'";
$miembros = mysql_query($query_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);
$totalRows_miembros = mysql_num_rows($miembros);

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva where rif='$row_miembros[cooperativa]'";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle de Miembro de Cooperativa</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Detalles de Miembros </span></p>
<table align="center" cellspacing="0">
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo1">Datos del Productor </div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Cooperativa: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_cooperativa['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td width="135" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left"><span class="Estilo1"><strong>Cedula:</strong></span></div></td>
    <td width="264" ><span class="Estilo1"><?php echo $row_miembros['cedula']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Nombre:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_miembros['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left"><span class="Estilo1"><strong>Apellidor:</strong></span></div></td>
    <td ><span class="Estilo1"><?php echo $row_miembros['apellido']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Direccion:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_miembros['direccion']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left"><span class="Estilo1"><strong>Telefono:</strong></span></div></td>
    <td ><span class="Estilo1"><?php echo $row_miembros['telefono']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Correo:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_miembros['correo']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left"><span class="Estilo1"><strong>Cargo:</strong></span></div></td>
    <td ><span class="Estilo1"><?php echo $row_miembros['cargo']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Parroquia:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_miembros['parroquia']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td height="32" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
      <form action="sistemenus.php">
        <input name="submit" type="submit" class="Estilo1" value="Regresar" />
		  <input type="hidden" name="valor" value="c51" />
 	 <input type="hidden" name="link" value="link3" />
	   <input type="hidden" name="cooperativa" value="<? echo $row_miembros["cooperativa"]; ?>" />
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($miembros);

mysql_free_result($cooperativa);
?>
