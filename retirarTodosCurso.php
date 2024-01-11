<?php require_once('Connections/conexion.php'); ?>
<?php


 //conexion 
mysql_select_db($database_conexion, $conexion);
  
$id=$_GET['id'];
$sql="delete from regicur where curso='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='sistemenus.php' </script>";
}
else
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='sistemenus.php' </script>";
	

?>
