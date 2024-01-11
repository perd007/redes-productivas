<?php require_once('Connections/conexion.php'); ?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET["MM_update"])) && ($_GET["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE regicur2 SET cedula=%s, nombre=%s, apellido=%s, sexo=%s, provenencia=%s  WHERE cedula=%s",
                      
					  GetSQLValueString($_GET['cedula2'], "text"),
					   GetSQLValueString($_GET['nombre'], "text"),
                       GetSQLValueString($_GET['apellido'], "text"),
                       GetSQLValueString($_GET['sexo'], "text"),
                       GetSQLValueString($_GET['provenencia'], "text"),
                       GetSQLValueString($_GET['cedula'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados'); location.href='sistemenus.php?valor=cr7&link=link5' </script>";
    exit;
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=cr7&link=link5' </script>";
  exit;
  }	
}


$cedula=$_GET["cedula"];

mysql_select_db($database_conexion, $conexion);
$query_personal = "SELECT * FROM regicur2 where cedula=$cedula";
$personal = mysql_query($query_personal, $conexion) or die(mysql_error());
$row_personal = mysql_fetch_assoc($personal);
$totalRows_personal = mysql_num_rows($personal);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo5 {font-size: 18px; }
-->
</style>
</head>
<script language="javascript">
function validar(){

if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cedula').value)){
				alert('Solo puede ingresar numeros en para la cedula!!!');
				return false;
		   		}
				}
				if(document.form1.cedula.value==""){
						alert("Debe ingresaruna cedula");
						return false;
				}
				if(document.form1.cedula.value==""){
						alert("Debe ingresar una cedula");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe ingresar un nombre");
						return false;
				}
				if(document.form1.apellido.value==""){
						alert("Debe ingresar un apellido");
						return false;
				}
			    if(document.form1.provenencia.value==""){
						alert("Debe ingresar el lugar de donde proveiene la persona");
						return false;
				}
			
		}

</script>
<body>
<form  method="get" onsubmit="return validar()" name="form1" action="<?php echo $editFormAction; ?>">
  <table width="379" height="169" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo5">Modificacion de Datos </div></th>
    </tr>

    <tr valign="baseline">
      <td width="103" align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Cedula:</strong></div></td>
      <td width="272"><input name="cedula2" type="text" class="Estilo5" id="cedula" value="<?php echo $row_personal['cedula']; ?>" size="10" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Nombre:</strong></div></td>
      <td><input name="nombre" type="text" class="Estilo5" value="<?php echo $row_personal['nombre']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Apellido:</strong></div></td>
      <td><input name="apellido" type="text" class="Estilo5" value="<?php echo $row_personal['apellido']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Sexo:</strong></div></td>
      <td><select name="sexo" class="Estilo5" id="sexo">
	   <?php  
				
				if($row_personal['sexo']=="Masculino")
				echo " 
                <option value=Masculino>Masculino</option>
                <option value=Femenino>Femenino</option>
				";
				
				if($row_personal['sexo']=="Femenino")
				echo " 
				<option value=Femenino>Femenino</option>
                <option value=Masculino>Masculino</option>
                ";
				?>
          
      </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Procedencia:</strong></div></td>
      <td><input name="provenencia" type="text" class="Estilo5" value="<?php echo $row_personal['provenencia']; ?>" size="50" maxlength="50" /></td>
    </tr>
    <tr>
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo5">
        <label>
        <input type="submit" name="Submit" value="Modifcar Datos" />
        </label>
      </span></th>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="cedula" value="<?php echo $row_personal['cedula']; ?>">
      <input type="hidden" name="valor" value="cr8" />
  <input type="hidden" name="link" value="link5" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($personal);
?>
