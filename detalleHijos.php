<?php require_once('Connections/conexion.php'); ?>
<?php
$id=$_GET['id'];
mysql_select_db($database_conexion, $conexion);
$query_hijos = "SELECT * FROM hijos where id=$id";
$hijos = mysql_query($query_hijos, $conexion) or die(mysql_error());
$row_hijos = mysql_fetch_assoc($hijos);
$totalRows_hijos = mysql_num_rows($hijos);

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula='$row_hijos[productor]'";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle del Hijo</title>
<style type="text/css">
<!--
.Estilo2 {font-size: 18px; font-weight: bold; }
.Estilo3 {font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Detalles de Hijos </span></p>
<table align="center" cellspacing="0">
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo2">Datos del Hijo </div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Productor: </span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_productores['nombre']; ?> <?php echo $row_productores['apellido']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td width="241" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Cedula:</span></td>
    <td width="306" bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['cedula']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Nombre :</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Apellido :</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['apellido']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Nivel de Estudio del Productor:</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['estudio']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">&iquest;Viven Juntos? :</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['viveJ']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">&iquest;Trabaja?:</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['trabaja']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><span class="Estilo2">Edad:</span></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_hijos['edad']; ?> A&ntilde;os </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td height="33" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
      <form action="sistemenus.php">
        <input name="submit" type="submit" class="Estilo2" value="Regresar" />
			  <input type="hidden" name="valor" value="p2" />
 	 <input type="hidden" name="link" value="link2" />
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($hijos);

mysql_free_result($productores);
?>
