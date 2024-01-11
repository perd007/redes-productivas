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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

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
$sql="select * from seguridad where usuario='$_POST[usuario]'";
$resultado=mysql_query($sql)or die(mysql_error());
$verificar=mysql_fetch_assoc($resultado);


if($verificar["usuario"]==$_POST['usuario'] and id==$_POST['id'] ){
echo "<script type=\"text/javascript\">alert ('Usuario ya Registrado'); location.href='sistemenus.php?valor=u2&link=link6'  </script>";
 exit;

}
  $updateSQL = sprintf("UPDATE seguridad SET usuario=%s, clave=%s, modificar=%s, consultar=%s, registrar=%s, eliminar=%s, administrar=%s WHERE id=%s",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['modificaciones'], "int"),
                       GetSQLValueString($_POST['consultas'], "int"),
                       GetSQLValueString($_POST['registros'], "int"),
                       GetSQLValueString($_POST['eliminaciones'], "int"),
                       GetSQLValueString($_POST['administrar'], "int"),
                       GetSQLValueString($_POST['id'], "int"));
					   
				
  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
   
   if($_COOKIE["usr"]==$_POST['usuario']){
 echo "<script type=\"text/javascript\">alert ('Datos Modificados. Debe iniciar sesion nuevamente');  location.href='cerrarSesion.php' </script>";		}else{
 			 echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='sistemenus.php?valor=u2&link=link6' </script>";
  }
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=u2&link=link6' </script>";
  exit;
  }
}

$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_usuarios = "SELECT * FROM seguridad where id=$id";
$usuarios = mysql_query($query_usuarios, $conexion) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Usuarios</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {
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
<p align="center"><span class="Estilo3">Modificar Usuarios </span></p>
<form  method="post" name="form1" id="form1" onsubmit="retunr validar()" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td width="717" align="right" nowrap="nowrap"><table border="0" align="center" cellpadding="0" cellspacing="0">
        <tr valign="baseline" bgcolor="#FF0000">
          <td width="99" align="right" nowrap="nowrap"><div align="right" class="Estilo1">
            <div align="left"><strong>Usuario:</strong></div>
          </div></td>
          <td width="600"><div align="left">
            <input name="usuario" type="text" class="Estilo1" value="<?php echo $row_usuarios["usuario"]; ?>" size="20" maxlength="10" />
          </div></td>
        </tr>
        <tr valign="baseline" bgcolor="#FF0000">
          <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="right" class="Estilo1">
            <div align="left"><strong>Clave:</strong></div>
          </div></td>
          <td bgcolor="#FFFFFF"><div align="left">
            <input name="clave" type="text" class="Estilo1" value="<?php echo $row_usuarios["clave"]; ?>" size="20" maxlength="10" />
          </div></td>
        </tr>
        <tr bgcolor="#00CCFF">
          <th bgcolor="#FF0000" scope="row"><div align="right" class="Estilo1">
            <div align="left">Permisos</div>
          </div></th>
          <td bgcolor="#FF0000"><div align="left"><span class="Estilo1">
          </span></div>            <span class="Estilo1"><label>
              <div align="left">
                <input name="modificaciones" type="checkbox" class="Estilo1" id="modificaciones" value="1" <?php if($row_usuarios["modificar"]==1) echo "checked='checked'";?> />
              Modificaciones
              <input name="registros" type="checkbox" class="Estilo1" value="1"<?php if($row_usuarios["registrar"]==1) echo "checked='checked'";?> />
              Registros
              <input name="eliminaciones" type="checkbox" class="Estilo1" value="1" <?php if($row_usuarios["eliminar"]==1) echo "checked='checked'";?> />
              Eliminaciones
              <input name="consultas" type="checkbox" class="Estilo1" value="1" <?php if($row_usuarios["consultar"]==1) echo "checked='checked'";?> />
              Consultas 
              <input name="administrar" type="checkbox" class="Estilo1" id="administrar" value="1" <?php if($row_usuarios["administrar"]==1) echo "checked='checked'";?> />
              Administrar</div>
            </label>
          </span></td>
        </tr>
        <tr valign="baseline" bgcolor="#FF0000">
          <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="center" class="Estilo1">
            
              <div align="center">
                <input name="submit" type="submit" class="Estilo1" value="Modificar" />
              </div>
          </div></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p>&nbsp; </p>
  <p>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id" value="<?php echo $row_usuarios['id']; ?>" />
  </p>
</form>
</body>
</html>
<?php
mysql_free_result($usuarios);
?>