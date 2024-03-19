<!--Anula el documento -->
<HTML>
<head>
<title>Anula el documento</title>
<Script Language="JavaScript">
function cargar(codi_) {
  window.open("cse_ecompra11.php?ndoc_com="+codi_,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
mysql_query("UPDATE compra SET anul_com='S' WHERE codi_com=$codi_com");
//echo mysql_affected_rows();
mysql_close();
echo "<body onload='javascript:cargar($ndoc_com)'>";
?>
</body>
</HTML>
