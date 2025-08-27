<?php
if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) ){
 $host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
 $tabla="publicacionesPS";
 $connect=mysqli_connect($host,$user,$pass);
 $result=0;
 $publics=[];
 $db=mysqli_select_db($connect,$DB);
if(isset($_GET['search'])&&!empty($_GET['search'])){
  $toB=$_GET['search'];
  $rows=0;
      //imprimir publicaciones
   if($connect){
    if($db){
      $query = "select * from $tabla";
     if($resultado=mysqli_query($connect,$query)){
      while($registro = mysqli_fetch_row($resultado)){
        $rows++;
      	for($d=0;$d<count($registro);$d++){
         	if(preg_match("/$toB/i", base64_decode($registro[$d]) )){
         	    $content=str_replace("<","&lt;",base64_decode($registro[3]));
        $content=str_replace("\n","<br>",$content);
        $content= preg_replace("/((#)[^\s]+)/", '<a onclick=string="search=$1";showMore("",string.replace("#","")); class="tagSelect">$0</a>', $content);
         		 $result++;
         		 array_push($publics,'<div class="item resultsBusq" onclick=showMore("'.$registro[2].'","")>
  <section class="title"onclick="showMore('.$registro[0].')">'.base64_decode($registro[2]).'</section><img src="'.$registro[4].'">
      
      <section class="resum">'.
      substr($content,0, 50).
      '<br>
      <a href="#" title="es el creador de esta nota, click para visitar perfil">'.$registro[1].'</a>
      </section>'.'</div>');
         	}
         }
   	}
  echo "<section class='flexbox'>";
  if(count($publics)>0){
    echo "<article class='item resultsBusq'>Mostrando resultados de <b>$toB</b><br>Encontrados <b>".count($publics)."</b></article>";

   for ($i=0; $i < count($publics); $i++) { 
    echo $publics[$i]; 
   }
  }else{
   echo "<article class='item resultsBusq'><span style='color: #df0056;float:left;font-size:40px;margin:5px;' class='icon-sad'></span>No se han encontrado resultados para <b>$toB</b> Prueba con otra palabra mas precisa o una palabra diferente.<br><b style='color: #df0056;'>Se muestran historias que quiza te puedan interesar</b></article>";
   for($c=0;$c<3;$c++){
   $num=rand(1,$rows);
   $query2 = "select * from $tabla where Id=".$num;
   $resulT = mysqli_query($connect, $query2);
   $row = mysqli_fetch_row($resulT);
   echo "<article onclick=showMore('".$row[2]."','') class='item'><section class='title'>".base64_decode($row[2])."</section><section class='resum'>".substr(base64_decode($row[3]),0,100)."</section>";
   echo "</article>";
  }
  }
  echo "</section>";
     }
    }     
   }
}else if(isset($_GET['post'])&&!empty($_GET['post'])){
  echo "<article id='complete'>";
    $post=$_GET['post'];
    $id="";
    $rows=0;
    $rowsId=[];
    $Existe=false;
    if($connect){
    if($db){
      $query = "select * from $tabla ORDER BY rand()";
     if($resultado=mysqli_query($connect,$query)){
     while($registro = mysqli_fetch_row($resultado)){
        $rows++; array_push($rowsId,$registro[0]);
      if($post===$registro[2]){
        $id=$registro[2];
        $w=$registro[0];
        $vistos=$registro[6];
        $content=str_replace("<","&lt;",base64_decode($registro[3]));
        $content=str_replace("\n","<br>",$content);
        $content= preg_replace("/((http|https|www)[^\s]+)/", '<a class="tagSelect" target="_blank" href="$1">$0</a>', $content);
        $content= preg_replace("/href=\"www/", 'href="http://www', $content);
        $content= preg_replace("/((#)[^\s]+)/", '<a onclick=string="search=$1";showMore("",string.replace("#","")); class="tagSelect">$0</a>', $content);
        echo "<section class='title'>".base64_decode($id)."</section><img style='-webkit-user-select: none;cursor:pointer;'src='$registro[4]'onclick='window.open(this.src)'>
        <section class='resum'>".$content."</section><a href=javascript:showMore('','','".base64_encode(str_replace('_',' ',$registro[1]))."','','','','') title='es el creador de esta nota, click para visitar perfil'>".str_replace('_',' ',$registro[1])."</a> <span title='Descargar imagen'style='font-size:20px;float:right;color:green;margin:5px 10px;'class='icon-download' onclick='desca(".$registro[0].",this);'> ".$registro[9]."</span> <span title='Compartir historia' style='font-size:20px;float:right;color:blue;margin:5px 10px;'class='icon-share' onclick='share(".$registro[0].",this);'> ".$registro[8]."</span> <span id='this_".$registro[0]."'onclick='favo(".$registro[0].");'title='agregar a favoritos'style='font-size:20px;float:right;color:red;margin:5px 10px;'class='icon-favorite'> ".$registro[7]."</span><span title='Visto'style='cursor:none;font-size:20px;float:right;color:darkslategrey;margin:5px 10px;'class='icon-eye'> ".$registro[6]."</span><br><small>".$registro[5]."</small>";
        $Existe=true;
        }
      }
$query3 = "SELECT * from usuariosPS";
$resulU = mysqli_query($connect, $query3)or die(mysqli_error($connect));
//or die(mysqli_error($connect));
//obtener id del usuario
while($recept = mysqli_fetch_row($resulU)){
 if($recept[1]===$_COOKIE['user']){
  if($recept[1]!='Invitado'){
    $res=$recept[0];
  }
 }
}
if(isset($res)){
$read=explode(",", $vistos);
for($v=0;$v<count($read);$v++){
if($w===$read[$v] || $res===$read[$v] || $res===3){
$yaEsta=1;
}
}
if(!isset($yaEsta)){
$queryV="select * from $tabla WHERE Id=$w";
$vistoCount=mysqli_query($connect,$queryV);
$Visto=mysqli_fetch_row($vistoCount);
//echo $Visto[5].' - '.$res;
$sql="UPDATE $tabla SET Visto='$Visto[6]$res,' WHERE Id=$w";
mysqli_query($connect,$sql);
//or die(mysqli_error($connect));
}
}
     }
    }
    }
  echo "</article>";
if($Existe!==false){
$indice=array_search($w,$rowsId,true);
$cant=0;
unset($rowsId[$indice]);
 echo "<fieldset>
  <legend>Otras entradas</legend><div class='flexbox other'>";
  if(count($rowsId)>0){
   foreach($rowsId as $key){
    if($cant<6){
      $cant++;
   $num=rand(1,count($rowsId));
   $query2 = "select * from $tabla where Id=".$key;
   $resulT = mysqli_query($connect, $query2);
   if(mysqli_num_rows($resulT)>0){
   $row = mysqli_fetch_row($resulT);
   $contentO=str_replace("<","&lt;",base64_decode($row[3]));
   //$contentO=str_replace("\n","<br>",$contentO);
   //$contentO= preg_replace("/((http|https|www)[^\s]+)/", '<a target="_blank" href="$1">$0</a>', $contentO);
    //$contentO= preg_replace("/href=\"www/", 'href="http://www', $contentO);
    $content= preg_replace("/((#)[^\s]+)/", '<a onclick=string="search=$1";showMore("",string.replace("#","")); class="tagSelect">$0</a>', $contentO);
   echo "<article onclick=showMore('".$row[2]."','') class='item resultsBusq'>
   <img style='margin:5px;float:left;width:100px;height:100px;'src='".$row[4]."'>
   <section class='title'>".base64_decode($row[2])."</section><section class='resum'>".substr($contentO,0,70)."...</section>";
   echo "</article>";
   $indice2=array_search($key,$rowsId,true);
   unset($rowsId[$indice2]);
   }
   
  }
  }
  }else{
    $row[2]=0;
       echo "<article onclick=showMore('".$row[2]."','') class='item resultsBusq'><section class='resum'>Parece que no hay historias suficientes para mostrar</section></article>";
  }
   echo "</fieldset>";
  
    
}else{
    echo "
    <article class='item resultsBusq'><span style='color: #df0056;float:left;font-size:40px;margin:5px;' class='icon-sad'></span>No hemos podido econtrar esta publicacion, puede que se haya borrado.</article>";
}
  echo"</div>";
}else{
  echo "no defined";
}
mysqli_close($connect);
}else{
    
    header("location://guilleweb.cf/webApp");
}
?>