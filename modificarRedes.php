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
  $updateSQL = sprintf("UPDATE redes SET nombre_rep=%s, apellido_rep=%s, cedula_rep=%s, telefono=%s, direccion=%s, correo=%s,  nombre=%s, rif=%s, actividad=%s, objetivo=%s,  ano=%s, monto=%s, rubro=%s WHERE id=%s",
                       GetSQLValueString($_POST['nombre_rep'], "text"),
                       GetSQLValueString($_POST['apellido_rep'], "text"),
                       GetSQLValueString($_POST['cedula_rep'], "int"),
                       GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['rif'], "text"),
                       GetSQLValueString($_POST['actividad'], "text"),
					    GetSQLValueString($_POST['objetivo'], "text"),
					   GetSQLValueString($_POST['conformacion'], "int"),
					    GetSQLValueString($_POST['monto'], "text"),
						GetSQLValueString($_POST['rubro'], "text"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='sistemenus.php?valor=r2&link=link1' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=r2&link=link1' </script>";
  exit;
  }
}
$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes where id=$id";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Redes</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>

<script language="javascript">
function validar(){
		if(document.form1.cedula_rep.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cedula_rep').value)){
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
				if(document.form1.conformacion.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('conformacion').value)){
				alert('Solo puede ingresar numeros en el año de conformacion de la red!!!');
				return false;
		   		}
				}
		
				if(document.form1.nombre_rep.value==""){
						alert("Debe Ingresar el Nombre del Representante de la Red");
						return false;
				}
				if(document.form1.apellido_rep.value==""){
						alert("Debe Ingresar el Apellido del Representante de la Red");
						return false;
				}
				if(document.form1.cedula_rep.value==""){
						alert("Debe Ingresar la Cedula del Representante de la Red");
						return false;
				}
				if(document.form1.telefono.value==""){
						alert("Debe Ingresar el Telefono del Representante de la Red");
						return false;
				}
				
				if(document.form1.direccion.value==""){
						alert("Debe Ingresar la direccion de la Red");
						return false;
				}
				if(document.form1.correo.value==""){
						alert("Debe Ingresar correo del Representante de la Red");
						return false;
				}
				
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre de la Red");
						return false;
				}
				if(document.form1.rif.value==""){
						alert("Debe Ingresar el Rif de la Red");
						return false;
				}
		
				if(document.form1.actividad.value==""){
						alert("Debe Ingresar el Nombre de la Red");
						return false;
				}
					if(document.form1.objetivo.value==""){
						alert("Debe Ingresar el Objetivo de la Red");
						return false;
				}
				
			
				if(document.form1.conformacion.value==""){
						alert("Debe Ingresar el Año de la Red");
						return false;
				}
				if(document.form1.monto.value==""){
						alert("Debe Ingresar el Monto del Proyecto de la Red");
						return false;
				}
				if(document.form1.rubro.value==""){
						alert("Debe Ingresar el Rubro");
						return false;
				}
		}
</script>
<body>
<p align="center" class="Estilo4"><span class="Estilo3">Modificar Redes </span></p>
<form  action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td width="235" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Nombre del Representante:</span></div></td>
      <td width="322"><input name="nombre_rep" type="text" class="Estilo1" value="<?php echo $row_redes['nombre_rep']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Apellido del Representante:</span></div></td>
      <td><input name="apellido_rep" type="text" class="Estilo1" value="<?php echo $row_redes['apellido_rep']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Cedula del Representante:</span></div></td>
      <td><input name="cedula_rep" type="text" class="Estilo1" id="cedula_rep" value="<?php echo $row_redes['cedula_rep']; ?>" size="32" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Telefono del Representante:</span></div></td>
      <td><input name="telefono" type="text" class="Estilo1" id="telefono" value="<?php echo $row_redes['telefono']; ?>" size="32" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Direccion del Representante:</span></div></td>
      <td><textarea name="direccion" cols="32" class="Estilo1"><?php echo $row_redes['direccion']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Correo del Representante:</span></div></td>
      <td><input name="correo" type="text" class="Estilo1" value="<?php echo $row_redes['correo']; ?>" size="32" maxlength="50" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Nombre de la Red:</span></div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_redes['nombre']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Rif de la Red:</span></div></td>
      <td><input name="rif" type="text" class="Estilo1" value="<?php echo $row_redes['rif']; ?>" size="32" maxlength="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Actividad que Realiza la Red:</span></div></td>
      <td><input name="actividad" type="text" class="Estilo1" value="<?php echo $row_redes['actividad']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Objetivo</span></div></td>
      <td><textarea name="objetivo" cols="23" class="Estilo1" id="objetivo"><?php echo $row_redes['objetivo']; ?></textarea></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">A&ntilde;o de Conformacion </span></div></td>
      <td><input name="conformacion" type="text" class="Estilo1" id="conformacion" size="6" maxlength="4" value="<?php echo $row_redes['ano']; ?>"  /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Monto del Proyecto </span></div></td>
      <td><input name="monto" type="text" class="Estilo1" id="monto" maxlength="12" value="<?php echo $row_redes['monto']; ?>"  /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1">Rubro</span></div></td>
      <td><label>
        <input name="rubro" type="text" class="Estilo1" id="rubro" maxlength="30" value="<?php echo $row_redes['rubro']; ?>"  />
      </label></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
        <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_redes['id']; ?>" />
</form>
</body>
</html>
<?php
mysql_free_result($redes);
?>