<?php require_once('Connections/conexion.php'); ?>
<?php

//llenar los listas
$redes=$_GET["redes"];




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
 if($row_regicur["productor"]==$_GET['productores'] and $row_regicur ["curso"]==$_GET['cursos']){
  echo "<script type=\"text/javascript\">alert ('Este Productor ya esta registrado en este curso');  location.href='sistemenus.php?valor=ac1&link=link5&redes=$redes' </script>";
 exit;

}
} while ($row_regicur = mysql_fetch_assoc($regicur));

  $updateSQL = sprintf("INSERT INTO regicur(curso, productor) VALUES (%s, %s)",
                       GetSQLValueString($_GET['cursos'], "int"),
                       GetSQLValueString($_GET['productores'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('El productor fue Agregado al curso');    	location.href='sistemenus.php?&valor=ac1&link=link5&redes=$redes' </script>";
    exit;
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?&valor=ac1&link=link5&redes=$redes' </script>";
  exit;
  }
}




mysql_select_db($database_conexion, $conexion);
$query_productores = "SELECT * FROM productores where id_red='$redes' order by cedula asc";
$productores = mysql_query($query_productores, $conexion) or die(mysql_error());
$row_productores = mysql_fetch_assoc($productores);
$totalRows_productores = mysql_num_rows($productores);

mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);




//verificar si existen productores Registrados
if($totalRows_productores==0){
echo"<script type=\"text/javascript\">alert ('No Existen Productores Registrados en esta Red'); location.href='sistemenus.php?valor=p1&link=link2' </script>";
exit;
}

//verificar si existen pCursos Registrados
if($totalRows_cursos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Registrados'); location.href='sistemenus.php?valor=cr1&link=link5&redes=$redes' </script>";
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

				if(document.form1.productores.value=="-"){
						alert("Debe seleccionar un Productor");
						return false;
				}
			    if(document.form1.cursos.value=="-"){
						alert("Debe seleccionar un curso");
						return false;
				}
			
		}

</script>
<body>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="<?php echo $editFormAction; ?>">
  <p align="center"><span class="Estilo9">Agregar  Productores a Cursos</span></p>
  <table width="379" height="119" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><div align="center" class="Estilo5">Seleccione un Productor y el Curso que Realizara </div></th>
    </tr>
    <tr>
      <th width="103" height="21" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo5">Productores</div></th>
      <td width="272" bgcolor="#FFFFFF"><span class="Estilo5">
        <label>
        <select name="productores" class="Estilo5" id="Productores">
          <option value="-" <?php if (!(strcmp("-", $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Productor</option>
          <?php
do {  
?>
          <option value="<?php echo $row_productores['cedula']?>"<?php if (!(strcmp($row_productores['cedula'], $row_productores['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_productores['cedula']." ".$row_productores['nombre']."  ".$row_productores['apellido'];?></option>
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
      <th height="30" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo5">Cursos</div></th>
      <td bgcolor="#FFFFFF"><span class="Estilo5">
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
    <input type="hidden" name="redes" value="<? echo $redes; ?>" />
  <input type="hidden" name="valor" value="ac1" />
  <input type="hidden" name="link" value="link5" />
</form>
</body>
</html>

