<?php require_once('Connections/conexion.php'); ?>
<?php 
//validar usuario
if($validacion==true){
	if($reg==0){
	echo "<script type=\"text/javascript\">alert ('Usted no posee permisos para realizar Registros'); location.href='sistemenus.php' </script>";
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

//seleccionar red desde la tabla productor
mysql_select_db($database_conexion, $conexion);
$query_productores2 = "SELECT * FROM productores where cedula=$_POST[productor]";
$productores2 = mysql_query($query_productores2, $conexion) or die(mysql_error());
$row_productores2 = mysql_fetch_assoc($productores2);
$totalRows_productores2 = mysql_num_rows($productores2);

  $insertSQL = sprintf("INSERT INTO productos (distribucion, nombre, medida, tiempo,id_productor,cantidad, costo, area, instalada, produccion, procesamiento, red, tiempo2) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['distribucion'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['medida'], "text"),
                       GetSQLValueString($_POST['tiempo'], "text"),
					   GetSQLValueString($_POST['productor'], "int"),
                       GetSQLValueString($_POST['cantidad'], "int"),
					   GetSQLValueString($_POST['costo'], "int"),
					   GetSQLValueString($_POST['area'], "text"),
					   GetSQLValueString($_POST['instalada'], "text"),
					   GetSQLValueString($_POST['produccion'], "text"),
					   GetSQLValueString($_POST['procesamiento'], "text"),
					   GetSQLValueString($row_productores2['id_red'], "int"),
					   GetSQLValueString($_POST['tiempo2'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php' </script>";
  exit;
  }
}

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores order by cedula asc";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);



if($totalRows_productores==0){
echo"<script type=\"text/javascript\">alert ('No Existen Productores Regsitrados'); location.href='sistemenus.php' </script>";
exit;
}
?>
<html >
<head>
<title>Registro de Produccion de la Redes</title>

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
				if(document.form1.productor.value=="-"){
						alert("Debe seleccionar un productor");
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
<form method="post" name="form1" onSubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <p align="center" class="Estilo4 Estilo2">Registro de Produccion de Productores </p>
  <table border="0" align="center" cellspacing="0" bordercolor="#FF0000" bgcolor="#FF0000">
    <tr valign="baseline">
      <td width="351" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Productores</div></td>
      <td width="303" bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <select name="productor" class="Estilo1" id="productor">
          <option value="0" <?php if (!(strcmp(0, $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Productor</option>
          <?php
do {  
?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores ['cedula']." ".$row_productores['nombre']."  ".$row_productores['apellido'];?></option>
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
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Distribucion o Comercializacion:</div></td>
      <td bgcolor="#FFFFFF"><input name="distribucion" type="text" class="Estilo1" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Nombre del Producto:</div></td>
      <td bgcolor="#FFFFFF"><input name="nombre" type="text" class="Estilo1" value="" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Unidad Productiva:</div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <select name="medida" class="Estilo1" id="medida">
          <option value="-">-</option>
          <option value="Toneladas">Toneladas</option>
          <option value="Kg">Kg</option>
          <option value="ml">ml</option>
          <option value="Litros">Litros</option>
          <option value="cm3">cm3</option>
        </select>
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td height="26" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Periodo de Cosecha:</div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <select name="tiempo" class="Estilo1" id="tiempo">
          <option value="-">-</option>
          <option value="A&ntilde;o">A&ntilde;o</option>
          <option value="Meses">Meses</option>
          <option value="Semanas">Semanas</option>
          <option value="Dias">Dias</option>
        </select>
        <input name="tiempo2" type="text" class="Estilo1" id="tiempo2" size="3" maxlength="3">
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Cantidad Estimada el Producto:</div></td>
      <td bgcolor="#FFFFFF"><input name="cantidad" type="text" class="Estilo1" id="cantidad" value="" size="10" maxlength="6" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Costo de la Unidad </div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <input name="costo" type="text" class="Estilo1" id="costo" size="7" maxlength="7">
        Bs</label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">&Aacute;rea de cultivo o de pesca /  Tama&ntilde;o del reba&ntilde;o </div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <input name="area" type="text" class="Estilo1" id="area" value="" size="32" maxlength="100">
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Capacidad Instalada: </div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <input name="instalada" type="text" class="Estilo1" id="instalada" size="32" maxlength="100">
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Capacidad de Procesamiento: </div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <input name="procesamiento" type="text" class="Estilo1" id="procesamiento" size="32" maxlength="100">
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="left" class="Estilo1">Capacidad de Producci&oacute;n: </div></td>
      <td bgcolor="#FFFFFF"><span class="Estilo1">
        <label>
        <input name="produccion" type="text" class="Estilo1" id="produccion" size="32" maxlength="100">
        </label>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap" bgcolor="#FFFFFF"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="A&ntilde;adir Producto" />
      </div></td>
    </tr>
  </table>
  <p>
    <input type="hidden" name="MM_insert" value="form1">
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

