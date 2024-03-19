<!--Elimina el  Tipo -->
<HTML>
<head>
<title>Elimina Tipos</title>
<Script Language="JavaScript">
function cargar() {
var load = window.open('cse_hgrupos11.php','fr03','');
window.opener = top;
window.close();
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
mysql_query("DELETE FROM tipo WHERE codi_tip='$codi_tip'");
mysql_close();
?>

</head>
<body onload="javascript:cargar()">


</form>
</body>
</HTML>
