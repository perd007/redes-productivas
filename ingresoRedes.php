<?php require_once('Connections/conexion.php'); ?>
<?php
//validar usuario

if($validacion==true){
	if($Admi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Operaciones sobre los Usuarios'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO redes ( nombre_rep, apellido_rep, cedula_rep, telefono, direccion, correo, nombre, rif, actividad, objetivo, ano, monto, rubro) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       
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
					   GetSQLValueString($_POST['monto'], "int"),
					   GetSQLValueString($_POST['rubro'], "text"));

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
<title>Ingreso de Redes</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo4 {
	font-size: 24px;
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
<p align="center" class="Estilo4">Registro de Redes</p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table width="589" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="Estilo1">
    <tr valign="baseline" bgcolor="#FF0000">
      <td width="230" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Nombre del Representante </div>
      </div></td>
      <td width="355" bgcolor="#FFFFFF"><input name="nombre_rep" type="text" class="Estilo1" id="nombre_rep" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Apellidos del Representante </div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="apellido_rep" type="text" class="Estilo1" id="apellido_rep" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Cedula del Representante:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="cedula_rep" type="text" class="Estilo1" id="cedula_rep" value="" size="32" maxlength="8" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Telefono del Representante:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="telefono" type="text" class="Estilo1" id="telefono" value="" size="32" maxlength="11" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Direccion del Representante:</div>
      </div></td>
      <td bgcolor="#FFFFFF">        <textarea name="direccion" cols="32" class="Estilo1" id="direccion"></textarea>      </td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Correo:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="correo" type="text" class="Estilo1" id="correo" value="" size="30" maxlength="50" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Nombre de la Red:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="nombre" type="text" class="Estilo1" id="nombre" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline" bordercolor="#FFFFFF" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Rif de la Red:</div>
      </div></td>
      <td bgcolor="#FFFFFF"><input name="rif" type="text" class="Estilo1" id="rif" value="" size="32" maxlength="10" /></td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
        <div align="left">Actividad que realiza:</div>
      </div></td>
      <td bordercolor="#FF0000" bgcolor="#FFFFFF"><input name="actividad" type="text" class="Estilo1" id="actividad" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td height="40" align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left">Objetivo de la Red </div></td>
      <td rowspan="2" bordercolor="#FF0000" bgcolor="#FFFFFF">        <label>
        <textarea name="objetivo" cols="40" class="Estilo1" id="objetivo"></textarea>
        </label>      </td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"></td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left">A&ntilde;o de Conformacion </div></td>
      <td bordercolor="#FF0000" bgcolor="#FFFFFF">        <label>
        <input name="conformacion" type="text" class="Estilo1" id="conformacion" size="6" maxlength="4" />
        </label>      </td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left">Monto del Proyecto </div></td>
      <td bordercolor="#FF0000" bgcolor="#FFFFFF">        <label>
        <input name="monto" type="text" class="Estilo1" id="monto" maxlength="12" />
        </label>      </td>
    </tr>
    <tr valign="baseline" bordercolor="#FF0000" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left">Rubro</div></td>
      <td bordercolor="#FF0000" bgcolor="#FFFFFF">        <label>
        <input name="rubro" type="text" class="Estilo1" id="rubro" maxlength="30" />
        </label>      </td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Guardar" />
		
      </div></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
