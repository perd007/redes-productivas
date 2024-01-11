<?php require_once('Connections/conexion.php'); ?>
<?php
$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id=$id";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle de la Red</title>

<style type="text/css">
<!--
.Estilo2 {font-size: 18px; }
.Estilo3 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Detalles de Redes  </span></p>
<table border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo2">Detalles de la Red </div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td width="243" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Nombre del Representante:</strong></div></td>
    <td width="424" bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['nombre_rep']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Apellidos del Representante:</div></td>
    <td bgcolor="#FF0000"><span class="Estilo5 Estilo2"><?php echo $row_redes['apellido_rep']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Cedula del Representante:</strong></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['cedula_rep']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Telefono del Representante:</div></td>
    <td bgcolor="#FF0000"><span class="Estilo5 Estilo2"><?php echo $row_redes['telefono']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Direccion del Representante</strong>:</div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['direccion']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Localidad o Centro Poblado:</div>
        <span class="Estilo5 Estilo2">
        <label></label>
      </span></td>
    <td bgcolor="#FF0000"><span class="Estilo5 Estilo2"><?php echo $row_redes['localidad']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Correo:</strong></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['correo']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Coordenadas de la Red:</div></td>
    <td bgcolor="#FF0000"><span class="Estilo5 Estilo2"><?php echo $row_redes['coordenadas']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Nombre de la Red:</strong></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FFFFFF" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Rif de la Red:</div></td>
    <td bgcolor="#FF0000"><span class="Estilo5 Estilo2"><?php echo $row_redes['rif']; ?></span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>Actividad que realiza:</strong></div></td>
    <td bordercolor="#FF0000" bgcolor="#FFFFFF"><span class="Estilo2"><?php echo $row_redes['actividad']; ?></span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Objetivo de la Red: </div></td>
    <td bordercolor="#FF0000" bgcolor="#FF0000"><span class="Estilo5 Estilo2">
      <label><?php echo $row_redes['objetivo']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left" class="Estilo2"><strong>A&ntilde;o de Conformacion: </strong></div></td>
    <td bordercolor="#FF0000" bgcolor="#FFFFFF"><span class="Estilo2">
      <label><?php echo $row_redes['ano']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FF0000"><div align="left" class="Estilo6 Estilo2">Monto del Proyecto: </div></td>
    <td bordercolor="#FF0000" bgcolor="#FF0000"><span class="Estilo5 Estilo2">
      <label><?php echo $row_redes['monto']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"> <form action="sistemenus.php" class="Estilo2">
        <div align="center">
          <input name="submit" type="submit" class="Estilo2" value="Regresar" />
          <input type="hidden" name="valor" value="r2" />
          <input type="hidden" name="link" value="link1" />
        </div>
    </form></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($redes);
?>
