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

$query_productores2 = "SELECT * FROM productores where cedula='$_POST[productor]'";
$productores2 = mysql_query($query_productores2, $conexion) or die(mysql_error());
$row_productores2 = mysql_fetch_assoc($productores2);

  $updateSQL = sprintf("UPDATE hijos SET nombre=%s, apellido=%s, cedula=%s, edad=%s, estudio=%s, viveJ=%s, trabaja=%s, red=%s WHERE productor=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['estudio'], "text"),
                       GetSQLValueString($_POST['viveJ'], "text"),
                       GetSQLValueString($_POST['trabaja'], "text"),
                       GetSQLValueString($row_productores2["id_red"], "int"),
                       GetSQLValueString($_POST['productor'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='sistemenus.php?valor=p5&link=link2' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');   location.href='sistemenus.php?valor=p5&link=link2' </script>";
  exit;
  }
}

$id=$_GET["id"];

mysql_select_db($database_conexion, $conexion);
$query_hijos = "SELECT * FROM hijos where id=$id";
$hijos = mysql_query($query_hijos, $conexion) or die(mysql_error());
$row_hijos = mysql_fetch_assoc($hijos);
$totalRows_hijos = mysql_num_rows($hijos);


mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula='$row_hijos[productor]' ";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Datos de los Hijos</title>
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
				alert('Solo puede ingresar numeros en la cedula!!!');
				return false;
		   		}
				}
				
				if(document.form1.edad.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('edad').value)){
				alert('Solo puede ingresar numeros en la edad!!!');
				return false;
		   		}
				}
				
				
		
				
				if(document.form1.productor.value==0){
						alert("Debe Seleccionar un Productor");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre del Hijo o Hija");
						return false;
				}
			
				if(document.form1.apellido.value==""){
						alert("Debe Ingresar el Apellido del Hijo o Hija");
						return false;
				}
			
				
				if(document.form1.edad.value==""){
						alert("Debe Ingresar la Edad");
						return false;
				}
				if(document.form1.estudio.value==""){
						alert("Debe Indicar el Nievel de Estudio");
						return false;
				}
				if(document.form1.viveJ.value==""){
						alert("Debe Indicar si Vive con el Productor");
						return false;
				}
				if(document.form1.trabaja.value==""){
						alert("Debe Indicar si Trabaja o no ");
						return false;
				}
			
				
		}
</script>
<body>
<p align="center"><span class="Estilo4 Estilo2">Modificar Hijos </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    
    <tr valign="baseline">
      <td width="220" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>Seleccione el Productor:</strong> </span></div></td>
      <td width="314"><span class="Estilo1">
        <select name="select" class="Estilo1" id="productor">
          <?php
do {  

if($row_productores["cedula"]==$row_productos["id_productor"]){ ?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['nombre']?></option>
          <? }//fin del if 
		
		else{
		if($row_productores["cedula"] != $row_productos["id_productor"]){
		?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['nombre']?></option>
          <? }}//fin del else ?>
          <?php
} while ($row_productores = mysql_fetch_assoc($productores));
  $rows = mysql_num_rows($productores);
  if($rows > 0) {
      mysql_data_seek($productores, 0);
	  $row_productores = mysql_fetch_assoc($productores);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Nombre del Hijo</strong>:</span></div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_hijos['nombre']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Apellido del Hijo</strong>:</span></div></td>
      <td><input name="apellido" type="text" class="Estilo1" value="<?php echo $row_hijos['apellido']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Cedula del Hijo</strong>:</span></div></td>
      <td><input name="cedula" type="text" class="Estilo1" id="cedula" value="<?php echo $row_hijos['cedula']; ?>" size="8" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Edad</strong>:</span></div></td>
      <td><input name="edad" type="text" class="Estilo1" id="edad" value="<?php echo $row_hijos['edad']; ?>" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Nivel de Estudio</strong>:</span></div></td>
      <td><input name="estudio" type="text" class="Estilo1" value="<?php echo $row_hijos['estudio']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>&iquest;Viven Juntos?</strong>:</span></div></td>
      <td><span class="Estilo1"> 
        <select name="viveJ" class="Estilo1" id="viveJ">
          <?php
				if($row_hijos['viveJ']=="SI"){
                 echo "
                  <option value='SI'>SI</option>
                  <option value='NO'>NO</option>";
				  }
				  
				  if($row_hijos['viveJ']=="NO"){
                 echo "
				  <option value='NO'>NO</option>
                  <option value='SI'>SI</option>
                 ";
				  }
				  ?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td height="29" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>&iquest;Trabaja?</strong>:</span></div></td>
      <td><span class="Estilo1">
        <select name="trabaja" class="Estilo1" id="trabaja">
          <?php
				if($row_hijos['trabaja']=="SI"){
                 echo "
                  <option value='SI'>SI</option>
                  <option value='NO'>NO</option>";
				  }
				  
				  if($row_hijos['trabaja']=="NO"){
                 echo "
				  <option value='NO'>NO</option>
                  <option value='SI'>SI</option>
                 ";
				  }
				  ?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td height="28" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="productor" value="<?php echo $row_hijos['productor']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($hijos);
?>
