<?php
error_reporting(0);
$passwor=$_COOKIE['qwerty'];
$tabla="usuariosPS";
$host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";

$usuario=str_replace("_"," ",$_COOKIE['user']);
$connect=mysqli_connect($host,$user,$pass);
$db=mysqli_select_db($connect,$DB);
$query = "select * from $tabla";
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) 
    && isset($_COOKIE['qwerty']) && !empty($_COOKIE['qwerty'])){
 include('tools/validAcount.php');
 if(xD($_COOKIE['user'])==="false"){
  echo 'Por favor valida tu cuenta para continuar!';
 }else{

//$query = "select * from $tabla";
 if($connect){
  if($db){
    if($resultado =mysqli_query($connect,$query)){
      while($registro = mysqli_fetch_row($resultado)){ 
        //verifica que el usuari y contraseña sean correctos
        if($registro[1]===$usuario && $registro[3]===$passwor){
          $idUser=$registro[0];
          
        }

      }
    }             
   }
  }
}
}else{
    echo "<script>location.reload();</script>";
}
?>
<fieldset id="publicSection">
<!--formulario de publicar-->
 <legend id="moveAction"onclick="myDrag(this)"title="click para mover esta ventana"type="button"class="icon-fullscreen"> Publicar</legend>
 <progress align="right"id="prog"max="0"value="0"hidden></progress>
 <div class="showImage"></div>
 <form onsubmit="return aplli()"enctype="multipart/form-data"id="publicarForm"method="post">
  <input id="textUpl"type="file"hidden accept=".txt">
  <input name="fotoUpl"id="fotoUpl"type="file"hidden accept=".jpg, .png, .jpeg, .gif">
  <input title="5 a 20 caracteres"pattern=".{5,20}"placeholder="Titulo para tu historia"type="name"name="titulo"required><br><br>
  <textarea title="15 a 1000 caracteres"placeholder="Escribe una historia para tu foto" minlength="15" maxlength="1000"id="texto"name="texto"required></textarea><br>
  <label title="agrega tu publicacion desde una nota"for="textUpl" class="icon-file-text"></label>
  <b> | </b>
  <label title="agregar una foto/video"for="fotoUpl" class="icon-file-picture"></label>
  <input type="submit"value="Publicar">
  <p id="Alert"style="color:red"></p>
  <span id="imgPrev"></span>
 </form>
 <script type="text/javascript">
 //-------------imagen------------
  document.getElementById('fotoUpl').addEventListener('change', leerMedia, false);
  //--------------txt------------
  document.getElementById('textUpl').addEventListener('change', leerArchivo, false);
 </script> 
    <br>
</fieldset>
<?php
if(isset($valido) && $valido===0){ 
//verifica si es valido, o se modifico la cookie
echo "<script>location.reload(); </script>";
}else{
echo '<div class="flexbox">';
  $more=" ";
  $pu=[];
  $table="publicacionesPS";
  $query = "select * from $table ORDER BY id desc";
      //valida si es mi favorito, datos
  $user=str_replace(" ","_",$_COOKIE['user']);
  $file="usuarios/$user/fav.txt";
  $fp=fopen($file, "r+");
  $lin=[];
  //obtener todas las lineas del txt
  while (($line = fgets($fp)) !== false){
   array_push($lin, $line);
  }
  if($resultado=mysqli_query($connect,$query)){
    while($registro = mysqli_fetch_row($resultado)){
     $total=mysqli_num_rows($resultado);
     $vistos=$registro[6];
     $favo=$registro[7];
      $contentD=str_replace("<","&lt;",base64_decode($registro[3]));
        $contentD= preg_replace("/((#)[^\s]+)/", '<1 onclick=string="search=$1";showMore("",string.replace("#","")); class="tagSelect">$0</1>', $contentD);
     $pos = strpos($registro[4], '.gif');
     $read=explode(",", $vistos);
     $result="";
     $valido=0;
     $colorF="#4048af";
     $colorV="#4048af";
     for($cV=0;$cV<count($read);$cV++){
        if(in_array($idUser, $read)){
          $colorV="#df0056";
        }
      }
      for($c=0;$c<count($lin);$c++){
        if(strcmp($registro[0],trim($lin[$c]))===0){
          $colorF="#df0056";
        }
      }
     if($pos){ //verifica si la imagen es gif
      $img="<img class='gif'style='-webkit-user-select: none;cursor:pointer;'data-gifffer='$registro[4]'>";
     }else{
      $img="<img style='-webkit-user-select:none;cursor:pointer;'src='$registro[4]'>";
     }
     if(strlen($contentD)>100 ){
      //si el contenido es mas de 100 legth
      $more='<b style="cursor:pointer;"onclick=showMore("'.$registro[2].'","")>mostrar mas...</b>';
    }
    echo '<div class="item">'.$img.'<br>
    <section class="title"onclick=showMore("'.$registro[2].'","") >'.base64_decode($registro[2]).'</section>
    <section class="resum">'.substr($contentD,0, 100).' '.$more.'</section><section class="control">
    <a href=javascript:showMore("","","'.base64_encode(str_replace("_"," ",$registro[1])).'","","","","") title="es el creador de esta nota, click para visitar perfil">'.str_replace("_"," ",$registro[1]).'</a>
    <span title="visto '.count($read).' veces"style="color:'.$colorV.';"class="icon-eye"> '.count($read).'</span>  
    <span id="this_'.$registro[0].'"onclick="favo('.$registro[0].');"title="agregar a favoritos"style="color:'.$colorF.';"class="icon-favorite">'.$favo.'</span>'.'</div>';
    }
    //onclick="favo('.$registro[0].')"
  }else{
    //$total=0;
  }
  //agregar lo de amigos
echo '</div>';
if($total<1){
//imprime publicasiones
echo " <article> 
<img src='tools/logo.png'>
<p><h3>Parece que no hay publicaciones, presiona el boton
 <button id='publicarLOb'> + </button> para agregar una. </h3></p>
</article>";
}

}
?>
<!--para los gif plat/pause-->
<script type="text/javascript">
 $(document).ready(function(){
  Gifffer({
    playButtonStyles: {
    'width': '60px',
    'height': '60px',
     'border-radius': '30px',
     'background': 'rgba(0, 0, 0, 0.3)',
     'position': 'absolute',
     'top': '50%',
     'left': '50%',
     'margin': '-30px 0 0 -30px'
    },
    playButtonIconStyles: {
     'width': '0',
     'height': '0',
     'border-top': '14px solid transparent',
     'border-bottom': '14px solid transparent',
     'border-left': '14px solid rgba(0, 0, 0, 0.5)',
     'position': 'absolute',
     'left': '26px',
     'top': '16px'
    }
  });
 });
</script>
<footer>
 <button title="Nueva Historia"onclick="showDialodP()"id="publicarN"class=" icon-note_add"></button>
</footer>