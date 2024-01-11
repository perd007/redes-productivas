<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
.Estilo3 {font-size: 24px;
	font-weight: bold;
}
-->
</style>
</head>
<script language="javascript">
function validar(){
				if(document.form1.municipio.value==0){
						alert("Debe seleccionar un municipio");
						return false;
				}
			
			
		}

</script>
<body>
<p align="center"><span class="Estilo3">Listados de Cooperativas por Municipio</span></p>
<form id="form1" name="form1" method="get" onsubmit="return validar()" action="sistemenus.php">
  <table width="337" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr bgcolor="#FF0000">
      <th colspan="2" scope="col"><span class="Estilo1">Escoja un Municipio </span></th>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td width="117"><span class="Estilo1"><strong>Municipio:</strong></span></td>
      <td width="220"><span class="Estilo1">
        <select name="municipio" class="Estilo1" id="municipio" >
          <option value="0">-</option>
          <option value="Alto_Orinoco">Alto Orinoco</option>
          <option value="Atabapo">Atabapo</option>
          <option value="Atures">Atures</option>
          <option value="Autana">Autana</option>
          <option value="Manapiare">Manapiare</option>
          <option value="Maroa">Maroa</option>
          <option value="Rio_Negro">R&iacute;o Negro</option>
        </select>
      </span></td>
    </tr>
    <tr bgcolor="#FF0000">
      <td colspan="2" bgcolor="#FF0000"><span class="Estilo1">
        <label> </label>
        </span>
        <div align="center" class="Estilo1">
            <input name="Submit" type="submit" class="Estilo1" value="Siguiente" />
        </div></td>
    </tr>
  </table>
   <input type="hidden" name="valor" value="lcm2" />
    <input type="hidden" name="link" value="link3" />
	
</form>
</body>
</html>
