<!-- Edita Entidad -->
<HTML>
<head>
<title>Edicion de Entidad</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function atras(){
  window.open("cse_blank.html","fr03");
}
function guarda(){
  form1.submit();
}
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_enti11.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Entidad</td></tr>
</table>
<br><br><br><br><br>
<?
$consulta=mysql_query("SELECT nit_ent,nomb_ent,valxb_ent FROM entidad");
$row=mysql_fetch_array($consulta);
?>

<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='15%' align='right'>Nit:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='nit_ent' size='12' maxlength='12' value='<?echo $row[nit_ent];?>'></td>
	<td class='Td2' width='15%' align='right'>Nombre:</td>
    <td class='Td2' width='25%' align='left'><input type='text' name='nomb_ent' size='50' maxlength='50' value='<?echo $row[nomb_ent];?>'></td>
	<td class='Td2' width='20%' align='right'>Valor para cada boleta:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='valxb_ent' size='5' maxlength='5' value='<?echo $row[valxb_ent];?>'></td>
  </tr>
</table>
<br>
<table class='Tb0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='guarda()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Guardar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='guarda()'>Guardar</a></td>
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