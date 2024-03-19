<?
session_register("gcodi_gru");
session_register("gdesc_gru");
?>
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
$consulta=mysql_query("SELECT desc_tip FROM tipo WHERE desc_tip='$desc_tip'");
if(mysql_num_rows($consulta)==0){
  $consulta=mysql_query("SELECT max(codi_tip) FROM tipo WHERE codi_gru='$gcodi_gru'");
  $row=mysql_fetch_array($consulta);
  if(empty($row['max(codi_tip)'])){
     $codi_tip=$gcodi_gru.'001';}
    else{
      $codi_tip=substr($row['max(codi_tip)'],2,3)+1;
	  $codi_tip=STR_PAD($row['max(codi_tip)']+1,5,'0',STR_PAD_LEFT);
	  echo $codi_tip;
    }
    mysql_query("INSERT INTO tipo (codi_tip,codi_gru,desc_tip,valo_tip,fijo_tip) VALUES ('$codi_tip','$gcodi_gru','$desc_tip','$valo_tip','N')");
  }
  mysql_free_result($consulta);
  mysql_close();
?>

</head>
<body bgcolor="#E6E8FA" onload="javascript:cargar()">

</form>
</body>
</HTML>
