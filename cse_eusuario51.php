<!-- Busca Usuarios -->
<HTML>
<head>
<title>Edicion de Usuarios del Sistema</title>
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
<?
$consulta=mysql_query("SELECT codi_ucs,iden_ucs,nomb_ucs,logi_ucs,esta_ucs FROM u_cliseb ORDER BY nomb_ucs");
?>
<table class='Tbl0'>
  <tr><td class='Td1' align='center'>Listado de Usuarios del Sistema</td></tr>
</table>
<table class='Tbl0' width='70%' border='0'>
  <th class='Th0' width='10%' colspan='2'>Opciones</th>
  <th class='Th0' width='20%'>Nro Identif</th>
  <th class='Th0' width='40%'>Nombres</th>
  <th class='Th0' width='20%'>Login</th>
  <th class='Th0' width='10%'>Estado</th>
  <?
  while($row=mysql_fetch_array($consulta)){
    if($row[esta_ucs]=='A'){
	  $estado='Activo';
	  $nuevoest_usu='I';
	  $alt='Inactivar';
	  $img='img/32px-Crystal_Clear_action_tab_remove.png';
	}
	else{
	  $estado='Inactivo';
	  $nuevoest_usu='A';
	  $alt='Activar';
	  $img='img/32px-Crystal_Clear_action_tab_new.png';
    }
    echo "<tr>";
	echo "<td class='Td2'><a href='cse_eusuario511.php?codi_ucs=$row[codi_ucs]'><img src='img/32px-Crystal_Clear_device_tablet.png' border=0 height='20' width='20' alt='Editar'></a></td>";
	echo "<td class='Td2'><a href='cse_iusuario513.php?codi_ucs=$row[codi_ucs]&esta_ucs=$nuevoest_usu'><img src='$img' border=0 height='20' width='20' alt='$alt'></a></td>";
	echo "<td class='Td2'>$row[iden_ucs]</td>";
	echo "<td class='Td2'>$row[nomb_ucs]</td>";
	echo "<td class='Td2'>$row[logi_ucs]</td>";
	echo "<td class='Td2'>$estado</td>";
	echo "</tr>";
  }
  ?>  
</table>
<input type='hidden' name='codi_cli' value='<?echo $codi_cli?>'>
<br>
<table class='Tb0' width='70%'>
  <tr>
  <td class='Td2' width='25%' align='right'><a href='cse_nusuario512.php'><img src='img/32px-Crystal_Clear_mimetype_document2.png' border=0 height='20' width='20' alt='Crear Nuevo Usuario'></a></td>
  <td class='Td2' width='25%' align='left'><a href='cse_nusuario512.php'>Nuevo</a></td>
  <td class='Td2' width='25%' align='right'><a href='#' onclick='atras()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>
  <td class='Td2' width='25%' align='left'><a href='#' onclick='atras()'>Regresar</a></td>
  </tr>
</table>

</form>
<?
mysql_free_result($consulta);
mysql_close();
?>
</body>
</HTML>