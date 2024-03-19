<?
session_start();
session_register('gcodi_gru');
if(!empty($codi_gru)){$gcodi_gru=$codi_gru;}
?>
<!-- Listado de Opciones del Menu -->
<HTML>
<head>
<title>Listado de Opciones del Menu</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script language='javascript'>
function permiso(opc_,codi_men,codi_ucs){
  window.open("cse_admderecho111.php?opc_="+opc_+"&codi_men="+codi_men+"&codi_ucs="+codi_ucs,"fr05");
}
</script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();

//echo "<br>".$gcodi_gru;
//echo "<br>".$codi_ucs;
	  
?>
</head>
<body>
<form name='form1' method='post' action=''>
<table class='Tbl0'>
  <tr><td class='Td1' align='center'>Listado de Opciones del Usuario del Sistema</td></tr>
</table>
<table class='Tbl0' width='100%' border='0'>
  <th class='Th0' width='10%'>Seleccionar</th>
  <th class='Th0' width='80%'>Opcion</th>
  <?
  $consulta=mysql_query("SELECT m.codi_men,m.desc_men,um.codi_umc 
  FROM menu as m 
  LEFT JOIN um_cliseb as um ON um.codi_men=m.codi_men and um.codi_ucs=$codi_ucs
  WHERE m.depe_men=$gcodi_gru");
  while($row=mysql_fetch_array($consulta)){
	echo "<tr>";
	echo "<td class='Td2' align='center'>";
	if($row[codi_umc]==Null){
	  echo "<input type='checkbox' name='chkopc' onclick='permiso(1,$row[codi_men],$codi_ucs)'>";
	}
	else{
	  echo "<input type='checkbox' name='chkopc' checked onclick='permiso(2,$row[codi_men],$codi_ucs)'>";
	}
	echo "</td>";
	echo "<td class='Td2'>$row[desc_men]</td>";
	echo "</tr>";
  }
  ?>
</table>
</form>
<?
mysql_free_result($consulta);
mysql_close();
?>
</body>
</HTML>