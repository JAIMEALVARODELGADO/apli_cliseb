<!-- Cambia el estado de la compra para imprimir la boleta -->
<HTML>
<head>
<title>Activa la compra para impresion de las boletas</title>
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
mysql_query("UPDATE compra SET impr_com='N' WHERE codi_com=$codi_com");
mysql_close();
echo "<body onload='javascript:cargar($ndoc_com)'>";
?>
</body>
</HTML>
