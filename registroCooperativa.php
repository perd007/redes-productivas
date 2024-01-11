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
$query_cooperativa = "SELECT * FROM cooperatva where nombre='$_POST[nombre]' or rif='$_POST[rif]'";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

if($row_cooperativa["nombre"]==$_POST['nombre']){
 echo "<script type=\"text/javascript\">alert ('Este nombre ya existe');  location.href='sistemenus.php' </script>";
exit;
}
if($row_cooperativa["rif"]==$_POST['rif']){
 echo "<script type=\"text/javascript\">alert ('Este Rif ya existe');  location.href='sistemenus.php' </script>";
exit;
}


  $insertSQL = sprintf("INSERT INTO cooperatva (nombre, rif, red, muncipip, norte, sur) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['rif'], "text"),
                       GetSQLValueString($_POST['red'], "int"),
                       GetSQLValueString($_POST['muncipip'], "text"),
                       GetSQLValueString($_POST['norte'], "text"),
                       GetSQLValueString($_POST['sur'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados'); location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php' </script>";
  exit;
  }
}
//consuta de la redes
mysql_select_db($database_conexion, $conexion);
$query_red = "SELECT * FROM redes";
$red = mysql_query($query_red, $conexion) or die(mysql_error());
$row_red = mysql_fetch_assoc($red);
$totalRows_red = mysql_num_rows($red);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de Cooperativas</title>
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


				if(document.form1.red.value=="-"){
						alert("Debe seleccionar una red");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre de la Cooperativa");
						return false;
				}
			if(document.form1.Rif.value==""){
						alert("Debe Ingresar el Rif de la Cooperativa");
						return false;
				}
			if(document.form1.minicipip.value=="-"){
						alert("Debe seleccionar una red");
						return false;
				}
			if(document.form1.norte.value==""){
						alert("Debe ingresar lasCoordenadas Norte");
						return false;
				}
			
			if(document.form1.sur.value==""){
						alert("Debe ingresar las Coordenadas Sur");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo5 Estilo3">Registro de Cooperativas </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    
    <tr valign="baseline">
      <td width="216" align="right" nowrap="nowrap"><div align="left"><span class="Estilo1">Red a la que Pertenece:</span></div></td>
      <td width="263"><span class="Estilo2">
        <label>
        <select name="red" class="Estilo2" id="red">
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
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo2"><strong>Nombre de la Cooperativa: </strong></span></div></td>
      <td><input name="nombre" type="text" class="Estilo2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Rif:</strong></span></div></td>
      <td><input name="rif" type="text" class="Estilo2" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Muncipio:</strong></span></div></td>
      <td><span class="Estilo2">
        <select name="muncipip" class="Estilo2" id="muncipip" >
          <option value="-">Seleccione un Municipio</option>
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
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Coordenadas:</strong></span></div></td>
      <td><span class="Estilo2"><strong>Nort</strong>e
        <input name="norte" type="text" class="Estilo2" value="" size="7" maxlength="7" />
          <strong>Sur</strong>
          <input name="sur" type="text" class="Estilo2" value="" size="7" maxlength="7" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Guardar Datos" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
</body>
</html>
<?php
mysql_free_result($red);
?>
