<!-- Edita Compra -->
<HTML>
<head>
<title>Edita de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<!-- Funcion que valida que no queden en blanco los campos obligatorios -->
<script languaje="javascript">
function validar()
{
var error = "Por favor, para continuar,\ncomplete los siguientes campos:\n\n";
var a = ""
    if (document.form1.tdoc_com.value == "") { a += " Tipo de Doc. de Compra\n"; }
    if (document.form1.ndoc_com.value == "") { a += " Numero de Compra"; }
    if (document.form1.fech_com.value == "") { a += " Fecha de Compra\n"; }
    if (document.form1.valo_com.value == "") { a += " Valor de la Compra\n"; }
    if (a != "") 
    { alert(error + a);return true;}
document.form1.submit()
}
function atras()
{
  history.go(-1)
}
</script>
</head>
<body>
<form name='form1' method='post' action='cse_ecompra1111.php'>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$consulta=mysql_query("SELECT co.codi_com,co.tdoc_com,co.ndoc_com,co.fech_com,co.valo_com,co.loca_com,cl.codi_cli,cl.tpid_cli,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre,tp.desc_tip
           FROM compra as co 
		   INNER JOIN cliente as cl ON cl.codi_cli=co.codi_cli
		   INNER JOIN tipo as tp ON tp.codi_tip=cl.tpid_cli
		   WHERE co.codi_com=$codi_com");
$row=mysql_fetch_array($consulta);
?>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Edita Compra</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Tipo de Identificación:</td>
    <td class='Td2' width='15%' align='left'><b><?echo $row[desc_tip];?></td>
	<td class='Td2' width='10%' align='right'>Número:</td>
	<td class='Td2' width='15%' align='left'><b><?echo $row[nrod_cli];?></td>
	<td class='Td2' width='5%' align='right'>Nombre:</td>
    <td class='Td2' width='15%' align='left'><b><?echo $row[nombre];?></td>
  </tr>
</table>
<table class='Tbl0' width='100%'>
  <tr><td class='Td1' align='center'>Datos de la Compra</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <tr>
    <td class='Td2' width='10%' align='right'>Local:</td>
    <td class='Td2' width='15%' align='left'><select name='loca_com'>
	<option value=''>
	<?
	  $consultalo=mysql_query("SELECT codi_tip,desc_tip,valo_tip FROM tipo WHERE codi_gru='03' ORDER BY valo_tip");
	  while($rowlo=mysql_fetch_array($consultalo)){
	    echo "<option value='$rowlo[codi_tip]'>$rowlo[valo_tip] ".substr($rowlo[desc_tip],0,15);
	  }
	?>
	</select>
  </tr>
  <tr>
    <td class='Td2' width='10%' align='right'>Documento:</td>
    <td class='Td2' width='15%' align='left'><select name='tdoc_com'>
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
	<td class='Td2' width='15%' align='left'><input type='text' name='ndoc_com' size='6' maxlength='6' value='<?echo $row[ndoc_com];?>'></td>
	<td class='Td2' width='10%' align='right'>Fecha:</td>
    <td class='Td2' width='15%' align='left'><input type='text' name='fech_com' size='10' maxlength='10' value='<?echo cambiafechadmy($row[fech_com]);?>'></td>
	<td class='Td2' width='10%' align='right'>Valor:</td>
	<td class='Td2' width='15%' align='left'><input type='text' name='valo_com' size='7' maxlength='7' value='<?echo $row[valo_com];?>'></td>
  </tr>
</table>
<input type='hidden' name='codi_com' value='<?echo $codi_com;?>'>
<input type='hidden' name='codi_cli' value='<?echo $row[codi_cli]?>'>
<input type='hidden' name='valo_ant' value='<?echo $row[valo_com];?>'>

<script language='javascript'>
document.form1.loca_com.value='<?echo $row[loca_com];?>';
document.form1.tdoc_com.value='<?echo $row[tdoc_com];?>';
</script>

<br>
<table class='Tbl0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='validar()'><img src='img/32px-Crystal_Clear_device_zip_unmount.png' border=0 height='20' width='20' alt='Nuevo'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='validar()'>Guardar</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?
mysql_free_result($consulta);
mysql_free_result($consultalo);
mysql_free_result($consultado);
mysql_close();
?>
</body>
</HTML>