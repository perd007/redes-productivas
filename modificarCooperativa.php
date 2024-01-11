<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($modi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Modificaciones'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE cooperatva SET nombre=%s, rif=%s, muncipip=%s, norte=%s, sur=%s WHERE red=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['rif'], "text"),
                       GetSQLValueString($_POST['muncipip'], "text"),
                       GetSQLValueString($_POST['norte'], "text"),
                       GetSQLValueString($_POST['sur'], "text"),
                       GetSQLValueString($_POST['red'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php?valor=c2&link=link3' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php?valor=c2&link=link3' </script>";
  exit;
  }
}

$rif=$_GET["rif"];
mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where rif='$rif'";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

//verificar si existen cooperativas Registradas
if($totalRows_cooperativas==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cooperativas Registradas'); location.href='sistemenus.php?valor=r1&link=link3' </script>";
exit;
}

mysql_select_db($database_conexion, $conexion);
$query_red = "SELECT * FROM redes";
$red = mysql_query($query_red, $conexion) or die(mysql_error());
$row_red = mysql_fetch_assoc($red);
$totalRows_red = mysql_num_rows($red);

mysql_select_db($database_conexion, $conexion);
$query_redes2 = "SELECT * FROM redes where id='$row_cooperativas[red]'";
$redes2 = mysql_query($query_redes2, $conexion) or die(mysql_error());
$row_redes2 = mysql_fetch_assoc($redes2);
$totalRows_redes2 = mysql_num_rows($redes2);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Cooperativas</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo2 {
	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>
<script language="javascript">
function validar(){


				if(document.form1.redes.value=="-"){
						alert("Debe seleccionar una red");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre de la Cooperativa");
						return false;
				}
			if(document.form1.rif.value==""){
						alert("Debe Ingresar el Rif de la Cooperativa");
						return false;
				}
			if(document.form1.minicipip.value=="-"){
						alert("Debe seleccionar una red");
						return false;
				}
			if(document.form1.norte.value==""){
						alert("Debe el Coordenadas Norte");
						return false;
				}
			
			if(document.form1.sur.value==""){
						alert("Debe el Coordenadas Sur");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo4 Estilo2">Modificar Cooperativas </span></p>
<form  name="form1" id="form1" onsubmit="return validar()" method="post" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">Red: <?php echo $row_redes2['nombre']; ?></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Modificar Red:</span></div></td>
      <td><span class="Estilo1">
        <select name="redes" class="Estilo1" >
          <option value="-" <?php if (!(strcmp("-", $row_red['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione una Red</option>
          <?php
do {  
?>
          <option value="<?php echo $row_red['id']?>"<?php if (!(strcmp($row_red['id'], $row_red['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_red['nombre']?></option>
          <?php
} while ($row_red = mysql_fetch_assoc($red));
  $rows = mysql_num_rows($red);
  if($rows > 0) {
      mysql_data_seek($red, 0);
	  $row_red = mysql_fetch_assoc($red);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="241" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Nombre de la Cooperativa:</span></div></td>
      <td width="314"><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_cooperativas['nombre']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Rif de la Cooperativa:</span></div></td>
      <td><input name="rif" type="text" class="Estilo1" value="<?php echo $row_cooperativas['rif']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Muncipio de la Cooperativa:</span></div></td>
      <td><input name="muncipip" type="text" class="Estilo1" value="<?php echo $row_cooperativas['muncipip']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Coordenadas de la Cooperativa:</span></div></td>
      <td><span class="Estilo1">Norte:
        <input name="norte" type="text" class="Estilo1" value="<?php echo $row_cooperativas['norte']; ?>" size="7" maxlength="7" />
        Sur
        <input name="sur" type="text" class="Estilo1" value="<?php echo $row_cooperativas['sur']; ?>" size="7" maxlength="7" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><span class="Estilo1"></span>        
          <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="red" value="<?php echo $row_cooperativas['red']; ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($cooperativas);

mysql_free_result($red);

mysql_free_result($redes2);
?>
