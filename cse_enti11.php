<!-- Guarda la Edicion de la entidad -->
<HTML>
<head>
<title>Guarda Edicion de la Entidad</title>
<Script Language="JavaScript">
function cargar() {
  window.open("cse_enti1.php","fr03");
}
</Script>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
mysql_query("UPDATE entidad SET nit_ent='$nit_ent',nomb_ent='$nomb_ent',valxb_ent='$valxb_ent'");
mysql_close();
?>
<body onload='javascript:cargar()'>
</body>
</HTML>
