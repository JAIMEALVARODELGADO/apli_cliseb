<!-- Guarda las Clientes -->
<HTML>
<head>
<title>Guarda Clientes</title>
</head>
<link rel="stylesheet" href="css/style.css" type="text/css" />

<Script Language="JavaScript">
function cargar() {
  form1.submit();
}
function regresar(){
  history.go(-1);
}
</Script>
<form name='form1' action='cse_ccompra2.php' target='fr03'>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
if(!empty($fnac_cli)){
  $fnac_cli=cambiafecha($fnac_cli);
}
else{
  $fnac_cli='0000-00-00';
}
$fech_com=cambiafecha($fech_com);
$hoy=cambiafecha(hoy());
$puntos=floor($valo_com/1000);
$consulta=mysql_query("SELECT codi_cli FROM cliente WHERE tpid_cli='$tpid_cli' and nrod_cli='$nrod_cli'");
if(mysql_num_rows($consulta)==0){
  mysql_query("INSERT INTO cliente (codi_cli,tpid_cli,nrod_cli,nomb_cli,apel_cli,dire_cli,tele_cli,fnac_cli,sexo_cli,emai_cli,prof_cli)
               VALUES (0,'$tpid_cli','$nrod_cli','$nomb_cli','$apel_cli','$dire_cli','$tele_cli','$fnac_cli','$sexo_cli','$emai_cli','$prof_cli')");
  $codi_cli=mysql_insert_id();
  echo "<input type='hidden' name='tpid_cli' value='$tpid_cli'>";
  echo "<input type='hidden' name='nrod_cli' value='$nrod_cli'>";
  ?>
    <script language='javascript'>cargar()</script>;
  <?
}
else{
  $codi_cli=$codigo;
}
mysql_free_result($consulta);
mysql_close();
?>
</form>
</body>
</HTML>
