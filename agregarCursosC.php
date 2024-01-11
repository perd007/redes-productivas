<?php require_once('Connections/conexion.php'); ?>
<?php
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
 if($row_regicur["cooperativa"]==$_GET['cooperativa'] and $row_regicur ["curso"]==$_GET['cursos']){
  echo "<script type=\"text/javascript\">alert ('Esta Cooperativa ya esta registrado en este curso');  location.href='sistemenus.php?valor=acc1&link=link5&redes=$redes' </script>";
   exit;

}
} while ($row_regicur = mysql_fetch_assoc($regicur));

  $updateSQL = sprintf("INSERT INTO regicur(curso, cooperativa) VALUES (%s, %s)",
                       GetSQLValueString($_GET['cursos'], "int"),
                       GetSQLValueString($_GET['cooperativa'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('La cooperativa fue Agregado al curso');  location.href='sistemenus.php?&valor=acc1&link=link5&redes=$redes' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php?&valor=acc1&link=link5&redes=$redes'  </script>";
  exit;
  }
}



mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);

mysql_select_db($database_conexion, $conexion);
$query_cooperativas = "SELECT * FROM cooperatva where red='$redes'";
$cooperativas = mysql_query($query_cooperativas, $conexion) or die(mysql_error());
$row_cooperativas = mysql_fetch_assoc($cooperativas);
$totalRows_cooperativas = mysql_num_rows($cooperativas);

//verificar si existen productores Registrados
if($totalRows_cooperativas==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cooperativas Registrados'); location.href='sistemenus.php?&valor=acc1&link=link5&redes=$redes' </script>";
exit;
}

//verificar si existen pCursos Registrados
if($totalRows_cursos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Registrados'); location.href='sistemenus.php?&valor=acc1&link=link5&redes=$redes' </script>";
exit;
}



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de Cursos paralas Cooperativas</title>
<style type="text/css">
<!--

.Estilo6 {font-size: 18px}
.Estilo9 {	font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<script language="javascript">
function validar(){

				if(document.form1.cooperativa.value=="-"){
						alert("Debe seleccionar una Cooperativa");
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
  <p align="center"><span class="Estilo9">Agregar  Cooperativas a Cursos</span></p>
  <table width="428" height="119" border="1" align="center" cellspacing="0" bordercolor="#000000">
    <tr>
      <th height="21" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo6">Seleccione un Productor y el Curso que Realizara </span></th>
    </tr>
    <tr>
      <th width="110" height="21" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo6">Cooperativas</div></th>
      <td width="308" bgcolor="#FFFFFF"><span class="Estilo6">
        <label>
        <select name="cooperativa" class="Estilo6" id="cooperativa">
          <option value="-" <?php if (!(strcmp("-", $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione una Cooperativa</option>
          <?php
do {  
?>
          <option value="<?php echo $row_cooperativas['rif']?>"<?php if (!(strcmp($row_cooperativas['rif'], $row_cooperativas['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cooperativas['nombre']?></option>
          <?php
} while ($row_cooperativas = mysql_fetch_assoc($cooperativas));
  $rows = mysql_num_rows($cooperativas);
  if($rows > 0) {
      mysql_data_seek($cooperativas, 0);
	  $row_cooperativas = mysql_fetch_assoc($cooperativas);
  }
?>
        </select>
        </label>
      </span></td>
    </tr>
    <tr>
      <th height="30" bgcolor="#FFFFFF" scope="row"><div align="left" class="Estilo6">Cursos</div></th>
      <td bgcolor="#FFFFFF"><span class="Estilo6">
        <select name="cursos" class="Estilo6" id="cursos">
          <option value="-" <?php if (!(strcmp("-", $row_cursos['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione un Curso</option>
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
      <th height="26" colspan="2" bgcolor="#FFFFFF" scope="row"><span class="Estilo6">
        <label>
        <input name="Submit" type="submit" class="Estilo6" value="A&ntilde;adir" />
        </label>
      </span></th>
    </tr>
  </table>
  <p>&nbsp;</p>
   <input type="hidden" name="MM_insert" value="form1" />
   <input type="hidden" name="redes" value="<? echo $redes; ?>" />
  <input type="hidden" name="valor" value="acc1" />
  <input type="hidden" name="link" value="link5" />
</form>
</body>
</html>
<?php
mysql_free_result($cooperativas);
?>
