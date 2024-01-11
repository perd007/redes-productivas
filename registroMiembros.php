<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario

if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='sistemenus.php' </script>";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {


//verificar que la cooperativa no alla sido registrada
mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT * FROM miembrosc where cedula='$_POST[cedula]' ";
$miembros = mysql_query($query_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);
$totalRows_miembros = mysql_num_rows($miembros);


if($row_miembros["cedula"]==$_POST['cedula']){
 echo "<script type=\"text/javascript\">alert ('Esta persona ya esta registrada en la Cooperativa');  location.href='sistemenus.php' </script>";
exit;
}

mysql_select_db($database_conexion, $conexion);
$query_coop = "SELECT * FROM cooperatva where rif='$_POST[cooperativa]' ";
$coop = mysql_query($query_coop, $conexion) or die(mysql_error());
$row_coop = mysql_fetch_assoc($coop);
$totalRows_coop = mysql_num_rows($coop);

  $insertSQL = sprintf("INSERT INTO miembrosc (nombre, apellido, sexo, cedula, cargo, direccion, parroquia, telefono, correo, cooperativa, red) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados'); location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php' </script>";
  exit;
  }
}

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);


//verificar si existen cooperativas Registradas
if($totalRows_cooperativa==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cooperativas Registradas'); location.href='sistemenus.php' </script>";
exit;
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
				

				if(document.form1.apellido.value=="-"){
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
<p align="center"><span class="Estilo5 Estilo2">Registro de Miembros de las Cooperativas </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td width="194" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Cooperativa:</span></div></td>
      <td width="421"><label>
        <select name="cooperativa" class="Estilo1">
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
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Nombre del Miembro:</span></div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Apellido del Miembro:</span></div></td>
      <td><input name="apellido" type="text" class="Estilo1" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Sexo del Miembro:</span></div></td>
      <td><select name="sexo" class="Estilo1" id="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Cedula del Miembro:</span></div></td>
      <td><input name="cedula" type="text" class="Estilo1" id="cedula" value="" size="11" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Cargo del Miembro:</span></div></td>
      <td><input name="cargo" type="text" class="Estilo1" value="" size="50" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Direccion del Miembro:</span></div></td>
      <td><textarea name="direccion" cols="32" class="Estilo1"></textarea></td>
    </tr>
    
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Parroquia del Miembro:</span></div></td>
      <td><input name="parroquia" type="text" class="Estilo1" value="" size="50" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Telefono del Miembro:</span></div></td>
      <td><input name="telefono" type="text" class="Estilo1" id="telefono" value="" size="20" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Correo del Miembro:</span></div></td>
      <td><input name="correo" type="text" class="Estilo1" value="" size="50" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
        <input name="submit" type="submit" class="Estilo1" value="Guardar Datos" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
</body>
</html>
