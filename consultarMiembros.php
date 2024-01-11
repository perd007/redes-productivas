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

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

if($totalRows_cooperativas==0){
	echo "<script type=\"text/javascript\">alert ('NO existen Cooperativas Registradas'); location.href='sistemenus.php' </script>";
    exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
<script>

function validar(){
	if(document.form1.cooperativa.value=="-"){
						alert("Debe seleccionar una Cooperativa");
						return false;
				}

    }
    
	
    </script> 
<body>
<p align="center"><span class="Estilo5 Estilo2 Estilo7">Consulta de Miembros </span></p>
<form id="form1" name="form1" onsubmit="return validar()" method="get" action="sistemenus.php">
  <table width="428" height="70" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo6">Seleccione una Cooperativa </span></th>
    </tr>
    <tr>
      <th width="110" height="21" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo6">Cooperativas</div></th>
      <td width="308" bgcolor="#FFFFFF"><span class="Estilo6">
        <label>
          <select name="cooperativa" class="Estilo6" id="cooperativa">
            <option value="-" <?php if (!(strcmp("-", $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione una Cooperativa</option>
            <?php
do {  
?>
            <option value="<?php echo $row_cooperativas['rif']?>"<?php if (!(strcmp($row_cooperativas['rif'], $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cooperativas['nombre']?></option>
            <?php
} while ($row_cooperativas = mysql_fetch_assoc($cooperativas));
  $rows = mysql_num_rows($cooperativas);
  if($rows > 0) {
      mysql_data_seek($cooperativas, 0);
	  $row_cooperativas = mysql_fetch_assoc($cooperativas);
  }
?>
          </select>
        </label>
      </span></td>
    </tr>
    <tr>
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo6">
        <label>
          <input name="Submit" type="submit" class="Estilo6" value="Siguiente" />
        </label>
      </span></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <input type="hidden" name="valor" value="c51" />
  <input type="hidden" name="link" value="link3" />
</form>
</body>
</html>
<?php
mysql_free_result($cooperativas);
?>
