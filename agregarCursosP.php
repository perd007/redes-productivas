<?php require_once('Connections/conexion.php'); 

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET["MM_insert"])) && ($_GET["MM_insert"] == "form1")) {


mysql_select_db($database_conexion, $conexion);
$query_regicur = "SELECT * FROM regicur ";
$regicur = mysql_query($query_regicur, $conexion) or die(mysql_error());
$row_regicur = mysql_fetch_assoc($regicur);
$totalRows_regicur = mysql_num_rows($regicur);

do{
 if($row_regicur["personal"]==$_GET['cedula'] and $row_regicur["curso"]==$_GET['cursos']){
  echo "<script type=\"text/javascript\">alert ('Esta Persona ya esta registrada en este curso');  location.href='sistemenus.php?valor=cr6&link=link5' </script>";
 exit;
}
} while ($row_regicur = mysql_fetch_assoc($regicur));

mysql_select_db($database_conexion, $conexion);
$query_regicur2 = "SELECT * FROM regicur2 ";
$regicur2 = mysql_query($query_regicur2, $conexion) or die(mysql_error());
$row_regicur2 = mysql_fetch_assoc($regicur2);
$totalRows_regicur2 = mysql_num_rows($regicur2);

if($row_regicur2["cedula"]!=$_GET['cedula']){


  $insertSQL = sprintf("INSERT INTO regicur2 (cedula, nombre, sexo, apellido, provenencia) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_GET['cedula'], "int"),
                       GetSQLValueString($_GET['nombre'], "text"),
					   GetSQLValueString($_GET['sexo'], "text"),
                       GetSQLValueString($_GET['apellido'], "text"),
                       GetSQLValueString($_GET['provenencia'], "text") );
					   

 $updateSQL = sprintf("INSERT INTO regicur(curso, personal) VALUES (%s, %s)",
                       GetSQLValueString($_GET['cursos'], "int"),
                       GetSQLValueString($_GET['cedula'], "int"));
					   
					   
		  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   
   if($Result1 and $Result2 ){
  echo "<script type=\"text/javascript\">alert ('Agregado al curso'); location.href='sistemenus.php?valor=cr6&link=link5' </script>";
    exit;
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=cr6&link=link5' </script>";
  exit;
  }		
  
  	   
}else{
if($row_regicur2["cedula"]==$_GET['cedula']){

$updateSQL = sprintf("INSERT INTO regicur(curso, personal) VALUES (%s, %s)",
                       GetSQLValueString($_GET['cursos'], "int"),
                       GetSQLValueString($_GET['cedula'], "int"));
					   
					   
		  mysql_select_db($database_conexion, $conexion);
  
   $Result2 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   
   if($Result2 ){
  echo "<script type=\"text/javascript\">alert ('Agregado al curso'); location.href='sistemenus.php?valor=cr6&link=link5' </script>";
    exit;
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?valor=cr6&link=link5' </script>";
  exit;
  }	
  
  }//fin del if interno	
}	  //fin del else externo

 
}






mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);





//verificar si existen pCursos Registrados
if($totalRows_cursos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Registrados'); location.href='sistemenus.php?valor=cr6&link=link5' </script>";
exit;
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Cursos</title>
<style type="text/css">
<!--
.Estilo5 {font-size: 18px; }
.Estilo9 {	font-size: 24px;
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
				alert('Solo puede ingresar numeros en para la cedula!!!');
				return false;
		   		}
				}
				if(document.form1.cedula.value==""){
						alert("Debe ingresaruna cedula");
						return false;
				}
				if(document.form1.cedula.value==""){
						alert("Debe ingresar una cedula");
						return false;
				}
				if(document.form1.nombre.value==""){
						alert("Debe ingresar un nombre");
						return false;
				}
				if(document.form1.apellido.value==""){
						alert("Debe ingresar un apellido");
						return false;
				}
			    if(document.form1.provenencia.value==""){
						alert("Debe ingresar el lugar de donde proveiene la persona");
						return false;
				}
			
		}

</script>
<body>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <p align="center"><span class="Estilo9">Agregar  Personal a Cursos</span></p>
  <table width="379" height="169" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo5">Seleccione  el Curso que Realizara </div></th>
    </tr>
    <tr>
      <th width="103" height="30" bgcolor="#FFFFFF" class="Estilo5" scope="row"><div align="left" class="Estilo5">Cursos</div></th>
      <td width="272" bgcolor="#FFFFFF"><span class="Estilo5">
        <select name="cursos" class="Estilo5" id="cursos">
          <option value="-" <?php if (!(strcmp("-", $row_cursos['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Curso </option>
          <?php
do {  
?>
          <option value="<?php echo $row_cursos['id_curso']?>"<?php if (!(strcmp($row_cursos['id_curso'], $row_cursos['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cursos['nombre']?></option>
          <?php
} while ($row_cursos = mysql_fetch_assoc($cursos));
  $rows = mysql_num_rows($cursos);
  if($rows > 0) {
      mysql_data_seek($cursos, 0);
	  $row_cursos = mysql_fetch_assoc($cursos);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Cedula:</strong></div></td>
      <td><input name="cedula" type="text" class="Estilo5" id="cedula" value="" size="10" maxlength="8" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Nombre:</strong></div></td>
      <td><input name="nombre" type="text" class="Estilo5" value="" size="32" maxlength="20" /></td>
    </tr>
    
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Apellido:</strong></div></td>
      <td><input name="apellido" type="text" class="Estilo5" value="" size="32" maxlength="20" /></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Sexo:</strong></div></td>
      <td><select name="sexo" class="Estilo5" id="sexo">
        <option value="Masculino">Masculino</option>
        <option value="Femenino">Femenino</option>
      </select></td>
    </tr>
    <tr valign="baseline">
      <td align="right" nowrap="nowrap" class="Estilo5"><div align="left"><strong>Procedencia:</strong></div></td>
      <td><input name="provenencia" type="text" class="Estilo5" value="" size="50" maxlength="50" /></td>
    </tr>
    
    
    <tr>
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo5">
        <label>
        <input type="submit" name="Submit" value="A&ntilde;adir" />
        </label>
      </span></th>
    </tr>
  </table>
  <p>&nbsp;</p>
   <input type="hidden" name="MM_insert" value="form1" />
     <input type="hidden" name="valor" value="cr6" />
  <input type="hidden" name="link" value="link5" />

</form>

<p>&nbsp;</p>
</body>
</html>

