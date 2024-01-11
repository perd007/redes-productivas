<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($eli==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Eliminaciones'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}
?>
<?php

 //conexion 
mysql_select_db($database_conexion, $conexion);
  
$id=$_GET['id'];
$sql="delete from redes where id=$id";
$verificar=mysql_query($sql) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='sistemenus.php?valor=r2&link=link1' </script>";
	exit;
}
else{
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='sistemenus.php?valor=r2&link=link1</script>";
	exit;
	}
?>
