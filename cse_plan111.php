<!-- Guarda los Premios -->
<HTML>
<head>
<title>Guarda Premios</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
mysql_query("INSERT INTO premio(codi_pre,codi_ppm,desc_pre)
               VALUES (0,1,'$desc_pre')");
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
