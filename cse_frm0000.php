<?
session_start();
session_register('Gcodi_ucs');
?>
<!-- Aqui se definen los frames para la búsqueda del usuarios y de la solicitud -->
<HTML>
<HEAD>
<title>CLISEB</title>
<script languaje='javascript'>
function validar(){
  alert("Acceso Denegado");
  window.open("index.php");
  window.close();
}
</script>
</HEAD>
<?
//Aqui cargo las funciones 
include("funciones.php");
conectarbd();
$clave=substr(MD5($clave),0,32);
$consulta=mysql_query("SELECT codi_ucs,logi_ucs,clav_ucs,tipo_ucs
                       FROM u_cliseb WHERE logi_ucs='$usuario' and clav_ucs='$clave' and esta_ucs='A'");
if(mysql_num_rows($consulta)==1){
  $row=mysql_fetch_array($consulta);
  $Gcodi_ucs=$row[codi_ucs];
  ?>
    <FRAMESET cols="15%,*" framespacing="0" border="0" frameborder="0"> 
      <FRAME SRC=cse_left2.php NAME=fr01>
        <FRAMESET rows="15%,*" framespacing="0" border="0" frameborder="0"> 
          <FRAME SRC=cse_top.html NAME=fr02>
          <FRAME SRC=cse_fondo.html NAME=fr03>
        </FRAMESET><noframes></noframes> 
    </FRAMESET><noframes></noframes> 
  <?
}
else{
  ?>
    <script languaje='javascript'>
      validar();
	</script>
  <?
}
mysql_free_result($consulta);
mysql_close();
?>
</HTML>
