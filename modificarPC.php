<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($modi==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Modificaciones'); location.href='sistemenus.php' </script>";
    exit;
	}
}
else{
echo "<script type=\"text/javascript\">alert ('Error usuario invalido');  location.href='sistemenus.php'  </script>";
 exit;
}
?>
<?php


//Inicio de del juego de registro


$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

mysql_select_db($database_conexion, $conexion);
$query_cooperativas2 = "SELECT * FROM cooperatva where rif='$_POST[cooperativa]'";
$cooperativas2 = mysql_query($query_cooperativas2, $conexion2) or die(mysql_error());
$row_cooperativas2 = mysql_fetch_assoc($cooperativas2);
$totalRows_cooperativas2 = mysql_num_rows($cooperativas2);

  $updateSQL = sprintf("UPDATE productos SET distribucion=%s, nombre=%s, medida=%s, tiempo=%s, cantidad=%s, id_productor=%s, costo=%s, area=%s, instalada=%s, procesamiento=%s, produccion=%s, red=%s, tiempo2=%s WHERE id=%s",
                       GetSQLValueString($_POST['distribucion'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['medida'], "text"),
                       GetSQLValueString($_POST['tiempo'], "text"),
                       GetSQLValueString($_POST['cantidad'], "int"),
					   GetSQLValueString($_POST['productor'], "int"),
                       GetSQLValueString($_POST['costo'], "int"),
                       GetSQLValueString($_POST['area'], "text"),
                       GetSQLValueString($_POST['instalada'], "text"),
                       GetSQLValueString($_POST['procesamiento'], "text"),
                       GetSQLValueString($_POST['produccion'], "text"),
					   GetSQLValueString($row_cooperativas2['red'], "int"),
					   GetSQLValueString($_POST['tiempo2'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
     if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php?valor=pr3&link=link4' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error'); location.href='sistemenus.php?valor=pr3&link=link4' </script>";
  exit;
}

$rif=$_GET["rif"];
mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where rif='$rif'";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);


//Fin del juego de registro

mysql_select_db($database_conexion, $conexion);
$query_cooperativa = "SELECT * FROM cooperatva";
$cooperativa = mysql_query($query_cooperativa, $conexion) or die(mysql_error());
$row_cooperativa = mysql_fetch_assoc($cooperativa);
$totalRows_cooperativa = mysql_num_rows($cooperativa);

//verificar si existen cooperativas Registradas
if($totalRows_cooperativa==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cooperativas Registradas'); location.href='registroCooperativas.php' </script>";
exit;
}

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

		if(document.form1.cantidad.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cantidad').value)){
				alert('Solo puede ingresar numeros en la cantidad estimada!!!');
				return false;
		   		}
				}
				
					if(document.form1.tiempo2.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('tiempo2').value)){
				alert('Solo puede ingresar numeros en la cantidad del periodo!!!');
				return false;
		   		}
				}
				
				if(document.form1.tiempo2.value==""){
						alert("Debe Ingresar la cantidad del periodo");
						return false;
				}
				if(document.form1.cooperativa.value=="-"){
						alert("Debe seleccionar la cooperativa");
						return false;
				}
				
		
				
				if(document.form1.distribucion.value==""){
						alert("Debe Ingresar la Distribucion o Comercializacion");
						return false;
				}
				if(document.form1.red.value=="-"){
						alert("Debe Seleccionar una  Red");
						return false;
				}
			
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre del Producto");
						return false;
				}
				if(document.form1.medida.value=="-"){
						alert("Debe Seleccionar una Unidad de Medicion");
						return false;
				}
				if(document.form1.cantidad.value==""){
						alert("Debe Ingresar la cantidad de Produccion");
						return false;
				}
				if(document.form1.costo.value==""){
						alert("Debe Ingresar el costo por Unidad del Producto");
						return false;
				}
				if(document.form1.area.value==""){
						alert("Debe Ingresar el Área de cultivo o de pesca / Tamaño del rebaño");
						return false;
				}
				if(document.form1.instalada.value==""){
						alert("Debe Ingresar la Capacidad Instalada");
						return false;
				}
				if(document.form1.procesamiento.value==""){
						alert("Debe Ingresar la Capacidad de Procesamiento ");
						return false;
				}
				if(document.form1.produccion.value==""){
						alert("Debe Ingresar la Capacidad de Produccion");
						return false;
				}
				
		}
</script>
<body>
<p align="center" class="Estilo4 Estilo2">Modificar  Productos de Cooperativas </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left" class="Estilo1">Cooperativas</div></td>
      <td><span class="Estilo1">
        <select name="productor" class="Estilo1" id="productor">
          <?php
do {  

if($row_cooperativa["rif"]==$row_productos["rif"]){ ?>
          <option value="<?php echo $row_cooperativa['rif']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_cooperativa['nombre']?></option>
          <? }//fin del if 
		
		else{
		if($row_cooperativa["rif"] != $row_productos["rif"]){
		?>
          <option value="<?php echo $row_cooperativa['rif']?>"<?php if (!(strcmp($row_cooperativa['rif'], $row_cooperativa['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cooperativas['nombre']?></option>
          <? }}//fin del else ?>
          <?php
} while ($row_cooperativa = mysql_fetch_assoc($cooperativas));
  $rows = mysql_num_rows($cooperativa);
  if($rows > 0) {
      mysql_data_seek($cooperativa, 0);
	  $row_cooperativa = mysql_fetch_assoc($cooperativa);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="291" align="right" nowrap="nowrap"><div align="left" class="Estilo1">Distribucion o Comercializacion:</div></td>
      <td width="233"><input name="distribucion" type="text" class="Estilo1" value="<?php echo $row_productos['distribucion']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Nombre del Producto:</div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_productos['nombre']; ?>" size="32" maxlength="3o" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Unidad Productiva :</div></td>
      <td><span class="Estilo1">
        <select name="medida" class="Estilo1" id="medida">
          <?php 
				
				if($row_productos['medida']=="Kg") 
				echo "<option value='Kg'>Kg</option>
				      <option value='ml'>ml</option>
                      <option value='Litros'>Litros</option>
                      <option value='cm3'>cm3</option>
					  <option value='Toneladas'>Toneladas</option>
				";
				if($row_productos['medida']=="ml") 
				echo "<option value='ml'>ml</option>
				 	  <option value='Kg'>Kg</option>
                      <option value='Litros'>Litros</option>
                      <option value='cm3'>cm3</option>
					   <option value='Toneladas'>Toneladas</option>
				";
				if($row_productos['medida']=="Litros") 
				echo "<option value='Litros'>Litros</option>
				      <option value='Kg'>Kg</option>
				      <option value='ml'>ml</option>
                      <option value='cm3'>cm3</option>
					   <option value='Toneladas'>Toneladas</option>
				";
				if($row_productos['medida']=="cm3") 
				echo " <option value='cm3'>cm3</option>
				       <option value='Kg'>Kg</option>
				       <option value='ml'>ml</option>
                       <option value='Litros'>Litros</option>
					    <option value='Toneladas'>Toneladas</option>
				";
				if($row_productos['medida']=="" or $row_productos['medida']=="-") 
				echo " <option value='cm3'>cm3</option>
				       <option value='Kg'>Kg</option>
				       <option value='ml'>ml</option>
                       <option value='Litros'>Litros</option>
					    <option value='Toneladas'>Toneladas</option>
				";
				if($row_productos['medida']=="Toneladas") 
				echo "  <option value='Toneladas'>Toneladas</option>
				       <option value='cm3'>cm3</option>
				       <option value='Kg'>Kg</option>
				       <option value='ml'>ml</option>
                       <option value='Litros'>Litros</option>
					  
				";
				?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Periodo de Cosecha :</div></td>
      <td><span class="Estilo1">
        <select name="tiempo" class="Estilo1" id="tiempo">
          <?php  
				
				if($row_productos['tiempo']=="A&ntilde;o") 
				echo "<option value='A&ntilde;o'>A&ntilde;o</option>
                    <option value='Meses'>Meses</option>
                    <option value='Semanas'>Semanas</option>
                    <option value='Dias'>Dias</option>";
					
					if($row_productos['tiempo']=="Meses") 
				echo " <option value='Meses'>Meses</option>
				    <option value='A&ntilde;o'>A&ntilde;o</option>
                    <option value='Semanas'>Semanas</option>
                    <option value='Dias'>Dias</option>";
					
					if($row_productos['tiempo']=="Semanas") 
				echo " <option value='Semanas'>Semanas</option>
				    <option value='A&ntilde;o'>A&ntilde;o</option>
                    <option value='Meses'>Meses</option>
                    <option value='Dias'>Dias</option>";
					
					if($row_productos['tiempo']=="Dias") 
				echo "<option value='Dias'>Dias</option>
					<option value='A&ntilde;o'>A&ntilde;o</option>
                    <option value='Meses'>Meses</option>
                    <option value='Semanas'>Semanas</option>";
					
					if($row_productos['tiempo']=="" or $row_productos['tiempo']=="-" ) 
				echo "<option value='Dias'>Dias</option>
					<option value='A&ntilde;o'>A&ntilde;o</option>
                    <option value='Meses'>Meses</option>
                    <option value='Semanas'>Semanas</option>";
					
					?>
        </select>
        <input name="tiempo2" type="text" class="Estilo1" id="tiempo2" value="<?php echo $row_productos['tiempo2']; ?>" size="3" maxlength="3" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Cantidad Estimada el Producto:</div></td>
      <td><input name="cantidad" type="text" class="Estilo1" value="<?php echo $row_productos['cantidad']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Costo de la Unidad </div></td>
      <td><span class="Estilo1">
        <input name="costo" type="text" class="Estilo1" value="<?php echo $row_productos['costo']; ?>" size="7" maxlength="7" />
        Bs</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">&Aacute;rea de cultivo o de pesca /  Tama&ntilde;o del reba&ntilde;o</div></td>
      <td><input name="area" type="text" class="Estilo1" value="<?php echo $row_productos['area']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Capacidad Instalada:</div></td>
      <td><input name="instalada" type="text" class="Estilo1" value="<?php echo $row_productos['instalada']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Capacidad de Procesamiento: </div></td>
      <td><input name="procesamiento" type="text" class="Estilo1" value="<?php echo $row_productos['procesamiento']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left" class="Estilo1">Capacidad de Producci&oacute;n:</div></td>
      <td><input name="produccion" type="text" class="Estilo1" value="<?php echo $row_productos['produccion']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td height="30" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id" value="<?php echo $row_productos['id']; ?>" />
</form>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cooperativa);
?>
