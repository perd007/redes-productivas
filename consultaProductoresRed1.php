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
echo"<script type=\"text/javascript\">alert ('No Existen Redes Regsitradas'); location.href='sistemenus.php?valor=r1&link=link1' </script>";
exit;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cursos</title>
<style type="text/css">
<!--

a {text-decoration: none;}
a:hover {text-decoration: underline;} 
.Estilo6 {font-size: 18px}
.Estilo9 {	font-size: 24px;
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

<body alink= blue vlink= blue>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="sistemenus.php">
  <p align="center"><span class="Estilo9">Consulta de Productores por Red </span></p>
  <table width="333" height="109" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo6">Seleccione una Red </div></th>
    </tr>
    <tr>
      <th width="122" height="30" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo6">Redes</div></th>
      <td width="201" bgcolor="#FFFFFF"><span class="Estilo6">
        <select name="redes" class="Estilo6" id="redes" >
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
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo6">
        <label>
        <input name="Submit" type="submit" class="Estilo6" value="Siguiente" />
        </label>
      </span></th>
    </tr>
  </table>
   <input type="hidden" name="valor" value="p22" />
  <input type="hidden" name="link" value="link2" />
</form>
<label></label>
</body>
</html>
<?php
mysql_free_result($redes);
?>
