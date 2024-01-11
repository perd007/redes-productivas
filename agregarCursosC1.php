<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='sistemenu.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenu.php'  </script>";
 exit;
}
?>
<?php
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

//validar si existen redes registradas
if($totalRows_redes==0){
echo"<script type=\"text/javascript\">alert ('No Existen Redes Regsitradas'); location.href='sistemenus.php?valor=r1&link=link1'</script>";
exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Agregar Cursos a las Cooperativas</title>
<style type="text/css">
<!--
.Estilo8 {font-size: 18px}
.Estilo9 {
	font-size: 24px;
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
<form id="form1" name="form1" method="get" onsubmit="resturn validar()" action="sistemenus.php">
  <p align="center" class="Estilo9">Agregar  Cooperativas a Cursos </p>
  <table width="379" height="109" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo7 Estilo8">Seleccione una Red </div></th>
    </tr>
    <tr>
      <th width="122" height="30" bgcolor="#FFFFFF" scope="row"><div align="right" class="Estilo7 Estilo8">Redes</div></th>
      <td width="247" bgcolor="#FFFFFF"><span class="Estilo7 Estilo8">
        <select name="redes" class="Estilo8" id="redes" >
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
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo7 Estilo8">
        <label>
        <input name="Submit" type="submit" class="Estilo7" value="Siguiente" />
        </label>
      </span></th>
    </tr>
  </table>

  <input type="hidden" name="valor" value="acc1" />
  <input type="hidden" name="link" value="link5" />
</form>
</body>
</html>
