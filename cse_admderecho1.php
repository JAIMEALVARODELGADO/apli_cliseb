<!-- Captura de parametros para administracion del menu -->
<HTML>
<head>
<title>Administración del Menú</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
var error='';
if(document.form1.codi_ucs.value==''){error='Usuario del Sistema\n';}
if(document.form1.codi_gru.value==''){error+='Opción\n';}
if(error!=''){
  alert("Para buscar debe seleccionar la siguiente Información\n\n"+error);
  return;
}
document.form1.submit();
}
</script>
</head>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
<body>
<form name='form1' method='post' action='cse_admderecho11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros para Asignar Derechos</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='20%' align='right'>Usuario del Sistema:</td>
	<td class='Td2' width='30%' align='left'><select name='codi_ucs'>
	  <option value=''>
	  <?
	    $consultaus=mysql_query("SELECT codi_ucs,nomb_ucs FROM u_cliseb WHERE esta_ucs='A' ORDER BY nomb_ucs");
        while($rowus=mysql_fetch_array($consultaus)){
		  echo "<option value=$rowus[codi_ucs]>$rowus[nomb_ucs]";
		}
	  ?>
	  </select>
	</td>
	<td class='Td2' width='20%' align='right'>Opción:</td>
	<td class='Td2' width='30%' align='left'><select name='codi_gru'>
	  <option value=''>
	  <?
	    $consultame=mysql_query("SELECT codi_men,desc_men FROM menu WHERE nive_men='1'");
        while($rowme=mysql_fetch_array($consultame)){
		  echo "<option value=$rowme[codi_men]>$rowme[desc_men]";
		}
	  ?>
	  </select>	  
	  <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
</table>
<?
mysql_free_result($consultaus);
mysql_close();
?>
</form>
</body>
</HTML>