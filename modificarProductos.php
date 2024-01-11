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



$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {


//seleccionar red desde la tabla productor
mysql_select_db($database_conexion, $conexion);
$query_productores2 = "SELECT * FROM productores where cedula=$_POST[productor]";
$productores2 = mysql_query($query_productores2, $conexion) or die(mysql_error());
$row_productores2 = mysql_fetch_assoc($productores2);
$totalRows_productores2 = mysql_num_rows($productores2);

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
					   GetSQLValueString($row_productores2['id_red'], "int"),
					   GetSQLValueString($_POST['tiempo2'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php?valor=pr3&link=link4' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=pr3&link=link4' </script>";
  exit;
  }
}

$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_productos = "SELECT * FROM productos where id=$id";
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);


//Fin del juego de registro

//consulta de productores

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores order by cedula asc";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificacion de Productos</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {	font-size: 24px;
	font-weight: bold;
}

-->
</style>
</head>
<script language="javascript">

function validar(){

		if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cedula').value)){
				alert('Solo puede ingresar numeros en para la cedula del Representante!!!');
				return false;
		   		}
				}
				
				if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('telefono').value)){
				alert('Solo puede ingresar numeros en para el telefono del Representante!!!');
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

				if(document.form1.distribucion.value==""){
						alert("Debe Ingresar como se Distribuye el Producto");
						return false;
				}

			
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre del Producto");
						return false;
				}
				if(document.form1.medida.value=="-"){
						alert("Debe Ingresar la Unidad de Medida del Producto");
						return false;
				}
				if(document.form1.tiempo.value==""){
						alert("Debe Ingresar la escala de Tiempo Estimado para la Produccion");
						return false;
				}
				if(document.form1.cantidad.value==""){
						alert("Debe Ingresar Cantidad de Produccion Estimada");
						return false;
				}
				
					   
				if(document.form1.costo.value==""){
						alert("Debe Ingresar el Costo del Producto");
						return false;
				}
				
					if(document.form1.area.value==""){
						alert("Debe ingresar el Área de cultivo o de pesca / Tamaño del rebaño");
						return false;
				}
					if(document.form1.instalada.value==""){
						alert("Debe ingresar la capacidad instalada");
						return false;
				}
					if(document.form1.produccion.value==""){
						alert("Debe ingersar la produccion");
						return false;
				}
			
			
		}
</script>
<body>
<p align="center" class="Estilo4"><span class="Estilo3">Modificar Prodcutos </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form2" id="form2">
  <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><span class="Estilo1">Productor</span></td>
      <td><span class="Estilo1">
        <select name="productor" class="Estilo1" id="productor">
          <?php
do {  

if($row_productores["cedula"]==$row_productos["id_productor"]){ ?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores ['cedula']." ".$row_productores['nombre']."  ".$row_productores['apellido'];?></option>
          <? }//fin del if 
		
		else{
		if($row_productores["cedula"] != $row_productos["id_productor"]){
		?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['cedula']." ".$row_productores['nombre']."  ".$row_productores['apellido'];?></option>
          <? }}//fin del else ?>
          <?php
} while ($row_productores = mysql_fetch_assoc($productores));
  $rows = mysql_num_rows($productores);
  if($rows > 0) {
      mysql_data_seek($productores, 0);
	  $row_productores = mysql_fetch_assoc($productores);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="291" align="right" nowrap="nowrap"><span class="Estilo1">Distribucion o Comercializacion:</span></td>
      <td width="233"><input name="distribucion" type="text" class="Estilo1" value="<?php echo $row_productos['distribucion']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Nombre del Producto:</span></td>
      <td><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_productos['nombre']; ?>" size="32" maxlength="3o" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Unidad Productiva :</span></td>
      <td><span class="Estilo1">
        <select name="medida" class="Estilo1" id="medida">
          <?php 
				
				if($row_productos['medida']=="Kg") 
				echo "<option value=Kg>Kg</option>
				      <option value=ml>ml</option>
                      <option value=Litros>Litros</option>
                      <option value=cm3>cm3</option>
					  <option value=Toneladas>Toneladas</option>
				";
				if($row_productos['medida']=="ml") 
				echo "<option value=ml>ml</option>
				 	  <option value=Kg>Kg</option>
                      <option value=Litros>Litros</option>
                      <option value=cm3>cm3</option>
					   <option value=Toneladas>Toneladas</option>
				";
				if($row_productos['medida']=="Litros") 
				echo "<option value=Litros>Litros</option>
				      <option value=Kg>Kg</option>
				      <option value=ml>ml</option>
                      <option value=cm3>cm3</option>
					   <option value=Toneladas>Toneladas</option>
				";
				if($row_productos['medida']=="cm3") 
				echo " <option value=cm3>cm3</option>
				       <option value=Kg>Kg</option>
				       <option value=ml>ml</option>
                       <option value=Litros>Litros</option>
					    <option value=Toneladas>Toneladas</option>
				";
				if($row_productos['medida']=="" or $row_productos['medida']=="-") 
				echo " <option value=cm3>cm3</option>
				       <option value=Kg>Kg</option>
				       <option value=ml>ml</option>
                       <option value=Litros>Litros</option>
					    <option value=Toneladas>Toneladas</option>
				";
				if($row_productos['medida']=="Toneladas") 
				echo "  <option value=Toneladas>Toneladas</option>
				       <option value=cm3>cm3</option>
				       <option value=Kg>Kg</option>
				       <option value=ml>ml</option>
                       <option value=Litros>Litros</option>
					  
				";
				?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Periodo de Cosecha :</span></td>
      <td><span class="Estilo1">
        <select name="tiempo" class="Estilo1" id="tiempo">
          <?php  
				
				if($row_productos['tiempo']=="A&ntilde;o") 
				echo "<option value=A&ntilde;o>A&ntilde;o</option>
                    <option value=Meses>Meses</option>
                    <option value=Semanas>Semanas</option>
                    <option value=Dias>Dias</option>";
					
					if($row_productos['tiempo']=="Meses") 
				echo " <option value=Meses>Meses</option>
				    <option value=A&ntilde;o>A&ntilde;o</option>
                    <option value=Semanas>Semanas</option>
                    <option value=Dias>Dias</option>";
					
					if($row_productos['tiempo']=="Semanas") 
				echo " <option value=Semanas>Semanas</option>
				    <option value=A&ntilde;o>A&ntilde;o</option>
                    <option value=Meses>Meses</option>
                    <option value=Dias>Dias</option>";
					
					if($row_productos['tiempo']=="Dias") 
				echo "<option value=Dias>Dias</option>
					<option value=A&ntilde;o>A&ntilde;o</option>
                    <option value=Meses>Meses</option>
                    <option value=Semanas>Semanas</option>";
					
					if($row_productos['tiempo']=="" or $row_productos['tiempo']=="-" ) 
				echo "<option value=Dias>Dias</option>
					<option value=A&ntilde;o>A&ntilde;o</option>
                    <option value=Meses>Meses</option>
                    <option value=Semanas>Semanas</option>";
					
					?>
        </select>
        <input name="tiempo2" type="text" class="Estilo1" id="tiempo2" value="<?php echo $row_productos['tiempo2']; ?>" size="3" maxlength="3" />
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Cantidad Estimada el Producto:</span></td>
      <td><input name="cantidad" type="text" class="Estilo1" value="<?php echo $row_productos['cantidad']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Costo de la Unidad </span></td>
      <td><span class="Estilo1">
        <input name="costo" type="text" class="Estilo1" value="<?php echo $row_productos['costo']; ?>" size="7" maxlength="7" />
        Bs</span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">&Aacute;rea de cultivo o de pesca /  Tama&ntilde;o del reba&ntilde;o</span></td>
      <td><input name="area" type="text" class="Estilo1" value="<?php echo $row_productos['area']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Capacidad Instalada:</span></td>
      <td><input name="instalada" type="text" class="Estilo1" value="<?php echo $row_productos['instalada']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Capacidad de Procesamiento: </span></td>
      <td><input name="procesamiento" type="text" class="Estilo1" value="<?php echo $row_productos['procesamiento']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><span class="Estilo1">Capacidad de Producci&oacute;n:</span></td>
      <td><input name="produccion" type="text" class="Estilo1" value="<?php echo $row_productos['produccion']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td height="30" colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form2" />
  <input type="hidden" name="id" value="<?php echo $row_productos['id']; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productos);
?>