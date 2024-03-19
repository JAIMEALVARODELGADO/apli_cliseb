<!-- Inactiva/Activa Derecho a la opcion -->
<HTML>
<head>
<title>Inactiva/Activa Derecho a la Opcion</title>
<Script Language="JavaScript">
function cargar(codi_ucs){
  window.open("cse_admderecho11.php?codi_ucs="+codi_ucs,"fr05");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
if($opc_==1){
  mysql_query("INSERT INTO um_cliseb(codi_umc,codi_men,codi_ucs) VALUES (0,$codi_men,$codi_ucs)");
}
else{
  mysql_query("DELETE FROM um_cliseb WHERE codi_men=$codi_men and codi_ucs=$codi_ucs");
}
mysql_close();
?>
<body onload='javascript:cargar(<?echo $codi_ucs;?>)'>
</body>
</HTML>
