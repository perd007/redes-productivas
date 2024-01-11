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
mysql_select_db($database_conexion, $conexion);
$query_redes = "SELECT * FROM redes";
$redes = mysql_query($query_redes, $conexion) or die(mysql_error());
$row_redes = mysql_fetch_assoc($redes);
$totalRows_redes = mysql_num_rows($redes);

if($totalRows_redes==0){
 echo "<script type=\"text/javascript\">alert ('No existen Redes Registradas');  location.href='sistemenus.php' </script>";
  exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
<!--
.Estilo1 {font-size: 18px;

}
.Estilo2 {
	font-size: 24px;
	font-weight: bold;
}
.Estilo4 {font-size: 18px;
	font-weight: bold;
}

-->
</style>
</head>
<script>
    marcado=false;
    function pepote(f){
    if(!marcado){
    alert("Por favor, marque una casilla");
    return false;
    }
    else{
	if(document.form1.redes.value=="-"){
	alert("Debe seleccionar una Red");
	return false;
	}
				
    return true;
    }
    }
    
	


		
				

    </script> 
<body>
<p align="center"><span class="Estilo5 Estilo2">Registro de Productividad </span></p>
<form id="form1" name="form1" method="get" onsubmit="return pepote(this)" action="sistemenus.php">
  <table width="379" height="159" border="0" align="center" cellspacing="0">
    <tr>
      <th height="21" colspan="2" bgcolor="#FF0000" scope="row"><div align="center" class="Estilo1">Seleccione una Red </div></th>
    </tr>
    <tr>
      <th width="122" height="30" scope="row"><div align="right" class="Estilo1">Redes</div></th>
      <td width="247"><span class="Estilo1">
        <select name="redes" class="Estilo1" id="redes" >
          <option value="-" <?php if (!(strcmp("-", $row_redes['nombre']))) {echo "selected=\"selected\"";} ?>>Seleccione Una Red</option>
          <?php
do {  
?>
          <option value="<?php echo $row_redes['id']?>"<?php if (!(strcmp($row_redes['id'], $row_redes['nombre']))) {echo "selected=\"selected\"";} ?>><?php echo $row_redes['nombre']?></option>
          <?php
} while ($row_redes = mysql_fetch_assoc($redes));
  $rows = mysql_num_rows($redes);
  if($rows > 0) {
      mysql_data_seek($redes, 0);
	  $row_redes = mysql_fetch_assoc($redes);
  }
?>
        </select>
      </span></td>
    </tr>
    <tr>
      <th height="30" colspan="2" scope="row">&nbsp;</th>
    </tr>
    <tr>
      <th height="30" colspan="2" scope="row"> <span class="Estilo1">
        <label> Productores
		<span class="Estilo1">
        <input name="tipo" type="radio" class="Estilo1" onclick="marcado=true" value="productores" />
		</span>
        Cooperativas
		<span class="Estilo1">
        </span>		</label>
        <input name="tipo" type="radio" onclick="marcado=true" class="Estilo1" value="cooperativas" />
      </span></th>
    </tr>
    <tr>
      <th height="26" colspan="2" scope="row"><span class="Estilo1">
        <label>
        <input name="Submit" type="submit" class="Estilo1" value="Siguiente" />
        </label>
      </span></th>
    </tr>
    <tr>
      <th height="22" bgcolor="#FF0000" scope="row"><span class="Estilo1"></span></th>
      <td bgcolor="#FF0000"><span class="Estilo1"></span></td>
    </tr>
  </table>
  <input type="hidden" name="valor" value="pr41" />
   <input type="hidden" name="link" value="link4" />
</form>
<p></p>
</body>
</html>
<?php
mysql_free_result($redes);
?>
