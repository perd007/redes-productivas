<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];
$rif=$_GET["cooperativa"];
?>
<?php
$maxRows_miembros = 10;
$pageNum_miembros = 0;
if (isset($_GET['pageNum_miembros'])) {
  $pageNum_miembros = $_GET['pageNum_miembros'];
}
$startRow_miembros = $pageNum_miembros * $maxRows_miembros;

mysql_select_db($database_conexion, $conexion);
$query_miembros = "SELECT * FROM miembrosc where cooperativa='$rif'";
$query_limit_miembros = sprintf("%s LIMIT %d, %d", $query_miembros, $startRow_miembros, $maxRows_miembros);
$miembros = mysql_query($query_limit_miembros, $conexion) or die(mysql_error());
$row_miembros = mysql_fetch_assoc($miembros);

if (isset($_GET['totalRows_miembros'])) {
  $totalRows_miembros = $_GET['totalRows_miembros'];
} else {
  $all_miembros = mysql_query($query_miembros);
  $totalRows_miembros = mysql_num_rows($all_miembros);
}
$totalPages_miembros = ceil($totalRows_miembros/$maxRows_miembros)-1;

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva where rif='$row_miembros[cooperativa]'";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

$queryString_miembros = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_miembros") == false && 
        stristr($param, "totalRows_miembros") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_miembros = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_miembros = sprintf("&totalRows_miembros=%d%s", $totalRows_miembros, $queryString_miembros);


//verificar si existen miembros Registrados
if($totalRows_miembros==0){
echo"<script type=\"text/javascript\">alert ('No Existen Miembros Registrados'); location.href='sistemenus.php' </script>";
exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Consulta de Miembros de las Cooperativas</title>
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

			var valor=confirm('¿Esta seguro de Eliminar este Miembro?');
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
<p align="center"><span class="Estilo5 Estilo2">Consulta de Miembros </span></p>
<table width="904" border="0" align="center" cellspacing="0">
  <tr bgcolor="#FF0000">
    <th colspan="6" bgcolor="#FFFFFF" scope="col"><span class="Estilo1">Cooperativa: <?php echo $row_cooperativa['nombre']; ?></span></th>
  </tr>
  <tr bgcolor="#FF0000">
    <th width="66" scope="col"><div align="center"><span class="Estilo1">Nombre</span></div></th>
    <th width="72" scope="col"><div align="center"><span class="Estilo1">Apellido</span></div></th>
    <th width="89" scope="col"><div align="center"><span class="Estilo1">Cedula</span></div></th>
    <th width="58" scope="col"><div align="center"><span class="Estilo1">Opcion</span></div></th>
    <th width="58" scope="col"><div align="center"><span class="Estilo1">Opcion</span></div></th>
    <th width="62" scope="col"><div align="center"><span class="Estilo1">Opcion</span></div></th>
  </tr>
  <?php do {
			 $modulo=$cont%2;
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			} 
			  
	?>
  <tr bgcolor="<?php echo $color; ?>">
    <td><div align="center"><span class="Estilo1"><?php echo $row_miembros['nombre']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_miembros['apellido']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><?php echo $row_miembros['cedula']; ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><? echo "<a href='sistemenus.php?cedula=$row_miembros[cedula]&valor=mm&link=link3'>Modificar</a>" ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><? echo "<a onClick='return validar()' href='sistemenus.php?cedula=$row_miembros[cedula]&valor=em&link=link3&cooperativa=$row_miembros[cooperativa]'>Eliminar</a>" ?></span></div></td>
    <td><div align="center"><span class="Estilo1"><? echo "<a href='sistemenus.php?cedula=$row_miembros[cedula]&valor=dm&link=link3'>Detalles</a>" ?></span></div></td>
  </tr>
  <?php 
				$cont++;
				} while ($row_miembros = mysql_fetch_assoc($miembros)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, 0, $queryString_miembros); ?>">Primero</a>
            <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_miembros > 0) { // Show if not first page ?>
            <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, max(0, $pageNum_miembros - 1), $queryString_miembros); ?>">Anterior</a>
            <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, min($totalPages_miembros, $pageNum_miembros + 1), $queryString_miembros); ?>">Siguiente</a>
            <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_miembros < $totalPages_miembros) { // Show if not last page ?>
            <a href="<?php printf("%s?pageNum_miembros=%d%s", $currentPage, $totalPages_miembros, $queryString_miembros); ?>">&Uacute;ltimo</a>
            <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($miembros);

mysql_free_result($cooperativa);
?>
