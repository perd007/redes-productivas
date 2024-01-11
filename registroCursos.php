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



//funcion para invertir fecha 
function fechaes($fecha) {
 return implode("/", array_reverse(explode("/", $fecha)));
} 

  
  
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

mysql_select_db($database_conexion, $conexion);
$query_cursos = "SELECT * FROM cursos";
$cursos = mysql_query($query_cursos, $conexion) or die(mysql_error());
$row_cursos = mysql_fetch_assoc($cursos);
$totalRows_cursos = mysql_num_rows($cursos);

do{
 if($row_cursos["nombre"]==$_POST['nombre'] ){
  echo "<script type=\"text/javascript\">alert ('Ya existe un curso con el mismo nombre. Cambie el nombre');  location.href='sistemenus.php?valor=cr1&link=link5' </script>";
  exit;
  }

} while ($row_cursos = mysql_fetch_assoc($cursos));

  $insertSQL = sprintf("INSERT INTO cursos (id_curso, tipo, estado, facilitador, fecha, nombre, horas) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_curso'], "int"),
                       GetSQLValueString($_POST['tipo'], "text"),
                       GetSQLValueString($_POST['estado'], "text"),
                       GetSQLValueString($_POST['facilitador'], "text"),
                       GetSQLValueString(fechaes($_POST['fecha']), "date"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['horas'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());
   if($Result1){
  echo "<script type=\"text/javascript\">alert ('Datos Guardados');  location.href='sistemenus.php' </script>";
  }else{
  echo "<script type=\"text/javascript\">alert ('Ocurrio un Error');  location.href='sistemenus.php' </script>";
  exit;
  }
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Registro de Cursos</title>
<style type="text/css">
<!--
.Estilo1 {
	font-size: 18px;
}
.Estilo3 {
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
		
//verificar fecha
 
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
<p align="center" class="Estilo5  Estilo3">Registro de Cursos </p>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1"  onsubmit="return validar()">
  <table align="center">
    <tr valign="baseline">
      <td align="right" nowrap="nowrap"><div align="left"><strong><span class="Estilo1">Nombre del Curso </span></strong></div></td>
      <td><input name="nombre" type="text" class="Estilo1" value="" size="40" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td width="192" align="right" nowrap="nowrap"><div align="left"><strong><span class="Estilo1">Tipo:</span></strong></div></td>
      <td width="400"><label>
        <select name="tipo" class="Estilo1" id="tipo">
          <option value="-">-</option>
          <option value="Asistencia Tecnica Inicial">Asistencia Tecnica Inicial</option>
          <option value="Consolidacion de la Red">Consolidacion de la Red</option>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><strong><span class="Estilo1">Estado de Ejecucion:</span></strong></div></td>
      <td><label>
        <select name="estado" class="Estilo1" id="estado">
          <option value="Por Ejecutar">Por Ejecutar</option>
          <option value="Ejecutado">Ejecutado</option>
        </select>
      </label></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><strong><span class="Estilo1">Facilitador:</span></strong></div></td>
      <td><input name="facilitador" type="text" class="Estilo1" value="" size="50" maxlength="40" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><strong><span class="Estilo1">Fecha del Curso:</span></strong></div></td>
      <td><input name="fecha" type="text" class="Estilo1" onchange='fechas(this.value); this.value=borrar' value="" size="10" maxlength="10" />
        Ej .20/10/1988 </td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right"><div align="left"><strong><span class="Estilo1">Horas de Duracion:</span></strong></div></td>
      <td><input name="horas" type="text" class="Estilo1" id="horas" value="" size="3" maxlength="2" /></td>
    </tr>
    <tr valign="baseline">
      <td colspan="2" align="right" nowrap="nowrap"><div align="center">
        <input name="submit" type="submit" class="Estilo1" value="Guardar" />
      </div></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<p></p>
</body>
</html>

