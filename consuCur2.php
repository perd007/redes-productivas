<?php require_once('Connections/conexion.php'); ?>
<?php
$currentPage = $_SERVER["PHP_SELF"];


$id_curso=$_GET['cursos'];

mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos where id_curso=$id_curso";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);


$maxRows_regsitro = 10;
$pageNum_regsitro = 0;
if (isset($_GET['pageNum_regsitro'])) {
  $pageNum_regsitro = $_GET['pageNum_regsitro'];
}
$startRow_regsitro = $pageNum_regsitro * $maxRows_regsitro;

mysql_select_db($database_conexion, $conexion);
$query_regsitro = "SELECT * FROM regicur where curso=$id_curso order by curso";
$query_limit_regsitro = sprintf("%s LIMIT %d, %d", $query_regsitro, $startRow_regsitro, $maxRows_regsitro);
$regsitro = mysql_query($query_limit_regsitro, $conexion) or die(mysql_error());
$row_regsitro = mysql_fetch_assoc($regsitro);

if (isset($_GET['totalRows_regsitro'])) {
  $totalRows_regsitro = $_GET['totalRows_regsitro'];
} else {
  $all_regsitro = mysql_query($query_regsitro);
  $totalRows_regsitro = mysql_num_rows($all_regsitro);
}
$totalPages_regsitro = ceil($totalRows_regsitro/$maxRows_regsitro)-1;


$queryString_regsitro = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_regsitro") == false && 
        stristr($param, "totalRows_regsitro") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_regsitro = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_regsitro = sprintf("&totalRows_regsitro=%d%s", $totalRows_regsitro, $queryString_regsitro);


//verificar si existen Cursos Relaiados
if($totalRows_regsitro==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Realizados'); location.href='sistemenus.php?valor=cr1&link=link5' </script>";
exit;
}


$hombres=0;
$mujeres=0;
$cooperativas=0;

mysql_select_db($database_conexion, $conexion);
$query_registro2 = "SELECT * FROM regicur";
$registro2 = mysql_query($query_registro2, $conexion) or die(mysql_error());
$row_registro2 = mysql_fetch_assoc($registro2);
$totalRows_registro2 = mysql_num_rows($registro2);

 do { 
 
 
		  if($row_registro2["cooperativa"]!=""){

		 $query_conteoc = "SELECT * FROM cooperatva where rif='$row_regsitro2[cooperativa]'";
		 $conteoc = mysql_query($query_conteoc, $conexion) or die(mysql_error());
		 $row_conteoc = mysql_fetch_assoc($conteoc);
		 $totalRows_conteoc = mysql_num_rows($conteoc);
 
		  $cooperativas++;
		 
		  }
		 
		  if($row_registro2["productor"]!=""){
		   //Datos Productores
		  $query_conteo = "SELECT * FROM productores where cedula='$row_regsitro[productor]'";
          $conteo = mysql_query($query_conteo, $conexion) or die(mysql_error());
		  $row_conteo = mysql_fetch_assoc($conteo);
          $totalRows_conteo = mysql_num_rows($conteo);
		
		 	//contar mujeres y hombres
			if($row_conteo['sexo']=="Masculino")
			$hombres++;
			else
			if($row_conteo['sexo']=="Femenino")
			$mujeres++;
		 
		 
		  }
		  if($row_registro2["personal"]!=""){
		  
		   //Datos Productores
		  $query_conteop = "SELECT * FROM regicur2 where cedula='$row_regsitro[personal]'";
          $conteop = mysql_query($query_conteop, $conexion) or die(mysql_error());
		  $row_conteop = mysql_fetch_assoc($conteop);
          $totalRows_conteop = mysql_num_rows($conteop);
		
		 	//contar mujeres y hombres
			if($row_conteop['sexo']=="Masculino")
			$hombres++;
			else
			if($row_conteop['sexo']=="Femenino")
			$mujeres++;
			
		  }
		  
		  
		  
		  
 } while ($row_registro2 = mysql_fetch_assoc($registro2)); 
 
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Participacion en los Cursos</title>
<style type="text/css">
<!--

.Estilo6 {font-size: 18px}
.Estilo7 {
	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro Sacar esta Persona del Curso?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}

function validar2(){

			var valor=confirm('¿Esta seguro que Desea Retirar a todos  del Curso?');
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
<p align="center"><span class="Estilo5 Estilo2 Estilo7">Consulta de Participacion de Cursos</span></p>
<table width="904" border="0" align="center" cellspacing="0">
  <tr>
    <th height="21" colspan="4" bgcolor="#FF0000" scope="col"><span class="Estilo6"> Curso: <?php echo $row_cursos['nombre']; ?> </span></th>
    <th bgcolor="#FF0000" scope="col"><div align="left" ><? echo "<a onClick='return validar2()' href='sistemnus.php?id=$row_regsitro[id]&valor=rct&link=link5'>Retirar Todos</a>" ?></div></th>
  </tr>
  <tr>
    <th height="21" colspan="5" bgcolor="#FFFFFF" scope="col"><div align="left" class="Estilo6">N&deg; de Participantes (PI): Hombres: <?php echo $hombres; ?> Mujeres: <?php echo $mujeres; ?> Total <?php echo $mujeres+$hombres; ?> </div></th>
  </tr>
  <tr>
    <th height="21" colspan="5" bgcolor="#FFFFFF" scope="col"><div align="left" class="Estilo6">N&deg; de Cooperativas: <?php echo $cooperativas;  ?> </div></th>
  </tr>
  <tr>
    <td width="258" bgcolor="#FF0000"><div align="center" class="Estilo6"><strong>Participantes</strong> </div></td>
    <td width="138" bgcolor="#FF0000"><div align="center"><span class="Estilo6"><strong>Cedula</strong></span></div></td>
    <td width="271" bgcolor="#FF0000"><div align="center"><span class="Estilo6"><strong>Procedencia</strong></span></div></td>
    <td width="120" bgcolor="#FF0000"><div align="center"><span class="Estilo6"><strong>Tipo</strong></span></div></td>
    <td width="107" bgcolor="#FF0000"><div align="center"><span class="Estilo6"><strong>Retirar</strong></span></div></td>
  </tr>
  
  <?php 
  

  
  
  
  do { 
 
  

		  if($row_regsitro["cooperativa"]!=""){
		  $tipo="Cooperativa";
		  
		  
		 mysql_select_db($database_conexion, $conexion);
		 $query_cooperativas = "SELECT * FROM cooperatva where rif='$row_regsitro[cooperativa]'";
		 $cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
		 $row_cooperativas = mysql_fetch_assoc($cooperativas);
		 $totalRows_cooperativas = mysql_num_rows($cooperativas);
		 
		  $nombre=$row_cooperativas["nombre"];
		  $codigo=$row_cooperativas["rif"];
		  
		  
		  mysql_select_db($database_conexion, $conexion);
		  $query_red = "SELECT * FROM redes where id='$row_cooperativas[red]'";
		  $red = mysql_query($query_red, $conexion) or die(mysql_error());
		  $row_red = mysql_fetch_assoc($red);
		  $totalRows_red = mysql_num_rows($red);
		  
		  $red=$row_red['nombre'];
		  
		
		 
		  }
		 if($row_regsitro["productor"]!=""){
		  $tipo="Productor";
		  
		   //Datos Productores
		  mysql_select_db($database_conexion, $conexion);
		  $query_productores = "SELECT * FROM productores where cedula='$row_regsitro[productor]'";
          $productores = mysql_query($query_productores, $conexion) or die(mysql_error());
		  $row_productores = mysql_fetch_assoc($productores);
          $totalRows_productores = mysql_num_rows($productores);
		  
		  $nombre=$row_productores['nombre']." ".$row_productores['apellido'];
		  $codigo=$row_productores['cedula'];
		  
		  
		  mysql_select_db($database_conexion, $conexion);
		  $query_red = "SELECT * FROM redes where id='$row_productores[id_red]'";
		  $red = mysql_query($query_red, $conexion) or die(mysql_error());
		  $row_red = mysql_fetch_assoc($red);
		  $totalRows_red = mysql_num_rows($red);
		  
		  $red=$row_red['nombre'];
		  
		  }
		  if($row_regsitro["personal"]!=""){
		   $tipo="Otro";
		  
		   //Datos Productores
		  $query_per = "SELECT * FROM regicur2 where cedula='$row_regsitro[personal]'";
          $per = mysql_query($query_per, $conexion) or die(mysql_error());
		  $row_per = mysql_fetch_assoc($per);
          $totalRows_per = mysql_num_rows($per);
		
		  $nombre=$row_per['nombre']." ".$row_per['apellido'];
		  $codigo=$row_per['cedula'];
			$red=$row_per['provenencia'];
		  }
	
		  ?>
  <tr>
    <td><div align="center"><span class="Estilo6"><?php echo $nombre; ?></span></div></td>
    <td><div align="center"><span class="Estilo6"><?php echo $codigo; ?></span></div></td>
    <td><div align="center"><span class="Estilo6"><?php echo $red; ?></span></div></td>
    <td><div align="center"><span class="Estilo6"><?php echo $tipo; ?></span></div></td>
    <td><div align="center"><span class="Estilo6"><? echo "<a onClick='return validar()' href='sistemenus.php?id=$row_regsitro[id]&curso=$id_curso&valor=rc&link=link5'>Retirar</a>"; ?></span></div></td>
  </tr>
   <?php $cont++;} while ($row_regsitro = mysql_fetch_assoc($regsitro)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_regsitro > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_regsitro=%d%s", $currentPage, 0, $queryString_regsitro); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_regsitro > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_regsitro=%d%s", $currentPage, max(0, $pageNum_regsitro - 1), $queryString_regsitro); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_regsitro < $totalPages_regsitro) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_regsitro=%d%s", $currentPage, min($totalPages_regsitro, $pageNum_regsitro + 1), $queryString_regsitro); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_regsitro < $totalPages_regsitro) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_regsitro=%d%s", $currentPage, $totalPages_regsitro, $queryString_regsitro); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($registro2);
?>
