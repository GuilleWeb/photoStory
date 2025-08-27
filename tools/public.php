<?php
include('validAcount.php');
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) ){
if(xD($_COOKIE['user'])==="false"){
  echo 'por favor valida tu cuenta para continuar';
}else{
$user=str_replace(" ", "_", $_COOKIE['user']);
if(isset($_FILES["fotoUpl"]) ){
  $fileN=$_FILES["fotoUpl"]['name'];
  $fileT=$_FILES["fotoUpl"]['type'];
  $fileS=$_FILES["fotoUpl"]['size'];
  $ruta="../usuarios/$user/";
  $fileP=$_FILES["fotoUpl"]['tmp_name'];
$ext=['image/png','image/jpg','image/gif','image/jpeg'];
for($c=0;$c<count($ext);$c++){
if($fileT===$ext[$c]){
$nExt=substr($ext[$c],6,4);
$yes=true;
}
}
if(!isset($yes)){
$nExt="old";
}
  if(isset($_POST['titulo']) && !empty($_POST['titulo'])){
    $titulo=str_replace(" ", "-", $_POST['titulo']);
  }else{
    $titulo="unknow";
  }
$nName=$ruta.$user.'_'.$titulo.'.'.$nExt;
 // echo "nombre: $fileN <br> tipo: $fileT <br> tamaño: $fileS <br> ruta: $fileP";
$files=scandir($ruta);
for($f=2;$f<count($files);$f++){
 if($files[$f]===$user.'_'.$titulo.'.'.$nExt){
echo "ya existe este titulo, o el fichero no es una extension permitida <b>.png, .jpg, jpeg, gif</b>";
$error=1;
 }
}
//if()
if(isset($error) || !isset($yes)
  ){
}else{
  $mover=move_uploaded_file($fileP,$ruta.$fileN);

   if($mover){
    //echo "<br> - movido";
    rename($ruta.$fileN, $nName);
  $fotoPath=$user.'/'.$user.'_'.$titulo.'.'.$nExt;
  }
  }

  }
if(isset($error) || !isset($yes)
  ){
echo " hay un error ";
}else{
if(isset($_POST['texto']) && !empty($_POST['texto']) && isset($_POST['titulo']) && !empty($_POST['titulo']) ){
if(isset($fotoPath)){
$path='usuarios/'.$fotoPath;
}else{
$path='false';
}
$result=" ";
$nombre=$_COOKIE['user'];
$title=str_replace("<","&lt;",$_POST['titulo']);
$title=base64_encode($title);
/*$content=str_replace("<","&lt;",$_POST['texto']);
$content=str_replace("\n","<br>",$content);
$content= preg_replace("/((http://|https://|www.)[^\s]+)/", '<a target="_blank" href="$1">$0</a>', $content);
$content= preg_replace("/href=\"www/", 'href="http://www', $content);
$content= preg_replace("/((#)[^\s]+)/", '<a onclick=string="$1";showMore("",string.replace("#","")); href="#">$0</a>', $content);*/
$content=base64_encode($_POST['texto']);
$fecha=date('D d/M/Y');
$host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
$tabla="publicacionesPS";
$connect=mysqli_connect($host,$user,$pass);
$db=mysqli_select_db($connect,$DB);
    if($connect){
      if($db){
if(mysqli_query($connect, "INSERT INTO $tabla VALUES ('','".str_replace(" ","_",$nombre)."','$title','$content','$path','$fecha','','')")){
              $result='Se ha publicado!
              <script>setTimeout(function(){
                $("#body").load($url);
              },1500);</script>';
            }else{
              $result.=mysqli_error($connect);
            }
        }
      }

}
echo $result;

}
}
}else{
  header("location://guilleweb.cf/webApp");
}
?>