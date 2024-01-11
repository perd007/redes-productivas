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

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT cedula FROM productores where cedula='$_POST[cedula]'";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);


if($row_productores["cedula"]==$_POST["cedula"]){
  echo "<script type=\"text/javascript\">alert ('Esta cedula esta registrada');  location.href='sistemenus.php?link=link2&valor=p1' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Esta cedula no esta registrada');  location.href='sistemenus.php?link=link2&valor=p12&cedula=$_POST[cedula]' </script>";
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
				
			
				if(document.form1.cedula.value==""){
						alert("Debe Ingresar La Cedula del Productor");
						return false;
				}
		
			
				
			
		}
</script>
<body>
<div align="center"><span class="Estilo4">Registro de Productores </span></div>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <p>&nbsp;</p>
  <table width="387" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo1">Verificacion de Registro de Productores </div></td>
    </tr>
    <tr valign="baseline">
      <td width="177" align="right" nowrap="nowrap"><div align="right" class="Estilo2">
        <div align="left"><strong>Cedula del Productor:</strong></div>
      </div></td>
      <td width="204"><input name="cedula" id="cedula" type="text" class="Estilo2"  size="11" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FF0000"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Consultar Cedula" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
