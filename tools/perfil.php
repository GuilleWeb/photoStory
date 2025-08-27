<div class="grid-container">
<?php
if(isset($_COOKIE['user']) && !empty($_COOKIE['user'])){
if(isset($_GET['profile']) && !empty($_GET['profile']) ){

$hostH="sql305.infinityfree.com";
        $userH="if0_39766672";
        $passH="Guilleweb042";
        $DBH="if0_39766672_webAppUsers";
$tablaH="usuariosPS";
$user=base64_decode($_GET['profile']);
$connectH=mysqli_connect($hostH,$userH,$passH);
$dbH=mysqli_select_db($connectH,$DBH);
        if($connectH){
            if($dbH){
                $queryH = "select * from $tablaH";
                    if($resultado =mysqli_query($connectH,$queryH)){
                        while($registro = mysqli_fetch_row($resultado)){
                    if($registro[1]===$_COOKIE['user']){
                        $MID=$registro[0];
                    }
                    if($registro[1]===$user){
                    	$exist=true;
                        $id=$registro[0];
                        $UID=$registro[0];
                        $nick=$registro[1];
                        $followUser=$registro[8];
                        if($registro[6]==="false"){
                        $src="tools/no_image_user.png";
                        }else{
                        $src=$registro[6];
                        }
                        if($registro[7]==="false"){
                          $descr="Este usuario no ha agregado una descripcion a su perfil.";
                        }else{
                        $descr=str_replace("<","&lt;",base64_decode($registro[7]));
                        $descr=str_replace(">","&gt;",$descr);
        $descr=str_replace("\n"," ",$descr);
        $descr= preg_replace("/((http|https|www)[^\s]+)/", '<a class="tagSelect" target="_blank" href="$1">$0</a>', $descr);
        $descr= preg_replace("/href=\"www/", 'href="http://www', $descr);
                            
                        }
                    //added 
                    }
                 }
              }
            }
        }
if(isset($exist)){
if($user===$_COOKIE['user']){
    //$infoJS=str_replace("\n\n","GUILLE",$descr);
    //$infoJS=str_replace(" ","_",$infoJS);
    //$infoJS=str_replace("<br>"," ",$infoJS);
    $infoJS=base64_encode($descr);
$button="<button onclick=infoChange('$infoJS'); title='Editar mi perfil'class='icon-mode_edit'></button>
<button onclick='photoChange()'title='cambiar foto de perfil'class='icon-photo_camera'></button>";
}else{
     $button="
     <button id='followBTN'onclick='follow($id);'title='Seguir'class='icon-add'></button>
    <button title='Enviar mensaje'class='icon-message'></button>
    <button title='Denunciar/Bloquear'class='icon-report'></button>";
}
echo "<div class='item1'>";
echo "
<section class='profileInfo1'>
<article class='g2'>
<img src='$src'alt='user_profile_pic'>
</article>
<article class='title g1'>$nick</article>
<article class='resum g3'>$descr</article>
<article class='g4'>
 $button
</article>
</section>";
if($user===$_COOKIE['user']){
echo "
<section class='profileInfo2'>
<form onsubmit='return aplli()'enctype='multipart/form-data'id='publicarForm'method='post'>
<br>
<input title='5 a 20 caracteres'pattern='.{5,20}'placeholder='Titulo para tu historia'type='name'name='titulo'required><br><br><textarea title='15 a 1000 caracteres'placeholder='Escribe una historia para tu foto'minlength='15' maxlength='1000'id='texto'name='texto'required></textarea><br>
<input name='fotoUpl'id='fotoUpl'type='file'hidden accept='.jpg, .png, .jpeg, .gif'>
<label title='agregar una foto'for='fotoUpl'class='icon-file-picture'></label>
<b> | </b>
<input id='textUpl'type='file'hidden accept='.txt'>
<label title='agrega tu publicacion desde una nota'for='textUpl' class='icon-file-text'></label>
<input type='submit'value='Publicar'>
<small id='Alert'style='color:red'></small>
</form>
</section>
<label title='agregar una foto'for='fotoUpl'>
<section class='profileInfo3'>
<progress align='right'id='prog'max='0'value='0'hidden>
</progress>
<br>
<span id='imgPrev'></span>
<script type='text/javascript'>
//-------------img-video------------
document.getElementById('fotoUpl')
  .addEventListener('change', leerMedia, false);
//--------------txt------------
document.getElementById('textUpl')
  .addEventListener('change', leerArchivo, false);
 </script>
</section>
</label>";
}
echo "
<section class='profileInfo4'>
<fieldset>
<legend>Siguiendo</legend>";
if(!empty($followUser)){
    //$dato=$followUser;
    $queryFo="select * from $tablaH Order by Nombres";
    $readF=explode(",",$followUser);
	if($followCount=mysqli_query($connectH,$queryFo)){
	    while($registroFoll=mysqli_fetch_row($followCount)){
	        if(in_array($registroFoll[0],$readF)){
	            $FollowMe=$registroFoll[8];
	           if($registroFoll[6]==="false"){
                    $f="tools/no_image_user.png";
                }else{
                    $f=$registroFoll[6];
                }
	            $n=$registroFoll[1];
	            $nC=base64_encode($n);
	            echo "<article class='follow'>
	            <img src='$f'alt='profile_pic'>
	            <hr width='80%'color='#4048af'>
	            <a title='visitar perfil' style='cursor:pointer;'onclick=showMore('','','$nC') class='title'>$n</a>
	            </article>";
	        }
        }
	}else{
	    echo mysqli_error($connectH);
	}   
}else{
echo "Esta persona no esta siguiendo a nadie, o esta privado.";
}
echo "
</fieldset>
<fieldset>
<legend>Seguidores</legend>";
if(!empty($followUser)){
    //$dato=$followUser;
    $queryFo="select * from $tablaH Order by Nombres";
    $readF=explode(",",$followUser);
	if($followCount=mysqli_query($connectH,$queryFo)){
	    //print_r($readF);
	    //echo $UID;
	    while($registroFoM=mysqli_fetch_row($followCount)){
	        if(!empty($registroFoM[8])){
	            //echo $registroFoM[8];
	            $readFM=explode(",",$registroFoM[8]);
    	        if(in_array($UID,$readFM)){
    	            if($registroFoM[6]==="false"){
                    $fM="tools/no_image_user.png";
                }else{
                    $fM=$registroFoM[6];
                }
                //echo $registroFoM[1]."<br>";
	            $nM=$registroFoM[1];
	            $nCM=base64_encode($nM);
	            echo "<article class='follow'>
	            <img src='$fM'alt='profile_pic'>
	            <hr width='80%'color='#4048af'>
	            <a title='visitar perfil' style='cursor:pointer;'onclick=showMore('','','$nCM') class='title'>$nM</a>
	            </article>";
	           $tiene="yes";
    	        }
	        }
	       }
	       if(!isset($tiene)){
	            echo "Este usuario no tiene seguidores, o esta privado.";
	        }
	}else{
	    echo mysqli_error($connectH);
	}   
}else{
echo "Esta persona no esta siguiendo a nadie, o esta privado.";
}
echo "
</fieldset>";
    $queryFo="select * from $tablaH WHERE Id = $MID";
	if($followCount=mysqli_query($connectH,$queryFo)){
	    //echo "conectado";
        $Follow=mysqli_fetch_row($followCount);
        //echo $Follow[8];
        $read=explode(",",$Follow[8]);
        //print_r($read);
        if(in_array($UID,$read)){
            echo "<script> $('#followBTN').attr({'class':'icon-remove','title':'Dejar de seguir'})</script>";
        }
	}else{
	    echo mysqli_error($connectH);
	}
echo "</section>
</div>";
}

if(isset($exist)){
 echo "<div class='item2'>";
$queryH = "select * from publicacionesPS order by Id desc";
$fotos=[];
 if($result=mysqli_query($connectH,$queryH)){
echo "<fieldset class='field1'>
   <legend>Historias</legend>
   <section class='flexbox otherFlex'>";
while($registro=mysqli_fetch_row($result)){
 if($user===$_COOKIE['user']){
   $function="contextMenuEdit($registro[0],event,this,'$registro[2]');";
 }else{
   $function="false";
 }
 if($registro[1]===str_replace(" ","_", $user)){
     $content=str_replace("<","&lt;",base64_decode($registro[3]));
      //  $content=str_replace("\n","<br>",$content);
        $content= preg_replace("/((#)[^\s]+)/", '<a onclick=string="search=$1";showMore("",string.replace("#","")); class="tagSelect">$0</a>', $content);
   echo "<article oncontextmenu=$function id='MyFav".$registro[0]."'onclick=showMore('".$registro[2]."','') class='item'>
   <img style='margin:5px;float:left;width:100px;height:100px;'src='".$registro[4]."'>
   <section class='title'>".base64_decode($registro[2])."</section>
   <section class='resum'>".substr($content,0,50)."<b>...</b></section>";
   echo "</article>";
   $hay=true;
   array_push($fotos, $registro[4]);
 }
}
if(!isset($hay)){
    echo " <article class='item'>
  <span style='color: #df0056;float:left;font-size:40px;margin:5px;' class='icon-sad'></span><section class='resum'>No se han encontrado historias de este usuario</article>";
}
echo "</section></fieldset>";
echo "<fieldset class='field2'><legend>Fotos</legend>";
if(count($fotos)>0){
for($c=0;$c<count($fotos);$c++){
echo "<section><img width='100%'onclick='window.open(this.src)'src='".$fotos[$c]."'/></section>";
}
}else{
  echo "<article class='item'>
  <span style='color: #df0056;float:left;font-size:40px;margin:5px;' class='icon-sad'></span><section class='resum'>No se han encontrado fotos de este usuario</article>";
 }
 echo "</fieldset>";
}
echo "</div>";
 }else{
  echo "<article class='item resultsBusq'><span style='color: #df0056;float:left;font-size:40px;margin:5px;' class='icon-sad'></span><section class='title'>Error 404</section><section class='resum'>Este usuario no se ha podido encontrar, puede que no existe o su cuenta haya sido eliminada o suspendida.</article>";
 }
}
}else{
  header('location://guilleweb.cf/webApp');
}
?>
</div>