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

$cedula=$_GET["cedula"];
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

mysql_select_db($database_conexion, $conexion);
$query_coop = "SELECT * FROM cooperatva where rif='$_POST[cooperativa]' ";
$coop = mysql_query($query_coop, $conexion) or die(mysql_error());
$row_coop = mysql_fetch_assoc($coop);
$totalRows_coop = mysql_num_rows($coop);

  $updateSQL = sprintf("UPDATE miembrosc SET nombre=%s, apellido=%s, sexo=%s, cedula=%s, cargo=%s, direccion=%s, parroquia=%s, telefono=%s, correo=%s, red=%s WHERE cooperativa=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['sexo'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['cargo'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['parroquia'], "text"),
                       GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['cooperativa'], "text"),
					   GetSQLValueString($row_coop["red"], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
     if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php?valor=c51&link=link3&cooperativa=$_POST[cooperativa]' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php?valor=c51&link=link3cooperativa=$_POST[cooperativa]' </script>";
  exit;
  }
}

mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT * FROM miembrosc where cedula=$cedula";
$miembros = mysql_query($query_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);
$totalRows_miembros = mysql_num_rows($miembros);

 
mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

mysql_select_db($database_conexion, $conexion);
$query_coop2 = "SELECT * FROM cooperatva where rif='$row_miembros[cooperativa]'";
$coop2 = mysql_query($query_coop2, $conexion) or die(mysql_error());
$row_coop2 = mysql_fetch_assoc($coop2);
$totalRows_coop2 = mysql_num_rows($coop2);




?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Miembros de las Cooperativas</title>
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

if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cedula').value)){
				alert('Solo puede ingresar numeros en para la cedula del Representante!!!');
				return false;
		   		}
				}
				
				if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('telefono').value)){
				alert('Solo puede ingresar numeros en para el telefono del Representante!!!');
				return false;
		   		}
				}
				
				if(document.form1.cooperativas.value=="-"){
						alert("Debe Seleccionar una Cooperativa");
						return false;
				}
				if(document.form1.apellido.value==""){
						alert("Debe ingresar un apellido");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar un Nombre");
						return false;
				}
			if(document.form1.cedula.value==""){
						alert("Debe Ingresar la cedula");
						return false;
				}
			if(document.form1.cargo.value=="-"){
						alert("Debe ingresar l cargo");
						return false;
				}
			if(document.form1.parroquia.value==""){
						alert("Debe ingresar la parroquia");
						return false;
				}
			
			if(document.form1.direccion.value==""){
						alert("Debe ingresar la direccion");
						return false;
				}
				if(document.form1.telefono.value==""){
						alert("Debe ingresar el telefono");
						return false;
				}
				if(document.form1.correo.value==""){
						alert("Debe ingresar el correo electronico");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo5 Estilo2">Modificar Miembros de Cooperativas </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">Cooperativa: <?php echo $row_coop2['nombre']; ?></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Modificar Coopertiva:</span></div></td>
      <td><span class="Estilo1">
        <select name="cooperativas" class="Estilo1" id="cooperativa">
          <option value="-" <?php if (!(strcmp("-", $row_cooperativa['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione una Cooperativa</option>
          <?php
do {  
?>
          <option value="<?php echo $row_cooperativa['rif']?>"<?php if (!(strcmp($row_cooperativa['rif'], $row_cooperativa['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cooperativa['nombre']?></option>
          <?php
} while ($row_cooperativa = mysql_fetch_assoc($cooperativa));
  $rows = mysql_num_rows($cooperativa);
  if($rows > 0) {
      mysql_data_seek($cooperativa, 0);
	  $row_cooperativa = mysql_fetch_assoc($cooperativa);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="194" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Nombre del Miembro:</span></div></td>
      <td width="436"><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_miembros['nombre']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Apellido del Miembro:</span></div></td>
      <td><input name="apellido" type="text" class="Estilo1" value="<?php echo $row_miembros['apellido']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Sexo del Miembro:</span></div></td>
      <td><span class="Estilo1">
        <select name="sexo" class="Estilo1" id="sexo">
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Cedula del Miembro:</span></div></td>
      <td><input name="cedula" type="text" class="Estilo1" id="cedula" value="<?php echo $row_miembros['cedula']; ?>" size="11" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Cargo del Miembro:</span></div></td>
      <td><input name="cargo" type="text" class="Estilo1" value="<?php echo $row_miembros['cargo']; ?>" size="50" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Direccion del Miembro:</span></div></td>
      <td><span class="Estilo1">
        <textarea name="direccion" cols="32" class="Estilo1"><?php echo $row_miembros['direccion']; ?></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Parroquia del Miembro:</span></div></td>
      <td><input name="parroquia" type="text" class="Estilo1" value="<?php echo $row_miembros['parroquia']; ?>" size="50" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Telefono del Miembro:</span></div></td>
      <td><input name="telefono" type="text" class="Estilo1" id="telefono" value="<?php echo $row_miembros['telefono']; ?>" size="11" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Correo del Miembro:</span></div></td>
      <td><input name="correo" type="text" class="Estilo1" value="<?php echo $row_miembros['correo']; ?>" size="50" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Modificar " />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="cooperativa" value="<?php echo $row_miembros['cooperativa']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p></p>
</body>
</html>
<?php
mysql_free_result($miembros);

mysql_free_result($coop2);


?>
