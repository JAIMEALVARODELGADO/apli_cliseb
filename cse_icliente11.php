<!-- Informe de Clientes -->
<HTML>
<head>
<title>Informe de Clientes</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
?>
</head>
<body>
<form name='form1' method='post' action='cse_ecliente1.php'>
<?
$correos='';
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
$consulta="SELECT codi_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,emai_cli FROM cliente";
if(!empty($condicion)){
  $consulta=$consulta." WHERE ".$condicion;
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
    <th class='Th0' width='15%'>Nro Identif</th>
    <th class='Th0' width='15%'>Nombres</th>
    <th class='Th0' width='20'>Apellidos</th>
    <th class='Th0' width='25%'>Dirección</th>
    <th class='Th0' width='15%'>Teléfono</th>
    
	<?
	while($rowcli=mysql_fetch_array($consultacli)){
	  echo "<tr>";
	  echo "<td class='Td2'>$rowcli[nrod_cli]</td>";
	  echo "<td class='Td2'>$rowcli[nomb_cli]</td>";
	  echo "<td class='Td2'>$rowcli[apel_cli]</td>";
	  echo "<td class='Td2'>$rowcli[dire_cli]</td>";
	  echo "<td class='Td2'>$rowcli[tele_cli]</td>";
	  echo "</tr>";
	  if(!empty($rowcli[emai_cli])){
	    $correos=$correos.$rowcli[emai_cli].";";
	  }
	}
	?>
  </table>
  <?
  if($correo=='on'){
    echo "Correos Generados: ";
    echo "<br>".$correos;
  }
}
?>  
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>
</form>
<?
mysql_close();
?>
</body>
</HTML>