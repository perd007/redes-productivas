<?php require_once('Connections/conexion.php'); ?>
<?php

$cedula=$_GET["cedula"];
$op=$_GET["otro"];

if($op){
$valor="p20";	
}else{
$valor="p2";	
}

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula=$cedula";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

//consulta de redes
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT  nombre FROM redes where id='$row_productores[id_red]'";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

mysql_select_db($database_conexion, $conexion);
$query_redes2 = "SELECT  nombre FROM redes where id='$row_productores[id_red2]'";
$redes2 = mysql_query($query_redes2, $conexion) or die(mysql_error());
$row_redes2 = mysql_fetch_assoc($redes2);
$totalRows_redes2 = mysql_num_rows($redes2);

mysql_select_db($database_conexion, $conexion);
$query_redes3 = "SELECT  nombre FROM redes where id='$row_productores[id_red3]'";
$redes3 = mysql_query($query_redes3, $conexion) or die(mysql_error());
$row_redes3 = mysql_fetch_assoc($redes3);
$totalRows_redes3 = mysql_num_rows($redes3);

mysql_select_db($database_conexion, $conexion);
$query_redes4 = "SELECT  nombre FROM redes where id='$row_productores[id_red4]'";
$redes4 = mysql_query($query_redes4, $conexion) or die(mysql_error());
$row_redes4 = mysql_fetch_assoc($redes4);
$totalRows_redes4 = mysql_num_rows($redes4);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Detalle del Productor</title>
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
<p align="center"><span class="Estilo3">Detalles de Productores</span></p>
<table align="center" cellspacing="0">
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo1">Datos del Productor </div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Red a la que Pertenece: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1">
      <label><?php echo $row_redes['nombre']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Red a la que Pertenece: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1">
      <label><?php echo $row_redes2['nombre']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Red a la que Pertenece: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1">
      <label><?php echo $row_redes3['nombre']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Red a la que Pertenece: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1">
      <label><?php echo $row_redes4['nombre']; ?></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td width="241" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Cedula del Productor:</strong></span></div></td>
    <td width="278" bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['cedula']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Nombre del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['nombre']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Apellido del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['apellido']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Direccion del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['direccion']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Telefono del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['telefono']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Correo del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['correo']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Municipio:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['municipio']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Parroquia:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['parroquia']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Coordenadas del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><strong>Norte </strong>
        <label><strong><?php echo $row_productores['norte']; ?> <br />
          Sur <?php echo $row_productores['sur']; ?></strong></label>
    </span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Nombre de la Empresa:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['empresa']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Nivel de Estudio del Productor:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['estudio']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Grupo Etnico:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['etnia']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Sexo:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['sexo']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Edad:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['edad']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
      <div align="left"><strong>Datos de la Familia </strong></div>
    </div></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Ingresos Mensuales de la Familia: </strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['ingreso']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left"><span class="Estilo1"><strong>Numero de Miembros de la Familia:</strong></span></div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['miembros']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Localidad donde viven:</strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['localidad']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Terreno don de estan Ubicados:</strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['terreno']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Tipo de Vivienda: </strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['vivienda']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Nombre del Esposo o Esposa: </strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['esposa']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Edad del Esposo o Esaposa:</strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['edadEsp']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
      <div align="left"><strong>Nivel de Estudio de la Pareja: </strong></div>
    </div></td>
    <td bgcolor="#FFFFFF"><span class="Estilo1"><?php echo $row_productores['estuEsp']; ?></span></td>
  </tr>
  <tr valign="baseline" bgcolor="#FF0000">
    <td height="33" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
      <form action="sistemenus.php">
        <input name="submit" type="submit" class="Estilo1" value="Regresar" />
				  <input type="hidden" name="valor" value="<?php echo $valor; ?>" />
 	 <input type="hidden" name="link" value="link2" />
      </form>
    </div></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productores);
?>
