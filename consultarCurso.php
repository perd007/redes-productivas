<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($cons==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Consultas'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}
?>
<?php
$currentPage = $_SERVER["PHP_SELF"];

$maxRows_cursos = 10;
$pageNum_cursos = 0;
if (isset($_GET['pageNum_cursos'])) {
  $pageNum_cursos = $_GET['pageNum_cursos'];
}
$startRow_cursos = $pageNum_cursos * $maxRows_cursos;

mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$query_limit_cursos = sprintf("%s LIMIT %d, %d", $query_cursos, $startRow_cursos, $maxRows_cursos);
$cursos = mysql_query($query_limit_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);

if (isset($_GET['totalRows_cursos'])) {
  $totalRows_cursos = $_GET['totalRows_cursos'];
} else {
  $all_cursos = mysql_query($query_cursos);
  $totalRows_cursos = mysql_num_rows($all_cursos);
}
$totalPages_cursos = ceil($totalRows_cursos/$maxRows_cursos)-1;

$queryString_cursos = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_cursos") == false && 
        stristr($param, "totalRows_cursos") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_cursos = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_cursos = sprintf("&totalRows_cursos=%d%s", $totalRows_cursos, $queryString_cursos);

//verificar si existen cursos Registrados
if($totalRows_cursos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Registrados'); location.href='sistemenus.php' </script>";
exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta de Cursos Registrados</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {font-size: 24px; font-weight: bold; }


-->
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Curso?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
//-->
</script>
<body>
<p align="center"><span class="Estilo3">Consulta Cursos </span></p>
<table width="937" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th width="124" scope="col"><span class="Estilo1">Nombre</span></th>
    <th width="140" scope="col"><span class="Estilo1">Facilitador</span></th>
    <th width="115" scope="col"><span class="Estilo1">Estado</span></th>
    <th width="108" scope="col"><span class="Estilo1">Fecha</span></th>
    <th width="173" scope="col"><span class="Estilo1">Tipo</span></th>
    <th width="108" scope="col"><span class="Estilo1">Horas</span></th>
    <th width="80" scope="col"><span class="Estilo1">Opcion</span></th>
    <th width="73" scope="col"><span class="Estilo1">Opcion</span></th>
  </tr>
  <?php do { 
			$modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			?>
  <tr bgcolor="<?php echo $color; ?>" >
    <td height="21"><span class="Estilo1"><?php echo $row_cursos['nombre']; ?></span></td>
    <td height="21"><span class="Estilo1"><?php echo $row_cursos['facilitador']; ?></span></td>
    <td height="21"><span class="Estilo1"><?php echo $row_cursos['estado']; ?></span></td>
    <td height="21"><span class="Estilo1"><?php echo $row_cursos['fecha']; ?></span></td>
    <td height="21"><span class="Estilo1"><?php echo $row_cursos['tipo']; ?></span></td>
    <td height="21"><div align="center" class="Estilo1"><?php echo $row_cursos['horas']; ?></div></td>
    <td><div align="left" class="Estilo1">
      <div align="center"><? echo "<a href='sistemenus.php?id= $row_cursos[id_curso]&valor=mcr&link=link5'>Modificar</a>"; ?></div>
    </div></td>
    <td><div align="left" class="Estilo1">
      <div align="center"><? echo "<a onClick='return validar()' href='sistemenus.php?id= $row_cursos[id_curso]&valor=ecr&link=link5'>Eliminar</a>"; ?></div>
    </div></td>
  </tr>
  <?php $cont++; 
  } while($row_cursos = mysql_fetch_assoc($cursos)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_cursos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_cursos=%d%s", $currentPage, 0, $queryString_cursos); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_cursos > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_cursos=%d%s", $currentPage, max(0, $pageNum_cursos - 1), $queryString_cursos); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_cursos < $totalPages_cursos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_cursos=%d%s", $currentPage, min($totalPages_cursos, $pageNum_cursos + 1), $queryString_cursos); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_cursos < $totalPages_cursos) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_cursos=%d%s", $currentPage, $totalPages_cursos, $queryString_cursos); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($cursos);
?>
