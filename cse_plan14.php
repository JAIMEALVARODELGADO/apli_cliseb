<!-- Guarda el Plan de Premios -->
<HTML>
<head>
<title>Guarda Plan de Premios</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$fsor_ppm=cambiafecha($fsor_ppm);
mysql_query("UPDATE plan_premio SET fsor_ppm='$fsor_ppm',nota_ppm='$nota_ppm'");
mysql_close();
?>
<script language='javascript'>
  alert("registro"+<?echo mysql_affected_rows();?>);
</script>
</head>
<body onload="javascript:cargar()">

</form>
</body>
</HTML>
