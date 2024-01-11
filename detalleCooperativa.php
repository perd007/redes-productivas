<?php require_once('Connections/conexion.php'); ?>
<?php
$rif=$_GET['rif'];
mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva where rif='$rif'";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

mysql_select_db($database_conexion, $conexion);
$query_red = "SELECT * FROM redes where id='$row_cooperativa[red]'";
$red = mysql_query($query_red, $conexion) or die(mysql_error());
$row_red = mysql_fetch_assoc($red);
$totalRows_red = mysql_num_rows($red);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--

.Estilo6 {font-size: 18px}
.Estilo3 {font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo3">Detalles de Cooperativas </span></p>
<table align="center" cellspacing="0">
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo6"><strong>Datos de la Cooperativa </strong></div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF" class="Estilo6"><div align="left"><strong>Red a la que Pertenece: </strong></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo6"><?php echo $row_red['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo6"><strong>Nombre de la Cooperativa : </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo6">
      <label><?php echo $row_cooperativa['nombre']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td width="233" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo6"><strong>Rif de la Cooperativa :</strong></span></div></td>
    <td width="286" bgcolor="#FFFFFF"><span class="Estilo6"><?php echo $row_cooperativa['rif']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo6"><strong>Municipio de la Cooperativa :</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo6"><?php echo $row_cooperativa['muncipip']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo6"><strong>Coordenadas de la Cooperativa :</strong></div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo6"><strong>Norte:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo6"><?php echo $row_cooperativa['norte']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo6"><strong>Sur:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo6"><?php echo $row_cooperativa['sur']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td height="26" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo6">
      <form method="get" action="sistemenus.php">
        <input name="submit" type="submit" class="Estilo6" value="Regresar" />
		  <input type="hidden" name="valor" value="c2" />
 	 <input type="hidden" name="link" value="link3" />
      </form>
    </div></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($cooperativa);

mysql_free_result($red);
?>
