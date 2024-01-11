<?php require_once('Connections/conexion.php'); ?>
<?php


 //conexion 
mysql_select_db($database_conexion, $conexion);
  
$id=$_GET['id'];
$cursos=$_GET["curso"];
$sql="delete from regicur where id='$id'";
$verificar=mysql_query($sql,$conexion) or die(mysql_error());

if($verificar){
	echo"<script type=\"text/javascript\">alert ('Datos Eliminado'); location.href='sistemenus.php?cursos=$cursos&valor=cc1&link=link5' </script>";
}
else
	echo"<script type=\"text/javascript\">alert ('Error'); location.href='sistemenus.php?cursos=$cursos&valor=cc1&link=link5'</script>";
	

?>
