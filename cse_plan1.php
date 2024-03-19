<!-- Plan de premios -->
<HTML>
<head>
<title>Plan de Premios</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
  document.form1.submit();
}
function borrar(codi_pre,desc_pre){
  if(confirm("Desea eliminar el premio:\n"+desc_pre)){
    window.open("cse_plan13.php?codi_pre="+codi_pre,"fr03");
  }
//cse_plan13.php?codi_pre=$rowpre[codi_pre]
}
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.fsor_ppm.value == "") { a += " Fecha del sorteo\n";}
	if (document.form1.nota_ppm.value == "") { a += " Nota para el sorteo\n";}
    if (a != "") 
    { alert(error + a);return true;}
document.form1.submit()
}
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_plan14.php'>
<table class='Tbl0'>
  <tr><td class='Td0' align='center'>Plan de Premios</td></tr>
</table>
<br>
<?
$consultappm=mysql_query("SELECT codi_ppm,fsor_ppm,nota_ppm FROM plan_premio");
$rowppm=mysql_fetch_array($consultappm);
?>
<table class='Tbl0' border='0'>
  <tr>
	<td class='Td2' width='20%' align='right'>Fecha del Sorteo:</td>
	<td class='Td2'><input type='text' name='fsor_ppm' size='10' maxlength='10' value='<?echo cambiafechadmy($rowppm[fsor_ppm]);?>'></td>
  </tr>
  <tr>
	<td class='Td2' width='20%' align='right'>Nota Para el Sorteo:</td>
	<td class='Td2'><input type='text' name='nota_ppm' size='110' maxlength='200' value='<?echo $rowppm[nota_ppm];?>'>
	<a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Guardar'></a>
	</td>
  </tr>
</table>
<table class='Tbl0' border='0'>
  <th class='Th0' width='10%' colspan='3'>Opciones</th>
  <th class='Th0' width='90%'>Descripción</th>
  <?
  $consultapre=mysql_query("SELECT codi_pre,desc_pre FROM premio WHERE codi_ppm='$rowppm[codi_ppm]'");
  while($rowpre=mysql_fetch_array($consultapre)){
	echo "<tr>";
	echo "<td class='Td2'><a href='cse_plan12.php?codi_pre=$rowpre[codi_pre]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></a></td>";
	echo "<td class='Td2'><a href='cse_plan11.php?codi_pre=$rowpre[codi_pre]'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Nuevo'></a></td>";
	echo "<td class='Td2'><a href='#' onclick='borrar(\"$rowpre[codi_pre]\",\"$rowpre[desc_pre]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Borrar'></a></td>";
	echo "<td class='Td2'>$rowpre[desc_pre]</td>";
	echo "</tr>";
  }
  ?>  
</table>
<br>
<table class='Tbl0'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='cse_plan11.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='cse_plan11.php'>Nuevo</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?
mysql_close();
?>
</body>
</HTML>