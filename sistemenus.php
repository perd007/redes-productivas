<?php require_once('Connections/conexion.php');
include("login.php");

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema de Gestion para Redes Socialistas de Innovacion Productiva </title>
<style type="text/css">
<!--
body {
	margin-top: 0px;
}

.navegator{
margin-left:0%;
margin-right:7%;
}

.navenlace{
	font-weight:Arial;
	font-size:12px
	padding:1px;
	margin-top: 1px;
	margin-right:3px;
	margin-bottom: 1px;
	margin-left: 0px;
}

.navenlace a{
background-image:url(link1.jpg);
color:#00000;
text-decoration:none;
display:block;
width:0%;
height:0%;
}

.navenlace a:hover{
background-image:url(link2.jpg);
color:#ffffcc;
}

a {text-decoration: none;}
a:hover {text-decoration: underline;} 
.Estilo4 {color: #000000}





  
   
-->
</style>
</head>

<body alink= blue vlink= blue>
<table width="963" height="512" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="963" height="28" colspan="10" scope="col"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="856" height="227">
      <param name="movie" value="imagenes/Archivos flash/Banner 1.swf">
      <param name="quality" value="high">
      <embed src="imagenes/Archivos flash/Banner 1.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="856" height="227"></embed>
    </object></th>
  </tr>
  
  <tr>
    <td height="158" colspan="10"><table width="625" height="86" border="0" align="center">
        <tr>
          <td width="619" height="55"><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="619" height="83">
            <param name="movie" value="imagenes/Archivos flash/Botones Principales.swf">
            <param name="quality" value="high">
            <embed src="imagenes/Archivos flash/Botones Principales.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="619" height="83"></embed>
          </object>
            <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="32" height="32">
              <param name="movie" value="imagenes/Archivos flash/Intro Fundacite.swi">
              <param name="quality" value="high">
              <embed src="imagenes/Archivos flash/Intro Fundacite.swi" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="32" height="32"></embed>
          </object></td>
        </tr>
      </table>
   <? 
   $menu=$_GET["link"];

$valor=$_GET["valor"];

if($valor=="" and  $menu==""){
include("principal.php");
}

switch ($menu){
case "link1":
include("menuRedes.php");
break;
case "link2":
include("menuProductores.php");
break;
case "link3":
include("menuCooperativas.php");
break;
case "link4":
include("menuProductos.php");
break;
case "link5":
include("menuCursos.php");
break;
case "link6":
include("menuUsuarios.php");
break;
case "link7":
include("menuReportes.php");
break;
}

  ?>    </td>
  </tr>
  <tr>
    <td height="127" colspan="10">
	<? 
switch ($valor){
	case "r1":
	include("ingresoRedes.php");
	break;
	case "r2":
	include("consultaRedes.php");
	break;
	case "p1":
	include("registroProductores.php");
	break;
	case "p12":
	include("registroProductores2.php");
	break;
	case "p2":
	include("consultaProductores.php");
	break;
	case "p20":
	include("consultaCedula.php");
	break;
	case "p21":
	include("consultaProductoresRed1.php");
	break;
	case "p22":
	include("consultaProductoresRed.php");
	break;
	case "p3":
	include("listadoProductoresMunicipio1.php");
	break;
	case "p4":
	include("registroHijos.php");
	break;
	case "p5":
	include("consultarHijos.php");
	break;
	case "p6":
	include("estadisticaHijosR.php");
	break;
	case "p62":
	include("estadisticaHijosR2.php");
	break;
	case "p61":
	include("estadisticaHijos1.php");
	break;
	case "c1":
	include("registroCooperativa.php");
	break;
	case "c2":
	include("consultaCooperativa.php");
	break;
	case "c3":
	include("listadoCooperativaMunicipio1.php");
	break;
	case "c4":
	include("registroMiembros.php");
	break;
	case "c5":
	include("consultarMiembros.php");
	break;
	case "c51":
	include("consultarMiembros2.php");
	break;
	case "c6":
	include("estadisticaCooperativaMiembrosR.php");
	break;
	case "c61":
	include("estadisticaCooperativaMiembrosR2.php");
	break;
	case "pr1":
	include("registroProduccion.php");
	break;
	case "pr2":
	include("produccionCooperativa.php");
	break;
	case "pr3":
	include("consultaProductos.php");
	break;
	case "pr4":
	include("registroProductividad1.php");
	break;
	case "pr41":
	include("registroProductividad2.php");
	break;
	case "pr42":
	include("registroProductividad.php");
	break;
	case "pr5":
	include("consultaProductividad1.php");
	break;
	case "pr6":
	include("listadoProductosProductor.php");
	break;
	case "pr7":
	include("listadoProductosCooperativas.php");
	break;
	case "pr8":
	include("listadoProductosRed.php");
	break;
	case "cr1":
	include("registroCursos.php");
	break;
	case "cr2":
	include("consuCur1.php");
	break;
	case "cr11":
	include("consultarCurso.php");
	break;
	case "cr3":
	include("agregarCursosC1.php");
	break;
	case "cr4":
	include("agregarCursos1.php");
	break;
	case "cr5":
	include("consultaListadosCursos1.php");
	break;
	case "cr6":
	include("agregarCursosP.php");
	break;
	case "cr7":
	include("consultaPersonal.php");
	break;
	case "cr8":
	include("modificarPersonal.php");
	break;
	case "cr9":
	include("eliminarPersonal.php");
	break;
	case "u1":
	include("registroUsuario.php");
	break;
	case "u2":
	include("consultarUsuarios.php");
	break;
}
	

switch ($valor){
	case "mr":
	include("modificarRedes.php");
	break;
	case "mc":
	include("modificarCooperativa.php");
	break;
	case "mP":
	include("modificarProductos.php");
	break;
	case "mPC":
	include("modificarPC.php");
	break;
	case "mpr":
	include("modificarProductores.php");
	break;
	case "mp":
	include("modificarProductos.php");
	break;
	case "mpc":
	include("modificarPc.php");
	break;
	case "mpcA":
	include("modificarProductividad.php");
	break;
	case "mh":
	include("modificarhijos.php");
	break;
	case "mcr":
	include("modificarCursos.php");
	break;
	case "mm":
	include("modificarMiembros.php");
	break;
	case "mu":
	include("modificarUsuario.php");
	break;
}

switch ($valor){
	case "er":
	include("eliminarRed.php");
	break;
	case "ec":
	include("eliminarCooperativas.php");
	break;
	case "epr":
	include("eliminarProductores.php");
	break;
	case "ep":
	include("eliminarProducto.php");
	break;
	case "eh":
	include("eliminarHijos.php");
	break;
	case "ecr":
	include("eliminarCursos.php");
	break;
	case "em":
	include("eliminarMiembros.php");
	break;
	case "eu":
	include("eliminarUsuarios.php");
	break;
	
}

switch ($valor){
	case "dr":
	include("detallesRedes.php");
	break;
	case "dc":
	include("detalleCooperativa.php");
	break;
	case "dpr":
	include("detalleProductor.php");
	break;
	case "dp":
	include("detallesProductos.php");
	break;
	case "dh":
	include("detalleHijos.php");
	break;
	case "dm":
	include("detalleMiembro.php");
	break;

}


switch ($valor){
	case "clc":
	include("consultaListadosCursos2.php");
	break;
	case "clc2":
	include("consultaListadosCursos3.php");
	break;
	case "cpv1":
	include("consultaProductividad2.php");
	break;
	case "cpv2":
	include("consultaProductividad.php");
	break;
	case "ac1":
	include("agregarCursos.php");
	break;
	case "acc1":
	include("agregarCursosC.php");
	break;
	case "cc1":
	include("consuCur2.php");
	break;
	case "lcm2":
	include("listadoCooperativaMunicipio2.php");
	break;
	case "lpm2":
	include("listadoProductoresMunicipio2.php");
	break;
	case "lpc":
	include("listadoProductosCooperativas2.php");
	break;
	case "lpp":
	include("listadoProductosProductor2.php");
	break;
	case "lpr":
	include("listadoProductosRed2.php");
	break;
	case "rc":
	include("retirarCursos.php");
	break;
	case "rct":
	include("retirarTodosCursos.php");
	break;

}
	?></td>
  </tr>
  
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
