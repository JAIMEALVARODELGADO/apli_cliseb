<!-- Listado de compras para su edicion -->
<HTML>
<head>
<title>Listado de Edicion de Compras</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
<script language='javascript'>
function anular(codi_,ndoc_){
var url=''
	if(confirm('Desea anular el documento: '+ndoc_)){
		url="cse_ecompra113.php?codi_com="+codi_+"&ndoc_com="+ndoc_;
		window.open(url,'fr05');
	}
}
</script>
</head>
<body>
<form name='form1' method='post' action=''>
<?
$condicion='';
if(!empty($nrod_cli)){
  $condicion=$condicion."cl.nrod_cli='$nrod_cli' and ";}
if(!empty($nomb_cli)){
  $condicion=$condicion."cl.nomb_cli like '$nomb_cli%' and ";}
if(!empty($apel_cli)){
  $condicion=$condicion."cl.apel_cli like '$apel_cli%' and ";}
if(!empty($loca_com)){
  $condicion=$condicion."co.loca_com='$loca_com' and ";}
if(!empty($tdoc_com)){
  $condicion=$condicion."co.tdoc_com='$tdoc_com' and ";}
if(!empty($ndoc_com)){
  $condicion=$condicion."co.ndoc_com='$ndoc_com' and ";}
$condicion=substr($condicion,0,(strlen($condicion)-5));
$consulta="SELECT co.codi_com,co.ndoc_com,co.fech_com,co.loca_com,co.valo_com,co.impr_com,co.anul_com,cl.nrod_cli,concat(cl.nomb_cli,' ',cl.apel_cli) as nombre,lo.desc_tip,lo.valo_tip 
           FROM compra as co 
		   INNER JOIN cliente as cl ON cl.codi_cli=co.codi_cli
		   INNER JOIN tipo as lo ON lo.codi_tip=co.loca_com";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
}
if(empty($orden)){
  $orden='cl.nomb_cli';
}
$consulta=$consulta." ORDER BY $orden";
$consultacom=mysql_query($consulta);
if(mysql_num_rows($consultacom)==0){
  echo "<table class='Tbl0'>";
  echo "<tr><td class='Td1' align='center'>Cliente No Encontrados</td></tr>";
  echo "</table>";
}
else{
  ?>
  <table class='Tbl0'>
    <tr><td class='Td1' align='center'>Compras</td></tr>
  </table>
  <table class='Tbl0' width='100%' border='0'>
    <th class='Th0' width='10%' colspan='4'>Opcion</th>
    <th class='Th0' width='7%'>No.Compra</th>
    <th class='Th0' width='10%'>Identif</th>
    <th class='Th0' width='28%'>Nombre</th>
    <th class='Th0' width='10%'>Fecha</th>
    <th class='Th0' width='20%'>Local</th>
    <th class='Th0' width='10%'>Valor</th>
	<th class='Th0' width='5%'>Est</th>
	<?
	while($rowcom=mysql_fetch_array($consultacom)){
	  echo "<tr>";
	  if($rowcom[anul_com]=='S'){
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></td>";
	      echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Boleta Impresa Anteriormente'></td>";
		  echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' alt='Activar Impresion de Boleta'></td>";
		  echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Anular Documento'></td>";
	  }
	  else{
	  	      echo "<td class='Td2'><a href='cse_ecompra111.php?codi_com=$rowcom[codi_com]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></a></td>";
	      if($rowcom[impr_com]=='S'){
		    echo "<td class='Td2'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Boleta Impresa Anteriormente'></td>";
		  }
		  else{
		    echo "<td class='Td2'><a href='cse_prnboleta.php?codi_com=$rowcom[codi_com]' target='blank'><img src='img/32px-Crystal_Clear_action_fileprint.png' border=0 height='20' width='20' alt='Imprimir Boletas'></a></td>";
	      }
		  echo "<td class='Td2'><a href='cse_ecompra112.php?codi_com=$rowcom[codi_com]&ndoc_com=$rowcom[ndoc_com]'><img src='img/32px-Crystal_Clear_action_view_bottom.png' border=0 height='20' width='20' alt='Activar Impresion de Boleta'></a></td>";
		  echo "<td class='Td2'><a href='#' onclick='anular(\"$rowcom[codi_com]\",\"$rowcom[ndoc_com]\")'><img src='img/32px-Crystal_Clear_action_tab_remove.png' border=0 height='20' width='20' alt='Anular Documento'></a></td>";
	  }
	  echo "<td class='Td2'>$rowcom[ndoc_com]</td>";
	  echo "<td class='Td2'>$rowcom[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcom[nombre]</td>";
	  echo "<td class='Td2'>".cambiafechadmy($rowcom[fech_com])."</td>";
	  echo "<td class='Td2'>".$rowcom[valo_tip].' '.$rowcom[desc_tip]."</td>";
	  echo "<td class='Td2' align='right'>$rowcom[valo_com]</td>";
	  if($rowcom[anul_com]=='S'){echo "<td class='Td2' align='right'>Anul</td>";}
	  else{echo "<td class='Td2' align='right'></td>";}	  
	  echo "</tr>";
	}
	?>
  </table>
  <?
}
?>  
</form>
<?
mysql_close();
?>
</body>
</HTML>