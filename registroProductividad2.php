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

$red=$_GET["redes"];
$tipo=$_GET["tipo"];

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where id_red='$red' order by cedula asc";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where red='$red'";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
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
function validar(){

		
				if(document.form1.productores.value=="-"){
						alert("Debe seleccionar un Productor");
						return false;
				}
				
				
				if(document.form1.cooperativas.value=="-"){
						alert("Debe Seleccionar una Cooperativa");
						return false;
				}
				
				
		}
		

</script>
<body>
<p align="center"><span class="Estilo5 Estilo2">Registro de Productividad </span></p>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="sistemenus.php">
  <table width="379" height="89" border="0" align="center" cellspacing="0">
    <tr>
      <th height="21" colspan="2" bgcolor="#FF0000" scope="row"><span class="Estilo1">Seleccione una Opcion </span></th>
    </tr>
    <tr>
      <th width="122" height="21" scope="row"><div align="right" class="Estilo1"><?php echo $tipo; ?></div></th>
      <td width="247"><span class="Estilo1">
        <label>
        <?php if($tipo=="productores"){
				echo " 
                  <select name=productores  class=Estilo1 id=productores>
                    <option value=- "; if (!(strcmp("-", $row_productores['nombre']))) {echo "selected=\"selected\"";} echo " >Seleccione un Productor</option>";
                    
do {  echo "   <option value='$row_productores[cedula]'"; if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} echo ">".$row_productores['cedula']." ".$row_productores['nombre']."  ".$row_productores['apellido'];"</option>."; ?>
        <?php
} while ($row_productores = mysql_fetch_assoc($productores));
  $rows = mysql_num_rows($productores);
  if($rows > 0) {
      mysql_data_seek($productores, 0);
	  $row_productores = mysql_fetch_assoc($productores);
  }
  
  echo "</select>";
  }//fin del if
  
  //con las coopefrativas ahora..................................................................
  else{
  if($tipo=="cooperativas"){
  

                  
                echo "  <select name=cooperativa class=Estilo1 id=cooperativa>
                    <option value=-";  if (!(strcmp("-", $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} echo ">Seleccione una Cooperativa</option>";
                   
do {  

                  echo "  <option value='$row_cooperativas[rif]'"; if (!(strcmp($row_cooperativas['rif'], $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} echo ">".$row_cooperativas['nombre']." </option>"; ?>
        <?php
} while ($row_cooperativas = mysql_fetch_assoc($cooperativas));
  $rows = mysql_num_rows($cooperativas);
  if($rows > 0) {
      mysql_data_seek($cooperativas, 0);
	  $row_cooperativas = mysql_fetch_assoc($cooperativas);
  }
  echo "</select>";
  }//fin del if
  }//fin del else
?>
        </label>
      </span></td>
    </tr>
    <tr>
      <th height="26" colspan="2" scope="row"><span class="Estilo1">
        <label>
        <input name="Submit" type="submit" class="Estilo1" value="Siguiente" />
        </label>
      </span></th>
    </tr>
    <tr>
      <th height="21" bgcolor="#FF0000" scope="row">&nbsp;</th>
      <td bgcolor="#FF0000">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="valor" value="pr42" />
   <input type="hidden" name="link" value="link4" />
</form>
<p></p>
</body>
</html>
