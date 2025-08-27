<?php
include('validAcount.php');
if(isset($_COOKIE['user'])){
	#global vars
	$user=str_replace(" ","_",$_COOKIE['user']);
	$file="../usuarios/$user/fav.txt";
 	$host="sql305.infinityfree.com";
        $userH="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
	$tabla="publicacionesPS";
	$connect=mysqli_connect($host,$userH,$pass);
	$db=mysqli_select_db($connect,$DB);
	$query = "select * from $tabla";
 if (isset($_GET['this'])&&!empty($_GET['this'])){
 if(xD($_COOKIE['user'])==="false"){
	echo '5';
}else{
	$fp=fopen($file, "r+");
	$lin=[];
	$id=$_GET['this'];
	//host data
	$queryV="select * from $tabla WHERE Id=$id";
	$vistoCount=mysqli_query($connect,$queryV);
	$Visto=mysqli_fetch_row($vistoCount);
	//obtener todas las lineas del txt
	while (($line = fgets($fp)) !== false){
		array_push($lin, $line);
	}
	//verifica si el valor ya esta escrito
	for($c=0;$c<count($lin);$c++){
		//si ya esta escrito lo borra del array
		if(strcmp($id,trim($lin[$c]))===0){
			$di=$c+1;
			//echo "existe ".$di."<br>";
			unset($lin[$c]);
			//echo "se borro del array <br>";
			$exist=true;
		}
	}
	//ingresa en el txt el array sin el antiguo valor
	if(isset($exist)){
		fopen($file,'w');
		foreach ($lin as $valor){
		 $fgc=file_get_contents(trim($file));
		 file_put_contents($file,$fgc.trim($valor).'
');
		}
		$Visto=$Visto[7]-1;
		 $sql="UPDATE $tabla SET Favoritos='$Visto' WHERE Id=$id";
		mysqli_query($connect,$sql)or die(mysqli_error($connect));
	echo"0";
	//si no esta, ingresa el nuevo valor al txt
	}else{
	fputs($fp,$id.'
');
	$Visto=$Visto[7]+1;
	$sql="UPDATE $tabla SET Favoritos='$Visto' WHERE Id=$id";
	mysqli_query($connect,$sql)or die(mysqli_error($connect));
	echo "$Visto";
	}
 }
}else if(isset($_GET['favoritos'])){
	$fp2=fopen($file, "r");
	$lin2=[];$all="";$NE=0;$NEA=[];$cri='';
	while (($line2 = fgets($fp2)) !== false){
	   if(!empty(trim($line2))){
	   	array_push($lin2, trim($line2));
	   }
	}
	echo "<div class='flexbox other'>";
	if(count($lin2)>0){
		for($x=count($lin2)-1;$x>=0;$x--){
		$query="SELECT * from $tabla where Id=".$lin2[$x];
		$resultado=mysqli_query($connect,$query);
		$row=mysqli_fetch_row($resultado);
		 if(mysqli_num_rows($resultado)>0){	
		  echo "<article oncontextmenu='return contextMenuFav(".$row[0].",event)'id='MyFav".$row[0]."'class='item resultsBusq'><img style='margin:5px;float:left;width:100px;height:100px;'src='".$row[4]."'><section class='title'onclick=showMore('".$row[2]."','')>".base64_decode($row[2])."</section><section class='resum'>".substr(base64_decode($row[3]),0,100)."...</section>
			</article>";
		 }else{
		 	array_push($NEA,$lin2[$x]);
		 	$NE++;
		 }
		 $all=$all.$lin2[$x].',';
		}
		foreach ($NEA as $key) {
			$cri=$cri.$key.',';
		}
		if($NE>0){
		 echo "<article class='item resultsBusq'>
		 	<section class='title'>404</section>
			 <section class='resum'>Hemos detectado que en tu lista de favoritos hay <b>".count($NEA)."</b> historias que han sido borradas, las cuales se han intentado mostrar, pero no ha sido posible, puedes quitar estas historias permanentemente presionando el boton de abajo, para poder evitar este mensaje en futuras ocasiones. <button onclick=rem('','".$cri."'); >Quitar</button></section></article>";
		}
	echo "<footer>
	<button class='icon-delete_sweep'title='Quitar todas'onclick=rem('','".$all."') id='publicarN'></button>
	</footer>";	
	}else{
	//si no hay items en el archivo favoritos
		echo "<article class='item resultsBusq'>
			 <section class='title'>No has agregado historias a tus favoritos, presiona el boton <span class='icon-favorite'></span> en la publicacion que quieres agregar</article>";
	}
	echo "</div>";
	 }else{
	//no se defino un valor
		echo "3";
	 }
}else{
	header("location://guilleweb.cf/webApp");
}
?>