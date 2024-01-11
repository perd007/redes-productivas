<?php require_once('Connections/conexion.php'); ?>
<?php
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

if($totalRows_redes==0){
	echo "<script type=\"text/javascript\">alert ('No existen Redes Registradas'); location.href='sistemenus.php' </script>";
    exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Estadistica de Miembrs de Cooperativas por Red</title>
<style type="text/css">
<!--
.Estilo4 {font-size: 18px}
.Estilo5 {font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<script language="javascript">
function validar(){
				if(document.form1.redes.value=="-"){
						alert("Debe seleccionar una red");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo5">Estadisticas de Miembros de Cooperativas </span> <span class="Estilo5">por Red</span></p>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="sistemenus.php">
  <table width="379" height="109" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo4">Seleccione una Red </div></th>
    </tr>
    <tr>
      <th width="122" height="30" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo4">Redes</div></th>
      <td width="247" bgcolor="#FFFFFF"><span class="Estilo4">
        <select name="redes" class="Estilo4" id="redes" >
          <option value="-" <?php if (!(strcmp("-", $row_redes['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione Una Red</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes['id']?>"<?php if (!(strcmp($row_redes['id'], $row_redes['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes['nombre']?></option>
          <?php
} while ($row_redes = mysql_fetch_assoc($redes));
  $rows = mysql_num_rows($redes);
  if($rows > 0) {
      mysql_data_seek($redes, 0);
	  $row_redes = mysql_fetch_assoc($redes);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo4">
        <label>
        <input name="Submit" type="submit" class="Estilo4" value="Siguiente" />
        </label>
      </span></th>
    </tr>
  </table>
   <input type="hidden" name="valor" value="c61" />
    <input type="hidden" name="link" value="link3" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($redes);
?>
