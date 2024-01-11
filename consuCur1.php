<?php require_once('Connections/conexion.php'); ?>
<?php
mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);

//verificar si existen cursos Registrados
if($totalRows_cursos==0){
echo"<script type=\"text/javascript\">alert ('No Existen Cursos Registrados'); location.href='registroCursos.php' </script>";
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
				if(document.form1.cursos.value=="-"){
						alert("Debe seleccionar un curso");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo5 Estilo2">Consulta de Participacion de Cursos</span></p>
<form id="form1" name="form1" onsubmit="return validar()" method="get" action="sistemenus.php">
  <table width="379" height="98" border="0" align="center" cellspacing="0">
    <tr>
      <th height="21" colspan="2" bgcolor="#FF0000" scope="row"><span class="Estilo1">Seleccione   el Curso para Consultar </span></th>
    </tr>
    <tr>
      <th width="122" height="30" scope="row"><div align="right" class="Estilo1">Cursos</div></th>
      <td width="247"><span class="Estilo1">
        <select name="cursos" class="Estilo1" id="cursos">
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
      <th height="26" colspan="2" scope="row"><span class="Estilo1">
        <label>
        <input type="submit" name="Submit" value="Siguiente" />
        </label>
      </span></th>
    </tr>
    <tr>
      <th height="21" bgcolor="#FF0000" scope="row"><span class="Estilo1"></span></th>
      <td bgcolor="#FF0000"><span class="Estilo1"></span></td>
    </tr>
  </table>
   <input type="hidden" name="valor" value="cc1" />
  <input type="hidden" name="link" value="link5" />
</form>
<p></p>
</body>
</html>
<?php
mysql_free_result($cursos);
?>
