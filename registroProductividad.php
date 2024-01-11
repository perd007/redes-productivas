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
  $insertSQL = sprintf("INSERT INTO produccion ( elaborada, disponible, procesada, producto, productor, rif, fecha) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       
                       GetSQLValueString($_POST['elaborada'], "int"),
                       GetSQLValueString($_POST['disponible'], "int"),
                       GetSQLValueString($_POST['procesada'], "int"),
					   GetSQLValueString($_POST['productos'], "int"),
					   GetSQLValueString($_POST['productor'], "int"),
					   GetSQLValueString($_POST['cooperativa'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php?link=link4&valor=pr4' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?link=link4&valor=pr4' </script>";
  exit;
  }
}

$productores=$_GET["productores"];
$cooperativas=$_GET["cooperativa"];

if($productores!="null"){
$cooperativas="null";
mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula='$productores'";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where id_productor='$row_productores[cedula]'";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

}else{
if($cooperativas!="null"){
$productores="null";
mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where rif='$cooperativas'";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where rif='$row_cooperativas[rif]'";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);

}
}

if($totalRows_productos==0){
 echo "<script type=\"text/javascript\">alert ('No existen Productos Registrados para el Productor');  location.href='sistemenus.php' </script>";
  exit;
}
$fecha=getdate();

if($fecha["mon"]<10){
$cero="-0";
}else{
$cero="-";
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
<style type="text/css">
<!--
.Estilo2 {font-size: 18px; }
.Estilo1 {	font-size: 18px;
	font-weight: bold;
}
.Estilo4 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<p align="center"><span class="Estilo4">Registro de Productividad </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table width="477" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="2" scope="row"><span class="Estilo1">Capacidad de Elaboracion </span></th>
    </tr>
    <tr>
      <th width="214" scope="row"><div align="left" class="Estilo2">Producto</div></th>
      <td width="263"><select name="productos" class="Estilo2" id="productos">
        <option value="-" <?php if (!(strcmp("-", $row_productos['id']))) {echo "selected=\"selected\"";} ?>>Seleccione un Producto</option>
        <?php
do {  
?>
        <option value="<?php echo $row_productos['id']?>"<?php if (!(strcmp($row_productos['id'], $row_productos['id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productos['nombre']?></option>
        <?php
} while ($row_productos = mysql_fetch_assoc($productos));
  $rows = mysql_num_rows($productos);
  if($rows > 0) {
      mysql_data_seek($productos, 0);
	  $row_productos = mysql_fetch_assoc($productos);
  }
?>
      </select></td>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo2">Cantidad Elaborada </div></th>
      <td><input name="elaborada" type="text" class="Estilo2" id="elaborada" value="" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo2"><strong>Canatidad Disponible:</strong></div></th>
      <td><input name="disponible" type="text" class="Estilo2" id="disponible" value="" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo2"><strong>Cantidad Procesada:</strong></div></th>
      <td><input name="procesada" type="text" class="Estilo2" value="" size="5" maxlength="5" disponible="procesada" /></td>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo2"><strong>Fecha de Registro:</strong></div></th>
      <td><span class="Estilo2">
        <input name="fecha" type="text" class="Estilo2" id="fecha" value="<? echo $fecha["year"]."$cero".$fecha["mon"]."-".date("d"); ?>" readonly="readonly"/>
        <input name="button" type="button" class="Estilo2" onclick="displayCalendar(document.forms[0].fecha,'yyyy-mm-dd',this)" value="fecha" />
      </span></td>
    </tr>
    <tr>
      <th colspan="2" scope="row"><span class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Insertar registro" />
		<input type="hidden" name="MM_insert" value="form1" />
  <? if($productores!="null")
			echo " <input type=hidden name=productor value='".$row_productore["cedula"]."'>";
			 else
			 if($cooperativas!="null")
			 echo " <input type=hidden name=cooperativa value='".$cooperativas["rif"]."'>";
			 ?>
      </span></th>
    </tr>
  </table>
</form>

</body>
</html>
