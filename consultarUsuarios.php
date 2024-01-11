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
mysql_select_db($database_conexion, $conexion);
$query_usuarios = "SELECT * FROM seguridad";
$usuarios = mysql_query($query_usuarios, $conexion) or die(mysql_error());
$row_usuarios = mysql_fetch_assoc($usuarios);
$totalRows_usuarios = mysql_num_rows($usuarios);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {font-size: 24px;
	font-weight: bold;
}


-->
</style>
</head>
<script language="javascript">
<!--

function validar(){

			var valor=confirm('¿Esta seguro de Eliminar este Usuario?');
			if(valor==false){
			return false;
			}
			else{
			return true;
			}
		
}
</script>
<body>
<p align="center" class="Estilo3">Consulta de Usuarios </p>
<table width="771" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr bgcolor="#00CCFF">
    <th colspan="9" bgcolor="#FF0000" scope="col"><span class="Estilo1">Usuarios</span></th>
  </tr>
  <tr>
    <td colspan="2"><div align="center" class="Estilo1"><strong>Usuario y Contrase&ntilde;as </strong></div></td>
    <td colspan="5"><div align="center" class="Estilo1"><strong>Permisos que Posee el Usuario </strong></div></td>
    <td colspan="2"><div align="center" class="Estilo1"><strong>Opciones</strong></div></td>
  </tr>
  <tr bgcolor="#00CCFF">
    <td width="140" bgcolor="#FF0000"><span class="Estilo1"><strong>Usuario</strong></span></td>
    <td width="168" bgcolor="#FF0000"><span class="Estilo1"><strong>Clave</strong></span></td>
    <td width="74" bgcolor="#FF0000"><span class="Estilo1">Modificar</span></td>
    <td width="62" bgcolor="#FF0000"><span class="Estilo1">Eliminar</span></td>
    <td width="54" bgcolor="#FF0000"><span class="Estilo1">Registrar</span></td>
    <td width="58" bgcolor="#FF0000"><span class="Estilo1">Consultar</span></td>
    <td width="76" bgcolor="#FF0000"><span class="Estilo1">Administrar</span></td>
    <td width="76" bgcolor="#FF0000"><div align="center"><span class="Estilo1">Op1</span></div></td>
    <td width="76" bgcolor="#FF0000"><div align="center"><span class="Estilo1">Op2</span></div></td>
  </tr>
  <? do{
  	$m=$row_usuarios["modificar"];
$r=$row_usuarios["registrar"];
$e=$row_usuarios["eliminar"];
$c=$row_usuarios["consultar"];
$a=$row_usuarios["administrar"];
//validar permisos
if($m!=0){
$m="si";
}
else{
$m="no";
}

if($c!=0){
$c="si";
}
else{
$c="no";
}

if($e!=0){
$e="si";
}
else{
$e="no";
}

if($r!=0){
$r="si";
}
else{
$r="no";
}

if($a!=0){
$a="si";
}
else{
$a="no";
}

  
  	$modulo=$cont%2;
			
			if($modulo!=0){
			$color="#FF0000";
			}else{
			$color="#FFFFFF";
			}
			
	
	  ?>
  <tr bgcolor="<?php echo $color; ?>">
    <td class="Estilo1"><?php echo $row_usuarios['usuario']; ?></td>
    <td bgcolor="<?php echo $color; ?>" class="Estilo1"><?php echo $row_usuarios['clave']; ?></td>
    <td><span class="Estilo1"><?php echo $m; ?></span></td>
    <td><span class="Estilo1"><?php echo $e; ?></span></td>
    <td><span class="Estilo1"><?php echo $r; ?></span></td>
    <td><span class="Estilo1"><?php echo $c; ?></span></td>
    <td><span class="Estilo1"><?php echo $a; ?></span></td>
    <td><div align="center" class="Estilo1"><?php echo "<a href='sistemenus.php?id=$row_usuarios[id]&valor=mu&link=link6'>Modificar</a>"; ?></div></td>
    <td><div align="center" class="Estilo1"><?php echo "<a onClick='return validar()' href='sistemenus.php?id=$row_usuarios[id]&valor=eu&link=link6'>Eliminar</a>"; ?></div></td>
  </tr>
  <?php 
	$cont++;
	} while ($row_usuarios = mysql_fetch_assoc($usuarios)); ?>
  <table border="0" width="50%" align="center">
    <tr>
      <td width="23%" align="center"><?php if ($pageNum_usuarios > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, 0, $queryString_usuarios); ?>">Primero</a>
          <?php } // Show if not first page ?>      </td>
      <td width="31%" align="center"><?php if ($pageNum_usuarios > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, max(0, $pageNum_usuarios - 1), $queryString_usuarios); ?>">Anterior</a>
          <?php } // Show if not first page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_usuarios < $totalPages_usuarios) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, min($totalPages_usuarios, $pageNum_usuarios + 1), $queryString_usuarios); ?>">Siguiente</a>
          <?php } // Show if not last page ?>      </td>
      <td width="23%" align="center"><?php if ($pageNum_usuarios < $totalPages_usuarios) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_usuarios=%d%s", $currentPage, $totalPages_usuarios, $queryString_usuarios); ?>">&Uacute;ltimo</a>
          <?php } // Show if not last page ?>      </td>
    </tr>
  </table>
</table>
</body>
</html>
<?php
mysql_free_result($usuarios);
?>
