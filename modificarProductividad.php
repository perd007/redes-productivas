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

$productores=$_GET["productores"];
$cooperativas=$_GET["cooperativa"];
$red=$_GET["red"];
  $updateSQL = sprintf("UPDATE produccion SET elaborada=%s, disponible=%s, procesada=%s, fecha=%s WHERE id=%s",
                       GetSQLValueString($_POST['elaborada'], "int"),
                       GetSQLValueString($_POST['disponible'], "int"),
                       GetSQLValueString($_POST['procesada'], "int"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados'); location.href='sistemenus.php?link=link4&valor=cpv2&red=$red&productores=$productores&cooperativa=$cooperativa' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php?link=link4&valor=cpv2&red=$red&productores=$productores&cooperativa=$cooperativa' </script>";
  exit;
  }
}
$id=$_GET["id"];
$productores=$_GET["productores"];
$cooperativas=$_GET["cooperativa"];
$red=$_GET["red"];
mysql_select_db($database_conexion, $conexion);
$query_productividad = "SELECT * FROM produccion where id=$id";
$productividad = mysql_query($query_productividad, $conexion) or die(mysql_error());
$row_productividad = mysql_fetch_assoc($productividad);
$totalRows_productividad = mysql_num_rows($productividad);

if($totalRows_productividad==0){
echo "<script type=\"text/javascript\">alert ('No existe Productividad Registrada');  location.href='sistemenus.php'  </script>";
 exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo2 {font-size: 18px}
.Estilo3 {	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>
<link type="text/css" rel="stylesheet" href="calendario/calendario/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="calendario/calendario/dhtmlgoodies_calendar.js?random=20060118"></script>

<script language="javascript">
function validar(){

		if(document.form1.elaborada.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('elaborada').value)){
				alert('Solo puede ingresar numeros en la cantidad elaborada!!!');
				return false;
		   		}
				}
				if(document.form1.disponible.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('disponible').value)){
				alert('Solo puede ingresar numeros en la cantidad disponible!!!');
				return false;
		   		}
				}
				if(document.form1.procesada.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('procesada').value)){
				alert('Solo puede ingresar numeros en la cantidad procesada!!!');
				return false;
		   		}
				}
				
				
				if(document.form1.elaborada.value=="-"){
						alert("Debe Ingresar la Cantidad Elaborada");
						return false;
				}
				
				
				if(document.form1.disponible.value==""){
						alert("Debe Ingresar la Cantidad Disponible");
						return false;
				}
				if(document.form1.procesada.value==""){
						alert("Debe Ingresar la Cantidad Procesada");
						return false;
				}
			
				if(document.form1.fecha.value==""){
						alert("Debe Ingresar la fecha de registro");
						return false;
				}
				
				
		}
</script>
<body>
<p align="center"><span class="Estilo3">Modificar Productividad </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">Capacidad de Elaboracion </div></td>
    </tr>
    <tr valign="baseline">
      <td width="185" align="right" nowrap="nowrap"><span class="Estilo1">Cantidad Elaborada:</span></td>
      <td width="277"><input name="elaborada" type="text" class="Estilo2" value="<?php echo $row_productividad['elaborada']; ?>" size="5" maxlength="5" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Cantidad Disponible:</span></td>
      <td><input name="disponible" type="text" class="Estilo2" value="<?php echo $row_productividad['disponible']; ?>" size="5" maxlength="5" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Cantidad Procesada:</span></td>
      <td><input name="procesada" type="text" class="Estilo2" value="<?php echo $row_productividad['procesada']; ?>" size="5" maxlength="5" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Fecha de Registro:</span></td>
      <td><span class="Estilo2">
        <input name="fecha" type="fecha" class="Estilo2" id="fecha" value="<?php echo $row_productividad['fecha']; ?>" readonly="readonly" />
        <input name="button" type="button" class="Estilo2" onclick="displayCalendar(document.forms[0].fecha,'yyyy-mm-dd',this)" value="fecha" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_productividad['id']; ?>" />
  <input type="hidden" name="productores" value="<?php echo $productores; ?>" />
  <input type="hidden" name="cooperativas" value="<?php echo $cooperativas; ?>" />
  <input type="hidden" name="red" value="<?php echo $red; ?>" />

</form>
</body>
</html>
<?php
mysql_free_result($productividad);
?>
