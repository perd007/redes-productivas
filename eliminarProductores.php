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
if($_GET["consu"]==1)
$valor="p2";
else
$valor="p22";

 //conexion 
mysql_select_db($database_conexion, $conexion);
  
$cedula=$_GET['cedula'];
$red==$_GET['red'];
$sql="delete from productores where cedula='$cedula'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='sistemenus.php?valor=$valor&link=link2&redes=$red' </script>";
}
else
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='sistemenus.php?valor=$valor&link=link2&redes=$red' </script>";
	

?>
