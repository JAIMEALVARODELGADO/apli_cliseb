<!-- Guarda el  Tipo -->
<HTML>
<head>
<title>Guarda Tipos</title>
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
mysql_query("UPDATE tipo SET desc_tip='$desc_tip',valo_tip='$valo_tip' WHERE codi_tip='$codi_tip'");
mysql_close();
?>

</head>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">


</form>
</body>
</HTML>
