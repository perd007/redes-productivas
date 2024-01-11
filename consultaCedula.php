<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 18px}
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

			
				if(document.form1.cedula.value=="-"){
						alert("Debe Ingresar una Cedula");
						return false;
				}
			
			
		}
</script>
<body>
<form id="form1" name="form1" onsubmit="return validar()" method="get" action="sistemenus.php">
  <table width="379" height="98" border="0" align="center" cellspacing="0">
    <tr>
      <th height="21" colspan="2" bgcolor="#FF0000" scope="row"><span class="Estilo1">Ingrese la cedula del Productor</span></th>
    </tr>
    <tr>
      <th width="122" height="30" scope="row"><div align="right" class="Estilo1">Cedula</div></th>
      <td width="247"><label>
        <input name="cedula" type="text" id="cedula" maxlength="8" />
      </label></td>
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
      <td bgcolor="#FF0000">&nbsp;</td>
    </tr>
  </table>
  <input type="hidden" name="valor" value="dpr" />
  <input type="hidden" name="link" value="link2" />
  <input type="hidden" name="otro" value="principal" />
  
</form>
</body>
</html>