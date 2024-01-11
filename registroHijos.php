<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='sistemenu.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenu.php'  </script>";
 exit;
}
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}



if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$query_productores2 = "SELECT * FROM productores where cedula='$_POST[productor]'";
$productores2 = mysql_query($query_productores2, $conexion) or die(mysql_error());
$row_productores2 = mysql_fetch_assoc($productores2);

  $insertSQL = sprintf("INSERT INTO hijos (productor, nombre, apellido, cedula, edad, estudio, viveJ, trabaja, red) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['productor'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['estudio'], "text"),
                       GetSQLValueString($_POST['viveJ'], "text"),
                       GetSQLValueString($_POST['trabaja'], "text"),
                       GetSQLValueString($row_productores2["id_red"], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='registroHijos.php' </script>";
  exit;
  }
}

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);



//validar si existen redes registradas
if($totalRows_productores==0){
echo"<script type=\"text/javascript\">alert ('No Existen Productores Regsitrados'); location.href='registroProductores.php' </script>";
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de Hijos de Productores</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo2 {font-size: 18px}
.Estilo3 {
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
<p align="center" class="Estilo4 Estilo3">Registro de Hijos de Productores </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td width="134" align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left">Productor:</div>
      </div></td>
      <td width="245"><span class="Estilo2">
        <select name="productor" class="Estilo2" id="productor">
          <option value="0" <?php if (!(strcmp(0, $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Productor</option>
          <?php
do {  
?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['nombre']?></option>
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
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nombre del Hijo:</strong></div>
      </div></td>
      <td><input name="nombre" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Apellido del Hijo:</strong></div>
      </div></td>
      <td><input name="apellido" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Cedula del Hijo:</strong></div>
      </div></td>
      <td><input name="cedula" type="text" class="Estilo2" id="cedula" value="" size="8" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Edad:</strong></div>
      </div></td>
      <td><input name="edad" type="text" class="Estilo2" id="edad" value="" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nivel de Estudio:</strong></div>
      </div></td>
      <td><input name="estudio" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>&iquest;Viven Juntos?:</strong></div>
      </div></td>
      <td><span class="Estilo2">
        <label>
        <select name="viveJ" class="Estilo2" id="viveJ">
          <option value="-">-</option>
          <option value="SI">SI</option>
          <option value="NO">NO</option>
        </select>
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>&iquest;Trabaja?:</strong></div>
      </div></td>
      <td><span class="Estilo2">
        <label>
        <select name="trabaja" class="Estilo2" id="trabaja">
          <option value="-">-</option>
          <option value="SI">SI</option>
          <option value="NO">NO</option>
        </select>
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Guardar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
</body>
</html>
