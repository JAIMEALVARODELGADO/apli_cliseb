<!-- Guarda al Nuevo Usuario del Sistema -->
<HTML>
<head>
<title>Guarda al Nuevo Usuario del Sistema</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_eusuario51.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
//$consulta="SELECT codi_ucs FROM u_cliseb WHERE iden_ucs='$iden_ucs'";
//echo $consulta;
$consulta=mysql_query("SELECT codi_ucs FROM u_cliseb WHERE iden_ucs='$iden_ucs'");

if(mysql_num_rows($consulta)==0){
  $clav_ucs=MD5($clav_ucs);
  //$cons="INSERT INTO u_cliseb (codi_ucs,iden_ucs,nomb_ucs,logi_ucs,clav_ucs,tipo_ucs,esta_ucs) 
  //                 VALUES (0,'$iden_ucs','$nomb_ucs','$logi_ucs','$clav_ucs','$tipo_ucs','A')";
  //echo $cons;
  mysql_query("INSERT INTO u_cliseb (codi_ucs,iden_ucs,nomb_ucs,logi_ucs,clav_ucs,tipo_ucs,esta_ucs) 
                   VALUES (0,'$iden_ucs','$nomb_ucs','$logi_ucs','$clav_ucs','$tipo_ucs','A')");
  mysql_close();
  echo "<body onload='javascript:cargar()'>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La identificación pertenece a otro Usuario</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='cargar()'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='cargar()'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
</body>
</HTML>
