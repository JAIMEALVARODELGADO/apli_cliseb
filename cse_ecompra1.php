<!-- Captura de parametros para la edicion de las compras -->
<HTML>
<head>
<title>Edicion de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function atras(){
  window.open("cse_fondo.html","fr03");
}
function buscar(){
  document.form1.submit();
}
</script>

</head>
<body>
<?
include("funciones.php");
conectarbd();
?>
<form name='form1' method='post' action='cse_ecompra11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros Editar Compras</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='10%' align='right'>Identificación:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25'><a href='#' onclick='buscar()'></td>
	<td class='Td2' width='10%' align='right'>Orden:</td>
	<td class='Td2' width='30%' align='left'><select name='orden'>
	    <option value='co.ndoc_com'>Nro de Documento
		<option value='co.loca_com'>Local
	    <option value='cl.apel_cli'>Apellidos
		<option value='cl.nomb_cli'>Nombres
		<option value='cl.nrod_cli'>Identificación
	  </select>
	</td>
  </tr>
   <tr>
	<td class='Td2' width='10%' align='right'>Local:</td>
	<td class='Td2' width='10%' align='left'><select name='loca_com'>
	<option value=''>
	<?
	  $consultado=mysql_query("SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_gru='03'");
	  while($rowdo=mysql_fetch_array($consultado)){
	    echo "<option value='$rowdo[codi_tip]'>$rowdo[valo_tip] ".substr($rowdo[desc_tip],0,15);
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Documento:</td>
    <td class='Td2' width='10%' align='left'><select name='tdoc_com'>
	<option value=''>
	<?
	  $consultado=mysql_query("SELECT codi_tip,desc_tip FROM tipo WHERE codi_gru='02'");
	  while($rowdo=mysql_fetch_array($consultado)){
	    echo "<option value='$rowdo[codi_tip]'>$rowdo[desc_tip]";
	  }
	?>
	</select>
	</td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='ndoc_com' size='6' maxlength='6'><a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a></td>
  </tr>
</table>

</form>
</body>
</HTML>