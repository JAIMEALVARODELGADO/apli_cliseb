<!-- Guarda la Edicion del  Premio -->
<HTML>
<head>
<title>Guarda la Edicion del Premio</title>
<Script Language="JavaScript">
function cargar() {
   window.open('cse_plan1.php','fr03','');
}
</Script>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
//$CONS="UPDATE premio SET desc_pre='$desc_pre'
//             WHERE codi_pre=$codi_pre";
//ECHO $CONS;
mysql_query("UPDATE premio SET desc_pre='$desc_pre'
             WHERE codi_pre=$codi_pre");
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
