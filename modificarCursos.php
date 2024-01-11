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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

mysql_select_db($database_conexion, $conexion);
$query_cursos1 = "SELECT * FROM cursos";
$cursos1 = mysql_query($query_cursos1, $conexion) or die(mysql_error());
$row_cursos1 = mysql_fetch_assoc($cursos1);
$totalRows_cursos1 = mysql_num_rows($cursos1);

do{
 if($row_cursos1["nombre"]==$_POST['nombre'] and $row_cursos1["id_curso"]!=$_POST['id_curso'] ){
  echo "<script type=\"text/javascript\">alert ('Ya existe un curso con el mismo nombre. Cambie el nombre');  location.href='sistemenus.php?valor=cr1&link=link5' </script>";
exit;
}
} while ($row_cursos1 = mysql_fetch_assoc($cursos1));

  $updateSQL = sprintf("UPDATE cursos SET tipo=%s, estado=%s, facilitador=%s, fecha=%s, nombre=%s, horas=%s WHERE id_curso=%s",
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['facilitador'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['horas'], "int"),
                       GetSQLValueString($_POST['id_curso'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Modificados');  location.href='sistemenus.php?valor=cr11&link=link5' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  llocation.href='sistemenus.php?valor=cr11&link=link5' </script>";
  exit;
  }
}
$id=$_GET["id"];
mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos where id_curso=$id";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Modificacion de Cursos</title>
<style type="text/css">
<!--

.Estilo2 {font-size: 18px}
.Estilo5 {font-size: 18px; font-weight: bold; }
.Estilo6 {
	font-size: 24px;
	font-weight: bold;
}


-->
</style>
</head>
<script language="javascript">
function validar(){
		if(document.form1.horas.value!=""){
			 var filtro = /^(\d)+$/i;
		   if (!filtro.test(document.getElementById('horas').value)){
				alert('Solo puede ingresar numeros en la hora!!!');
				return false;
		   		}
				}
	
				if(document.form1.nombre.value==""){
						alert("Debe Ingresar el Nombre del Productor");
						return false;
				}
			
				if(document.form1.tipo.value=="-"){
						alert("Debe Seleccionar el tipo de Curso");
						return false;
				}
				
				if(document.form1.estado.value=="-"){
						alert("Debe el Estado de Ejecucion del Curso");
						return false;
				}
				if(document.form1.facilitador.value==""){
						alert("Debe Ingresar el Nombre del Facilitador");
						return false;
				}
				if(document.form1.fecha.value==""){
						alert("Debe Ingresar la Fecha en que se Realizara o Realizo el Curso");
						return false;
				}
				if(document.form1.horas.value==""){
						alert("Debe Ingresar la Cantidad de Horas del Curso");
						return false;
				}
			
			
		}
		
		function fechas(caja)

{ 

   if (caja)

   {  

      borrar = caja;

      if ((caja.substr(2,1) == "/") && (caja.substr(5,1) == "/"))

      {      

         for (i=0; i<10; i++)

             {  

            if (((caja.substr(i,1)<"0") || (caja.substr(i,1)>"9")) && (i != 2) && (i != 5))

                        {

               borrar = '';

               break;  

                        }  

         }

             if (borrar)

             { 

                a = caja.substr(6,4);

                    m = caja.substr(3,2);

                    d = caja.substr(0,2);

                    if((a < 1900) || (a > 2050) || (m < 1) || (m > 12) || (d < 1) || (d > 31))

                       borrar = '';

                    else

                    {

                       if((a%4 != 0) && (m == 2) && (d > 28))      

                          borrar = ''; // Año no viciesto y es febrero y el dia es mayor a 28

                           else 

                           {

                          if ((((m == 4) || (m == 6) || (m == 9) || (m==11)) && (d>30)) || ((m==2) && (d>29)))

                                 borrar = '';                                            

                           }  // else

                    } // fin else

         } // if (error)

      } // if ((caja.substr(2,1) == "/") && (caja.substr(5,1) == "/"))                                          

          else

             borrar = '';

          if (borrar == '')

             alert('Fecha erronea');

   } // if (caja)   

} // FUNCION
               
</script>
<body>
<p align="center" class="Estilo6">Modificar  Cursos</p>
<form action="<?php echo $editFormAction; ?>" method="post" onsubmit="return validar()" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td width="196" align="right" nowrap="nowrap"><div align="left"><span class="Estilo5">Tipo de Curso: </span></div></td>
      <td width="318"><span class="Estilo2">
        <select name="tipo" class="Estilo2" id="tipo">
          <? 
				if($row_cursos['tipo']=="Asistencia Tecnica Inicial")
				echo "
                <option value='Asistencia Tecnica Inicial'>Asistencia Tecnica Inicial</option>
                <option value='Consolidacion de la Red'>Consolidacion de la Red</option>
				";
				if($row_cursos['tipo']=="Consolidacion de la Red")
				echo "
				 <option value='Consolidacion de la Red'>Consolidacion de la Red</option>
                <option value='Asistencia Tecnica Inicial'>Asistencia Tecnica Inicial</option>
				";
				?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Estado de Ejecucion:</strong></span></div></td>
      <td><span class="Estilo2">
        <select name="estado" class="Estilo2" id="estado">
          <? 
				if($row_cursos['estado']=="Por Ejecutar")
				echo "
                <option value='Por Ejecutar'>Por Ejecutar</option>
                <option value='Ejecutado'>Ejecutado</option>
				";
				if($row_cursos['estado']=="Ejecutado")
				echo "
				<option value='Ejecutado'>Ejecutado</option>
				<option value='Por Ejecutar'>Por Ejecutar</option>
				";
				?>
        </select>
      </span></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Facilitador:</strong></span></div></td>
      <td><input name="facilitador" type="text" class="Estilo2" value="<?php echo $row_cursos['facilitador']; ?>" size="50" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Fecha del Curso:</strong></span></div></td>
      <td><input name="fecha" type="text" class="Estilo2" onchange='fechas(this.value); this.value=borrar' value="<?php echo $row_cursos['fecha']; ?>" size="10" maxlength="10" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Nombre del Curso:</strong></span></div></td>
      <td><input name="nombre" type="text" class="Estilo2" value="<?php echo $row_cursos['nombre']; ?>" size="40" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><span class="Estilo2"><strong>Horas de Duracion:</strong></span></div></td>
      <td><input name="horas" type="text" class="Estilo2" id="horas" value="<?php echo $row_cursos['horas']; ?>" size="2" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center" class="Estilo2">
        <input name="submit" type="submit" class="Estilo2" value="Modificar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="id_curso" value="<?php echo $row_cursos['id_curso']; ?>" />
</form>
<p></p>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($cursos);
?>
