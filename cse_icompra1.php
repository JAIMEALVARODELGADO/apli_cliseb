<!-- Captura de parametros para el informe -->
<HTML>
<head>
<title>Informe de Comras</title>
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
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
<body>
<form name='form1' method='post' action='cse_icompra11.php' target='fr05'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Parámetros para el Informe de Compras</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='10%' align='right'>Identificación:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25'></td>
	<td class='Td2' width='10%' align='right'>Orden:</td>
	<td class='Td2' width='30%' align='left'><select name='orden'>
	    <option value='cl.apel_cli'>Apellidos
		<option value='cl.nomb_cli'>Nombres
		<option value='cl.nrod_cli'>Identificación
		<option value='co.fech_com'>Fecha Compra
	  </select>	  
	  <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
  <tr>
	<td class='Td2' width='10%' align='right'>Local:</td>
	<td class='Td2' width='10%' align='left'><select name='loca_com'>
	  <option value=''>
	  <?
	    $consultalo=mysql_query("SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_gru='03' ORDER BY valo_tip");
	    while($rowlo=mysql_fetch_array($consultalo)){
	      echo "<option value='$rowlo[codi_tip]'>$rowlo[valo_tip] ".substr($rowlo[desc_tip],0,15);
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
	<td class='Td2' width='10%' align='right'>Fecha Inicial:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='fechaini' size='10' maxlength='10'></td>
	<td class='Td2' width='10%' align='right'>Fecha Final:</td>
	<td class='Td2' width='30%' align='left'><input type='text' name='fechaini' size='10' maxlength='10'></td>
  </tr>
</table>

</form>
</body>
</HTML>