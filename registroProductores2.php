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
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT id, nombre FROM redes";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

mysql_select_db($database_conexion, $conexion);
$query_redes2 = "SELECT id, nombre FROM redes";
$redes2 = mysql_query($query_redes2, $conexion) or die(mysql_error());
$row_redes2 = mysql_fetch_assoc($redes2);
$totalRows_redes2= mysql_num_rows($redes2);

mysql_select_db($database_conexion, $conexion);
$query_redes3 = "SELECT id, nombre FROM redes";
$redes3 = mysql_query($query_redes3, $conexion) or die(mysql_error());
$row_redes3 = mysql_fetch_assoc($redes3);
$totalRows_redes3 = mysql_num_rows($redes3);

mysql_select_db($database_conexion, $conexion);
$query_redes4 = "SELECT id, nombre FROM redes";
$redes4 = mysql_query($query_redes4, $conexion) or die(mysql_error());
$row_redes4 = mysql_fetch_assoc($redes4);
$totalRows_redes4 = mysql_num_rows($redes4);

//validar si existen redes registradas
if($totalRows_redes==0){
echo"<script type=\"text/javascript\">alert ('No Existen Redes Regsitradas'); location.href='sistemenus.php' </script>";
exit;
}


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if($_POST["redes"]==$_POST["redes2"] or $_POST["redes"]==$_POST["redes3"] or $_POST ["redes"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la primera');  location.href='sistemenus.php?valor=p12&link=link2&cedula=$_POST[cedula]' </script>";
  exit;
}
if($_POST["redes2"]!="")
if($_POST["redes2"]==$_POST["redes"] or $_POST["redes2"]==$_POST["redes3"] or $_POST ["redes2"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la segunda');  location.href='sistemenus.php?valor=p12&link=link2&cedula=$_POST[cedula]' </script>";
  exit;
}
if($_POST["redes3"]!="")
if($_POST["redes3"]==$_POST["redes2"] or $_POST["redes3"]==$_POST["redes"] or $_POST ["redes3"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la tercera');  location.href='sistemenus.php?valor=p12&link=link2&cedula=$_POST[cedula]' </script>";
  exit;
}
if($_POST["redes4"]!="")
if($_POST["redes4"]==$_POST["redes2"] or $_POST["redes4"]==$_POST["redes3"] or $_POST ["redes4"]==$_POST["redes"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la cuarta');  location.href='sistemenus.php?valor=p12&link=link2&cedula=$_POST[cedula]' </script>";
  exit;
}
	
  $insertSQL = sprintf("INSERT INTO productores (cedula, nombre, apellido, direccion, telefono, correo, id_red, id_red2, id_red3, id_red4, empresa, estudio, etnia, ingreso, localidad, miembros, terreno, vivienda, esposa, edad, edadEsp, estuEsp, municipio, parroquia, norte, sur, sexo) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['telefono'], "int"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['redes'], "int"),
					   GetSQLValueString($_POST['redes2'], "int"),
					   GetSQLValueString($_POST['redes3'], "int"),
					   GetSQLValueString($_POST['redes4'], "int"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['estudio'], "text"),
                       GetSQLValueString($_POST['etnia'], "text"),
                       GetSQLValueString($_POST['ingreso'], "double"),
                       GetSQLValueString($_POST['localidad'], "text"),
                       GetSQLValueString($_POST['miembros'], "int"),
                       GetSQLValueString($_POST['terreno'], "text"),
                       GetSQLValueString($_POST['vivienda'], "text"),
                       GetSQLValueString($_POST['esposa'], "text"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['edadEsp'], "int"),
                       GetSQLValueString($_POST['estuEsp'], "text"),
					   GetSQLValueString($_POST['municipio'], "text"),
					   GetSQLValueString($_POST['parroquia'], "text"),
					   GetSQLValueString($_POST['norte'], "text"),
					   GetSQLValueString($_POST['sur'], "text"),
					   GetSQLValueString($_POST['sexo'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
    if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php' </script>";
  exit;
  }
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de Productores</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
	font-weight: bold;
}
.Estilo2 {font-size: 18px}
.Estilo4 {
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
				alert('Solo puede ingresar numeros en para la cedula del Productor!!!');
				return false;
		   		}
				}
				
				if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('telefono').value)){
				alert('Solo puede ingresar numeros en para el telefono del Productor!!!');
				return false;
		   		}
				}
				
		
				
			
				if(document.form1.nombre.value=="-"){
						alert("Debe Ingresar el Nombre del Productor");
						return false;
				}
			
				if(document.form1.direccion.value==""){
						alert("Debe Ingresar la direccion del Productor");
						return false;
				}
			
				if(document.form1.apellido.value==""){
						alert("Debe Ingresar el Apellido del Productor");
						return false;
				}
				if(document.form1.cedula.value==""){
						alert("Debe Ingresar La Cedula del Productor");
						return false;
				}
		
			
				if(document.form1.municipio.value=="-"){
						alert("Debe Seleccioner un municipio");
						return false;
				}
				if(document.form1.parroqiua.value==""){
						alert("Debe Ingresar la parroquia");
						return false;
				}
				
				if(document.form1.redes.value=="-"){
						alert("Debe Selecionar una Red"); 
						return false;
				}
			
		}
</script>
<body>
<div align="center"><span class="Estilo4">Registro de Productores </span></div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <p>&nbsp;</p>
  <table align="center">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo1">Datos del Productor </div></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center"><strong>Redes a la que Pertenece </strong></div></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left">Red N&ordm; 1: </div>
      </div></td>
      <td><span class="Estilo2">
        <select name="redes" class="Estilo2" id="redes">
          <option value="">-</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes['id']?>"<?php if (!(strcmp($row_redes['id'], $row_redes['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes['nombre']?></option>
          <?php
} while ($row_redes = mysql_fetch_assoc($redes));
  $rows = mysql_num_rows($redes);
  if($rows > 0) {
      mysql_data_seek($redes, 0);
	  $row_redes = mysql_fetch_assoc($redes);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left">Red N&ordm; 2: </div>
      </div></td>
      <td><span class="Estilo2">
        <select name="redes2" class="Estilo2" id="redes2">
          <option value="">-</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes2['id']?>"<?php if (!(strcmp($row_redes2['id'], $row_redes2['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes2['nombre']?></option>
          <?php
} while ($row_redes2 = mysql_fetch_assoc($redes2));
  $rows = mysql_num_rows($redes2);
  if($rows > 0) {
      mysql_data_seek($redes2, 0);
	  $row_redes2 = mysql_fetch_assoc($redes2);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left">Red N&ordm; 3: </div>
      </div></td>
      <td><span class="Estilo2">
        <select name="redes3" class="Estilo2" id="redes3">
          <option value="">-</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes3['id']?>"<?php if (!(strcmp($row_redes3['id'], $row_redes3['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes3['nombre']?></option>
          <?php
} while ($row_redes3 = mysql_fetch_assoc($redes3));
  $rows = mysql_num_rows($redes3);
  if($rows > 0) {
      mysql_data_seek($redes3, 0);
	  $row_redes3= mysql_fetch_assoc($redes3);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left">Red N&ordm;4: </div>
      </div></td>
      <td><span class="Estilo2">
        <select name="redes4" class="Estilo2" id="redes4">
          <option value="">-</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes4['id']?>"<?php if (!(strcmp($row_redes4['id'], $row_redes4['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes4['nombre']?></option>
          <?php
} while ($row_redes4 = mysql_fetch_assoc($redes4));
  $rows = mysql_num_rows($redes4);
  if($rows > 0) {
      mysql_data_seek($redes4, 0);
	  $row_redes4 = mysql_fetch_assoc($redes4);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="241" align="right" nowrap="nowrap"><div align="right" class="Estilo2">
        <div align="left"><strong>Cedula del Productor:</strong></div>
      </div></td>
      <td width="284"><input name="cedu" id="cedu" type="text" class="Estilo2"  size="32" maxlength="8" value="<?php echo $_GET["cedula"];?>" disabled="disabled" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nombre del Productor:</strong></div>
      </div></td>
      <td><input name="nombre" type="text" class="Estilo2" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Apellido del Productor:</strong></div>
      </div></td>
      <td><input name="apellido" type="text" class="Estilo2" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Municipio:</strong></span></div></td>
      <td><span class="Estilo2">
        <select name="municipio" class="Estilo2" id="municipio" >
          <option value="0">-</option>
          <option value="Alto_Orinoco">Alto Orinoco</option>
          <option value="Atabapo">Atabapo</option>
          <option value="Atures">Atures</option>
          <option value="Autana">Autana</option>
          <option value="Manapiare">Manapiare</option>
          <option value="Maroa">Maroa</option>
          <option value="Rio_Negro">R&iacute;o Negro</option>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Parroquia:</strong></span></div></td>
      <td><input name="parroquia" type="text" class="Estilo2" id="parroquia" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Direccion del Productor:</strong></div>
      </div></td>
      <td><span class="Estilo2">
        <textarea name="direccion" cols="32" class="Estilo2"></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo2"><strong>Coordenadas del Productor </strong></span></div></td>
      <td><span class="Estilo2"><strong>Norte</strong>
          <label>
          <input name="norte" type="text" class="Estilo2" id="norte" size="25" maxlength="100" />
          <strong>Sur</strong>
          <input name="sur" type="text" class="Estilo2" id="sur" size="25" maxlength="100" />
          </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Telefono del Productor:</strong></div>
      </div></td>
      <td><input name="telefono" type="text" class="Estilo2" value="" size="32" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Correo del Productor:</strong></div>
      </div></td>
      <td><input name="correo" type="text" class="Estilo2" value="" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nombre de la Empresa: </strong></div>
      </div></td>
      <td><input name="empresa" type="text" class="Estilo2" value="" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nivel de Estudio del Productor:</strong></div>
      </div></td>
      <td><input name="estudio" type="text" class="Estilo2" value="" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Grupo Etnico: </strong></div>
      </div></td>
      <td><input name="etnia" type="text" class="Estilo2" value="" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Sexo:</strong></span></div></td>
      <td><span class="Estilo2">
        <label>
        <select name="sexo" class="Estilo2" id="sexo">
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Edad:</strong></div>
      </div></td>
      <td><input name="edad" type="text" class="Estilo2" value="" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo2">
        <div align="center"><strong>Datos de la Familia </strong></div>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Ingresos Mensuales de la Familia: </strong></div>
      </div></td>
      <td><input name="ingreso" type="text" class="Estilo2" value="" size="10" maxlength="7" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Localidad donde viven:</strong></div>
      </div></td>
      <td><span class="Estilo2">
        <textarea name="localidad" cols="32" class="Estilo2"></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Numero de Miembros de la Familia:</strong></div>
      </div></td>
      <td><input name="miembros" type="text" class="Estilo2" value="" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td height="47" align="right" nowrap="nowrap"><div align="right" class="Estilo2">
        <div align="left"><strong>Terreno donde de estan Ubicados:</strong></div>
      </div></td>
      <td><span class="Estilo2">
        <textarea name="terreno" cols="32" class="Estilo2"></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Tipo de Vivienda: </strong></div>
      </div></td>
      <td><input name="vivienda" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nombre del Esposo o Esposa: </strong></div>
      </div></td>
      <td><input name="esposa" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Edad del Esposo o Esaposa:</strong></div>
      </div></td>
      <td><input name="edadEsp" type="text" class="Estilo2" value="" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo2">
        <div align="left"><strong>Nivel de Estudio de la Parajea: </strong></div>
      </div></td>
      <td><input name="estuEsp" type="text" class="Estilo2" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Guardar Datos" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
  <input type="hidden" name="cedula" value="<?php echo $_GET["cedula"];?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($redes);
?>