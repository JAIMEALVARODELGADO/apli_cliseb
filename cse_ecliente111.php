<!-- Guarda la Edicion del Cliente -->
<HTML>
<head>
<title>Guarda Edicion de Cliente</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_ecliente1.php?codi_cli="+codi_,"fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$fnac_cli=cambiafecha($fnac_cli);
$consultacli=mysql_query("SELECT codi_cli FROM cliente WHERE tpid_cli='$tpid_cli' AND nrod_cli='$nrod_cli' and codi_cli<>$codi_cli");
if(mysql_num_rows($consultacli)==0){
  mysql_query("UPDATE cliente SET tpid_cli='$tpid_cli',nrod_cli='$nrod_cli',nomb_cli='$nomb_cli',apel_cli='$apel_cli',dire_cli='$dire_cli',tele_cli='$tele_cli',fnac_cli='$fnac_cli',sexo_cli='$sexo_cli',emai_cli='$emai_cli',prof_cli='$prof_cli'
               WHERE codi_cli=$codi_cli");
  mysql_close();
  echo "<body onload='javascript:cargar(\"$codi_cli\")'>";
}
else{
  echo "<body>";
  echo "<table class='Tbl0' width='100%'>";
  echo "<tr><td class='Td0' align='center'>Reporte de errores!</td></tr>";
  echo "</table>";
  echo "<br><br><br><br>";
  echo "<center>La identificación pertenece a otro cliente</center>";
  echo "<br>";
  echo "<table class='Tb0' width='70%'>";
  echo "<tr>";
  echo "<td class='Td2' width='25%' align='right'><a href='#' onclick='cargar(\"$codi_cli\")'><img src='img/32px-Crystal_Clear_action_1leftarrow.png' border=0 height='20' width='20' alt='Regresar'></a></td>";
  echo "<td class='Td2' width='25%' align='left'><a href='#' onclick='cargar(\"$codi_cli\")'>Regresar</a></td>";
  echo "</tr>";
  echo "</table>";
}
?>
</body>
</HTML>
