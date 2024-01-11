<?php require_once('Connections/conexion.php'); ?>
<?php 

//validar usuario

if($validacion==true){
	if($eli==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Eliminaciones'); location.href='sistemensu.php' </script>";
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
$sql="delete from productos where id='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='sistemenus.php?valor=pr3&link=link4' </script>";
}
else
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='sistemenus.php?valor=pr3&link=link4' </script>";
	

?>
