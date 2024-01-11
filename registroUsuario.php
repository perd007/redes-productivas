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
?>
<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

$m=$_POST["modificaciones"];
$c=$_POST["consultas"];
$e=$_POST["eliminaciones"];
$r=$_POST["registros"];
//validar permisos
if($m!=""){
$m=1;
}
else{
$m=0;
}

if($c!=""){
$c=1;
}
else{
$c=0;
}

if($e!=""){
$e=1;
}
else{
$e=0;
}

if($r!=""){
$r=1;
}
else{
$r=0;
}


//chequear usuario
$sql="select usuario from seguridad where usuario='$_POST[usuario]'";
$resultado=mysql_query($sql)or die(mysql_error());
$verificar=mysql_fetch_assoc($resultado);


if($verificar["usuario"]==$_POST['usuario']){
echo "<script type=\"text/javascript\">alert ('Usuario ya Registrado'); location.href='sistemenus.php' </script>";
 exit;

}



  $insertSQL = sprintf("INSERT INTO seguridad (usuario, clave, modificar, consultar, eliminar, registrar) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
					   GetSQLValueString($m, "int"),
					   GetSQLValueString($c, "int"),
					   GetSQLValueString($e, "int"),
					   GetSQLValueString($r, "int"));

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
<title>Registro Usuario</title>
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
<!--
function validar(){
		   if(document.form1.usuario.value==""){
		   alert("DEBE INGRESAR UN USUARIO");
		   return false;
		   }
		    if(document.form1.clave.value==""){
		   alert("DEBE INGRESAR UNA CLAVE");
		   return false;
		   }
		   
		    if(document.form1.modificaciones.checked==false) { 
			 	
			  		if(document.form1.eliminaciones.checked==false){
						
			 				if(document.form1.consultas.checked==false){ 
							
								if(document.form1.registros.checked==false){ 
								
			 						if(document.form1.administrar.checked==false){ 
									
		   						alert("DEBE INGRESAR ALGUN PERMISO PARA ESTE USUARIO");
		   						return false;
										
										}
									}
								}
							
						}
					
				
			}
		 
  } 


		
		 	 
   
//-->
</script>

<body>
<p align="center"><span class="Estilo4 Estilo2">Registro de Usuarios </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" onsubmit="return validar()" name="form1" id="form1">
  <table border="1" align="center" cellspacing="0">
    <tr valign="baseline" bgcolor="#FF0000">
      <td width="126" align="right" nowrap="nowrap"><div align="right" class="Estilo1"><strong>Usuario:</strong></div></td>
      <td width="596"><input name="usuario" type="text" class="Estilo1" value="" size="20" maxlength="10" /></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1"><strong>Clave:</strong></div></td>
      <td bgcolor="#FFFFFF"><input name="clave" type="password" class="Estilo1" value="" size="20" maxlength="10" /></td>
    </tr>
    <tr bgcolor="#00CCFF">
      <th bgcolor="#FF0000" scope="row"><div align="right" class="Estilo1">Permisos</div></th>
      <td bgcolor="#FF0000"><span class="Estilo1">
        <label>
        <input name="modificaciones" type="checkbox" class="Estilo1" value="modificaciones" />
        Modificaciones
        <input name="registros" type="checkbox" class="Estilo1" value="registros" />
          Registros
          <input name="eliminaciones" type="checkbox" class="Estilo1" value="eliminaciones" />
          Eliminaciones
          <input name="consultas" type="checkbox" class="Estilo1" value="consultas" />
          Consultas 
          <input name="administrar" type="checkbox" class="Estilo1" id="administrar" value="administrar" />
          Administrar</label>
      </span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Guardar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
<p>&nbsp;</p>
</body>
</html>
