<?php require_once('Connections/conexion.php'); ?>
<?php
mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

if($totalRows_productores==0){
echo "<script type=\"text/javascript\">alert ('No existen Productores Registrados'); location.href='sistemenus.php' </script>";
 exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Listados de Producto por Productor</title>
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
function validar(){
				if(document.form1.productores.value=="-"){
						alert("Debe seleccionar un Prodcutor");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo3">Listados de Productos por Productor</span></p>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="sistemenus.php">
  <table width="444" height="70" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo1">Seleccione un Productor  </div></th>
    </tr>
    <tr>
      <th width="104" height="21" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo1">Productores</div></th>
      <td width="330" bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <select name="productores" class="Estilo1" id="productores">
          <option value="-" <?php if (!(strcmp("-", $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Productor</option>
          <?php
do {  
?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['nombre']?></option>
          <?php
} while ($row_productores = mysql_fetch_assoc($productores));
  $rows = mysql_num_rows($productores);
  if($rows > 0) {
      mysql_data_seek($productores, 0);
	  $row_productores = mysql_fetch_assoc($productores);
  }
?>
        </select>
        </label>
      </span></td>
    </tr>
    <tr>
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo1">
        <label>
        <input name="Submit" type="submit" class="Estilo1" value="Siguiente" />
        </label>
      </span></th>
    </tr>
  </table>
  <p>&nbsp;</p>
  <input type="hidden" name="valor" value="lpp" />
    <input type="hidden" name="link" value="link4" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productores);
?>
