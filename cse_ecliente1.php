<!-- Busca Clientes -->
<HTML>
<head>
<title>Edicion de Clientes</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script languaje="javascript">
function buscar(){
  document.form1.submit();
}
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente1.php'>
<table class='Tbl0' width='100%'>
  <tr><td class='Td0' align='center'>Edición de Clientes</td></tr>
</table>
<br>
<table class='Tbl0' width='100%' border='0'>
  <tr>
	<td class='Td2' width='10%' align='right'>Identificación:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='nrod_cli' size='10' maxlength='20' value='<?echo $nrod_cli;?>'></td>
	<td class='Td2' width='10%' align='right'>Nombres:</td>
    <td class='Td2' width='10%' align='left'><input type='text' name='nomb_cli' size='25' maxlength='25' value='<?echo $nomb_cli;?>'></td>
	<td class='Td2' width='10%' align='right'>Apellidos:</td>
	<td class='Td2' width='10%' align='left'><input type='text' name='apel_cli' size='25' maxlength='25' value='<?echo $apel_cli;?>'><a href='#' onclick='buscar()'></td>
	<td class='Td2' width='10%' align='right'>Orden:</td>
	<td class='Td2' width='30%' align='left'><select name='orden'>
	    <option value='apel_cli'>Apellidos
		<option value='nomb_cli'>Nombres
		<option value='nrod_cli'>Identificación
	  </select>	  
	  <a href='#' onclick='buscar()'><img src='img/32px-Crystal_Clear_app_xmag.png' border=0 height='20' width='20' alt='Buscar'></a>
	</td>
  </tr>
</table>
<script language='javascript'>
document.form1.orden.value='<?echo $orden;?>';
</script>
<?

$condicion='';
if(!empty($codi_cli)){
  $condicion=$condicion."codi_cli='$codi_cli' and ";}
if(!empty($nrod_cli)){
  $condicion=$condicion."nrod_cli='$nrod_cli' and ";}
if(!empty($nomb_cli)){
  $condicion=$condicion."nomb_cli like '$nomb_cli%' and ";}
if(!empty($apel_cli)){
  $condicion=$condicion."apel_cli like '$apel_cli%' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
$consulta="SELECT codi_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,punt_cli FROM cliente";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
else{
   $consulta=$consulta." WHERE codi_cli=1 ";
}
if(empty($orden)){
  $orden='nomb_cli';
}
$consulta=$consulta." ORDER BY $orden";
$consultacli=mysql_query($consulta);
if(mysql_num_rows($consultacli)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrados</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Listado Clientes</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' width='5%'>Opciones</th>
    <th class='Th0' width='15%'>Nro Identif</th>
    <th class='Th0' width='15%'>Nombres</th>
    <th class='Th0' width='20'>Apellidos</th>
    <th class='Th0' width='25%'>Dirección</th>
    <th class='Th0' width='15%'>Teléfono</th>
	<th class='Th0' width='5%'>Puntos</th>    
	<?
	while($rowcli=mysql_fetch_array($consultacli)){
	  echo "<tr>";
	  echo "<td class='Td2'><a href='cse_ecliente11.php?codi_cli=$rowcli[codi_cli]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></a></td>";
	  echo "<td class='Td2'>$rowcli[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcli[nomb_cli]</td>";
	  echo "<td class='Td2'>$rowcli[apel_cli]</td>";
	  echo "<td class='Td2'>$rowcli[dire_cli]</td>";
	  echo "<td class='Td2'>$rowcli[tele_cli]</td>";
	  echo "<td class='Td2'>$rowcli[punt_cli]</td>";
	  echo "</tr>";
	}
	?>
    
  </table>
  <?
}
?>  
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>

<br>
<table class='Tb0' width='70%'>
  <tr>
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