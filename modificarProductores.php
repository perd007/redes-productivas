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

//verificar si se actualiza la red a la qu pertenece el productor



if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	$Cdd=$_POST['cod'];
	
	
if($_POST['consu']==1){
	$consu="valor=p2";
	
}
if($_POST['consu']==2){

	$consu="valor=p22&redes=".$Cdd."";

}



if($_POST['redes']==0){
$valor=$_POST["id_red"];
$valor2=$_POST["id_red2"];
$valor3=$_POST["id_red3"];
$valor4=$_POST["id_red4"];
}else{
$valor=$_POST['redes'];
$valor2=$_POST["redes2"];
$valor3=$_POST["redes3"];
$valor4=$_POST["redes4"];
}

	
	if($_POST["redes"]==$_POST["redes2"] or $_POST["redes"]==$_POST["redes3"] or $_POST ["redes"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la primera');  location.href='sistemenus.php?valor=mpr&link=link2&cedula=$_POST[cedula2]' </script>";
  exit;
}
if($_POST["redes2"]!=""){
if($_POST["redes2"]==$_POST["redes"] or $_POST["redes2"]==$_POST["redes3"] or $_POST ["redes2"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la segunda');  location.href='sistemenus.php?valor=mpr&link=link2&cedula=$_POST[cedula2]' </script>";
  exit;
}}
if($_POST["redes3"]!=""){
if($_POST["redes3"]==$_POST["redes2"] or $_POST["redes3"]==$_POST["redes"] or $_POST ["redes3"]==$_POST["redes4"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la tercera');  location.href='sistemenus.php?valor=mpr&link=link2&cedula=$_POST[cedula2]' </script>";
  exit;
}}
if($_POST["redes4"]!=""){
if($_POST["redes4"]==$_POST["redes2"] or $_POST["redes4"]==$_POST["redes3"] or $_POST ["redes4"]==$_POST["redes"]){
	echo "<script type=\"text/javascript\">alert ('Hay otra Red Igual a la cuarta');  location.href='sistemenus.php?valor=mpr&link=link2&cedula=$_POST[cedula2]' </script>";
  exit;
}}
	
  $updateSQL = sprintf("UPDATE productores SET cedula=%s, nombre=%s, apellido=%s, direccion=%s, telefono=%s, correo=%s, empresa=%s, estudio=%s, etnia=%s, ingreso=%s, localidad=%s, miembros=%s, terreno=%s, vivienda=%s, esposa=%s, edad=%s, edadEsp=%s, estuEsp=%s, municipio=%s, parroquia=%s, norte=%s, sur=%s, id_red=%s, id_red2=%s, id_red3=%s, id_red4=%s, sexo=%s WHERE cedula=%s",
                       GetSQLValueString($_POST['cedula'], "int"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['empresa'], "text"),
                       GetSQLValueString($_POST['estudio'], "text"),
                       GetSQLValueString($_POST['etnia'], "text"),
                       GetSQLValueString($_POST['ingreso'], "double"),
                       GetSQLValueString($_POST['localidad'], "text"),
                       GetSQLValueString($_POST['miembros'], "int"),
                       GetSQLValueString($_POST['terreno'], "text"),
                       GetSQLValueString($_POST['vivienda'], "text"),
                       GetSQLValueString($_POST['esposa'], "text"),
                       GetSQLValueString($_POST['edad'], "int"),
                       GetSQLValueString($_POST['edadEsp'], "int"),
                       GetSQLValueString($_POST['estuEsp'], "text"),
                       GetSQLValueString($_POST['municipio'], "text"),
                       GetSQLValueString($_POST['parroquia'], "text"),
                       GetSQLValueString($_POST['norte'], "text"),
                       GetSQLValueString($_POST['sur'], "text"), 
					   GetSQLValueString($valor,"int"),
					   GetSQLValueString($valor2,"int"),
					   GetSQLValueString($valor3,"int"),
					   GetSQLValueString($valor4,"int"),
					    GetSQLValueString($_POST['sexo'], "text"), 
                       GetSQLValueString($_POST['cedula2'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
  if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados'); location.href='sistemenus.php?link=link2&$consu' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?link=link2&$consu' </script>";
  exit;
  }
}



$cedula=$_GET["cedula"];
 $consulta=$_GET["consu"];

//en caso de que sea de consulta por red
$codigo=$_GET["codigo"];

mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where cedula=$cedula";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

//consulta de redes
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

//consulta de redes N° 2
mysql_select_db($database_conexion, $conexion);
$query_redes2 = "SELECT id, nombre FROM redes  ";
$redes2 = mysql_query($query_redes2, $conexion) or die(mysql_error());
$row_redes2 = mysql_fetch_assoc($redes2);

//consulta de redes N° 3
mysql_select_db($database_conexion, $conexion);
$query_redes3 = "SELECT id, nombre FROM redes ";
$redes3 = mysql_query($query_redes3, $conexion) or die(mysql_error());
$row_redes3 = mysql_fetch_assoc($redes3);

//consulta de redes N° 4
mysql_select_db($database_conexion, $conexion);
$query_redes4 = "SELECT id, nombre FROM redes ";
$redes4 = mysql_query($query_redes4, $conexion) or die(mysql_error());
$row_redes4 = mysql_fetch_assoc($redes4);

//consulta de redes N° 3
mysql_select_db($database_conexion, $conexion);
$query_redes5 = "SELECT id, nombre FROM redes  ";
$redes5 = mysql_query($query_redes5, $conexion) or die(mysql_error());
$row_redes5 = mysql_fetch_assoc($redes5);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificar Datos de los Productores</title>
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
		if(document.form1.cedula.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('cedula').value)){
				alert('Solo puede ingresar numeros en para la cedula del Productor!!!');
				return false;
		   		}
				}
				
				if(document.form1.telefono.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('telefono').value)){
				alert('Solo puede ingresar numeros en para el telefono del Productor!!!');
				return false;
		   		}
				}
				
	
				
			
				if(document.form1.nombre.value=="-"){
						alert("Debe Ingresar el Nombre del Productor");
						return false;
				}
			
				if(document.form1.direccion.value==""){
						alert("Debe Ingresar la direccion del Productor");
						return false;
				}
			
				if(document.form1.apellido.value==""){
						alert("Debe Ingresar el Apellido del Productor");
						return false;
				}
				if(document.form1.cedula.value==""){
						alert("Debe Ingresar La Cedula del Productor");
						return false;
				}
		
			
				if(document.form1.municipio.value=="-"){
						alert("Debe Seleccioner un municipio");
						return false;
				}
				if(document.form1.parroqiua.value==""){
						
				
				
				
				
			
		}
</script>
<body>
<p align="center"><span class="Estilo4 Estilo2">Modificar Productores </span></p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1" onsubmit="return validar()">
  <table align="center">
    
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>Seleccione Nueva red:</strong> </span></div></td>
      <td><span class="Estilo1">
      <select name="redes" class="Estilo1" id="redes">
          <?php
do {  

if($row_redes2['id']==$row_productores["id_red"]){ ?>
          <option value="<?php echo $row_redes2['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes2['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes2['id'] != $row_productores["id_red"]){
		?>
          <option value="<?php echo $row_redes2['id']?>"<?php if (!(strcmp($row_redes2['id'], $row_redes2['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes2['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes2 = mysql_fetch_assoc($redes2));
  $rows = mysql_num_rows($redes2);
  if($rows > 0) {
      mysql_data_seek($redes2, 0);
	  $row_redes2 = mysql_fetch_assoc($redes2);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>Seleccione Nueva red:</strong> </span></div></td>
      <td><span class="Estilo1">
        <select name="redes2" class="Estilo1" id="redes2">
       
          <?php
		  if($row_productores["id_red2"]!=0){//ifuno
do {  

if($row_redes3['id']==$row_productores["id_red2"]){ ?>
          <option value="<?php echo $row_redes3['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes3['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes3['id'] != $row_productores["id_red2"]){
		?> 
          <option value="<?php echo $row_redes3['id']?>"<?php if (!(strcmp($row_redes3['id'], $row_redes3['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes3['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes3 = mysql_fetch_assoc($redes3));
  $rows = mysql_num_rows($redes3);
  if($rows > 0) {
      mysql_data_seek($redes3, 0);
	  $row_redes3 = mysql_fetch_assoc($redes3);
  }
		  }//ifn uno
		  else{ ?>
			  <option value="">-</option>
			  <? do {  

if($row_redes3['id']==$row_productores["id_red2"]){ ?>
          <option value="<?php echo $row_redes3['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes3['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes3['id'] != $row_productores["id_red2"]){
		?> 
          <option value="<?php echo $row_redes3['id']?>"<?php if (!(strcmp($row_redes3['id'], $row_redes3['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes3['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes3 = mysql_fetch_assoc($redes3));
  $rows = mysql_num_rows($redes3);
  if($rows > 0) {
      mysql_data_seek($redes3, 0);
	  $row_redes3 = mysql_fetch_assoc($redes3);
  }
  
  }//else
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>Seleccione Nueva red:</strong> </span></div></td>
      <td><span class="Estilo1">
        <select name="redes3" class="Estilo1" id="redes3">
          <?php
		   if($row_productores["id_red3"]!=0){ //ifuno 
do {  

if($row_redes4['id']==$row_productores["id_red3"]){ ?>
          <option value="<?php echo $row_redes4['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes4['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes4['id'] != $row_productores["id_red3"]){
		?>
          <option value="<?php echo $row_redes4['id']?>"<?php if (!(strcmp($row_redes4['id'], $row_redes4['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes4['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes4 = mysql_fetch_assoc($redes4));
  $rows = mysql_num_rows($redes4);
  if($rows > 0) {
      mysql_data_seek($redes4, 0);
	  $row_redes4 = mysql_fetch_assoc($redes4);
  }
 }// if uno
 else{ ?>
	 <option value="">-</option>
	 <? do {  

if($row_redes4['id']==$row_productores["id_red3"]){ ?>
          <option value="<?php echo $row_redes4['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes4['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes4['id'] != $row_productores["id_red3"]){
		?>
          <option value="<?php echo $row_redes4['id']?>"<?php if (!(strcmp($row_redes4['id'], $row_redes4['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes4['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes4 = mysql_fetch_assoc($redes4));
  $rows = mysql_num_rows($redes4);
  if($rows > 0) {
      mysql_data_seek($redes4, 0);
	  $row_redes4 = mysql_fetch_assoc($redes4);
  }
	 }//fin else
 
 
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><span class="Estilo1"><strong>Seleccione Nueva red:</strong> </span></div></td>
      <td><span class="Estilo1">
        <select name="redes4" class="Estilo1" id="redes4"> 
          <?php
		   if($row_productores["id_red4"]!=0){ 
do {  

if($row_redes5['id']==$row_productores["id_red4"]){ ?>
          <option value="<?php echo $row_redes5['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes5['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes5['id'] != $row_productores["id_red"]){
		?>
          <option value="<?php echo $row_redes5['id']?>"<?php if (!(strcmp($row_redes5['id'], $row_redes5['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes5['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes5 = mysql_fetch_assoc($redes5));
  $rows = mysql_num_rows($redes5);
  if($rows > 0) {
      mysql_data_seek($redes5, 0);
	  $row_redes5 = mysql_fetch_assoc($redes5);
  }
  
		   }//fin del if
		   else{ ?>
           <option value="">-</option>
			  <? do {  

if($row_redes5['id']==$row_productores["id_red4"]){ ?>
          <option value="<?php echo $row_redes5['id']?>"<?php if (!(strcmp(0, 0))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes5['nombre'];?></option>
          <? }//fin del if 
		
		else{
		if($row_redes5['id'] != $row_productores["id_red"]){
		?>
          <option value="<?php echo $row_redes5['id']?>"<?php if (!(strcmp($row_redes5['id'], $row_redes5['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes5['nombre'];?></option>
         
          <? }}//fin del else ?>
          <?php
} while ($row_redes5 = mysql_fetch_assoc($redes5));
  $rows = mysql_num_rows($redes5);
  if($rows > 0) {
      mysql_data_seek($redes5, 0);
	  $row_redes5 = mysql_fetch_assoc($redes5);
  }
			   
			   
			   }//fin del else
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td width="243" align="right" ><div align="right" class="Estilo1">
        <div align="left"><strong>Cedula:</strong></div>
      </div></td>
      <td width="464"><input name="cedula" type="text" class="Estilo1" id="cedula" value="<?php echo $row_productores['cedula']; ?>" size="32" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Nombre del Productor:</strong></div>
      </div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="<?php echo $row_productores['nombre']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Apellido del Productor:</strong></div>
      </div></td>
      <td><input name="apellido" type="text" class="Estilo1" value="<?php echo $row_productores['apellido']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Edad:</strong></div>
      </div></td>
      <td><input name="edad" type="text" class="Estilo1" value="<?php echo $row_productores['edad']; ?>" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Sexo:</strong></span></div></td>
      <td><span class="Estilo1">
        <select name="sexo" class="Estilo1" id="sexo">
          <?php  
				
				if($row_productores['sexo']=="Masculino")
				echo " 
                <option value=Masculino>Masculino</option>
                <option value=Femenino>Femenino</option>
				";
				
				if($row_productores['sexo']=="Femenino")
				echo " 
				<option value=Femenino>Femenino</option>
                <option value=Masculino>Masculino</option>
                ";
				?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Direccion del Productor:</strong></div>
      </div></td>
      <td><span class="Estilo1">
        <textarea name="direccion" cols="32" class="Estilo1"><?php echo $row_productores['direccion']; ?></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Telefono del Productor:</strong></div>
      </div></td>
      <td><input name="telefono" type="text" class="Estilo1" id="telefono" value="<?php echo $row_productores['telefono']; ?>" size="32" maxlength="11" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Correo del Productor:</strong></div>
      </div></td>
      <td><input name="correo" type="text" class="Estilo1" value="<?php echo $row_productores['correo']; ?>" size="32" maxlength="100" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Nombre de la Empresa: </strong></div>
      </div></td>
      <td><input name="empresa" type="text" class="Estilo1" value="<?php echo $row_productores['empresa']; ?>" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Nivel de Estudio :</strong></div>
      </div></td>
      <td><input name="estudio" type="text" class="Estilo1" value="<?php echo $row_productores['estudio']; ?>" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Grupo Etnico:</strong></div>
      </div></td>
      <td><input name="etnia" type="text" class="Estilo1" value="<?php echo $row_productores['etnia']; ?>" size="32" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Municipio:</strong></span></div></td>
      <td><span class="Estilo1">
      <select name="municipio" class="Estilo1" id="municipio">
          <?php  
				
				if($row_productores['municipio']=="Alto_Orinoco")
				echo " 
                <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atabapo'>Atabapo</option>
          <option value='Atures'>Atures</option>
          <option value='Autana'>Autana</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Maroa'>Maroa</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
				";
				
				if($row_productores['municipio']=="Atabapo")
				echo " 
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atures'>Atures</option>
          <option value='Autana'>Autana</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Maroa'>Maroa</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
                ";
				if($row_productores['municipio']=="Atures")
				echo " 
				 <option value='Atures'>Atures</option>
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Autana'>Autana</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Maroa'>Maroa</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
                ";
				if($row_productores['municipio']=="Autana")
				echo " 
				<option value='Autana'>Autana</option>
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atures'>Atures</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Maroa'>Maroa</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
                ";
				if($row_productores['municipio']=="Manapiare")
				echo "
				<option value='Manapiare'>Manapiare</option>
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atures'>Atures</option>
          <option value='Autana'>Autana</option>
          <option value='Maroa'>Maroa</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
                ";
				if($row_productores['municipio']=="Maroa")
				echo " 
				<option value='Maroa'>Maroa</option>
		  <option value='Autana'>Autana</option>
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atures'>Atures</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Rio_Negro'>R&iacute;o Negro</option>
                ";
				if($row_productores['municipio']=="Rio_Negro")
				echo " 
				 <option value='Rio_Negro'>R&iacute;o Negro</option>
				<option value='Autana'>Autana</option>
          <option value='Atabapo'>Atabapo</option>
		  <option value='Alto_Orinoco'>Alto Orinoco</option>
          <option value='Atures'>Atures</option>
          <option value='Manapiare'>Manapiare</option>
          <option value='Maroa'>Maroa</option>
         
                ";
				?>
        </select>
     
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Parroquia:</strong></span></div></td>
      <td><input name="parroquia" type="text" class="Estilo1" value="<?php echo $row_productores['parroquia']; ?>" size="32" maxlength="30" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo1"><strong>Coordenadas del Productor:</strong></span></div></td>
      <td><span class="Estilo1"><strong>Norte</strong>
          <input name="norte" type="text" class="Estilo1" value="<?php echo $row_productores['norte']; ?>" size="25" maxlength="100" />
          <strong>Sur</strong>
          <input name="sur" type="text" class="Estilo1" value="<?php echo $row_productores['sur']; ?>" size="25" maxlength="100" />
      </span></td>
    </tr>
    <tr valign="baseline" bgcolor="#FF0000">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <div align="center"><strong>Datos de la Familia </strong></div>
      </div></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Ingresos Mensuales :</strong></div>
      </div></td>
      <td><input name="ingreso" type="text" class="Estilo1" value="<?php echo $row_productores['ingreso']; ?>" size="10" maxlength="7" /></td>
    </tr>
    <tr valign="baseline">
      <td height="38" align="right" nowrap="nowrap"><div align="right" class="Estilo1">
        <div align="left"><strong>Localidad donde viven:</strong></div>
      </div></td>
      <td><span class="Estilo1">
        <textarea name="localidad" cols="32" class="Estilo1"><?php echo $row_productores['localidad']; ?></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>N&ordm; de Miembros :</strong></div>
      </div></td>
      <td><input name="miembros" type="text" class="Estilo1" value="<?php echo $row_productores['miembros']; ?>" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Terreno donde se Ubican:</strong></div>
      </div></td>
      <td><span class="Estilo1">
        <textarea name="terreno" cols="32" class="Estilo1"><?php echo $row_productores['terreno']; ?></textarea>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Tipo de Vivienda:</strong></div>
      </div></td>
      <td><input name="vivienda" type="text" class="Estilo1" value="<?php echo $row_productores['vivienda']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Nombre del Esposo o Esposa: </strong></div>
      </div></td>
      <td><input name="esposa" type="text" class="Estilo1" value="<?php echo $row_productores['esposa']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Edad del Esposo o Esaposa:</strong></div>
      </div></td>
      <td><input name="edadEsp" type="text" class="Estilo1" value="<?php echo $row_productores['edadEsp']; ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="right" class="Estilo1">
        <div align="left"><strong>Nivel de Estudio de la Parajea: </strong></div>
      </div></td>
      <td><input name="estuEsp" type="text" class="Estilo1" value="<?php echo $row_productores['estuEsp']; ?>" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo1">
        <input name="submit" type="submit" class="Estilo1" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="cedula2" value="<?php echo $row_productores['cedula']; ?>" />
  <input type="hidden" name="id_red" value="<?php echo $row_productores['id_red']; ?>" />
  <input type="hidden" name="id_red2" value="<?php echo $row_productores['id_red2']; ?>" />
  <input type="hidden" name="id_red3" value="<?php echo $row_productores['id_red3']; ?>" />
  <input type="hidden" name="id_red4" value="<?php echo $row_productores['id_red4']; ?>" />
  <input type="hidden" name="consu" value="<?php echo $consulta; ?>" />
   <input type="hidden" name="cod" value="<?php echo $codigo; ?>" />
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($productores);
?>
