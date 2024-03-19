<!-- Guarda la Edicion de la Compra -->
<HTML>
<head>
<title>Guarda Edicion de la Compra</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_ecompra11.php?codi_cli="+codi_,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$fech_com=cambiafecha($fech_com);
$puntos=floor(($valo_com-$valo_ant)/1000);
mysql_query("UPDATE compra SET tdoc_com='$tdoc_com',ndoc_com='$ndoc_com',fech_com='$fech_com',valo_com=$valo_com,loca_com='$loca_com'
             WHERE codi_com=$codi_com");
$consulta=mysql_query("SELECT punt_cli FROM cliente WHERE codi_cli=$codi_cli");
$row=mysql_fetch_array($consulta);
$puntos=$row[punt_cli]+$puntos;
mysql_query("UPDATE cliente SET punt_cli=$puntos WHERE codi_cli=$codi_cli");
mysql_close();
echo "<body onload='javascript:cargar($codi_cli)'>";
?>
</body>
</HTML>
