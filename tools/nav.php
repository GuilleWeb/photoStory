<?php
$valido=0;
 if(isset($_COOKIE['user']) && !empty($_COOKIE['user']) &&  
    isset($_COOKIE['qwerty']) && !empty($_COOKIE['qwerty'])){
        $host="sql305.infinityfree.com";
        $user="if0_39766672";
        $pass="Guilleweb042";
        $DB="if0_39766672_webAppUsers";
        $tabla="usuariosPS";
        $usuario=str_replace("_"," ",$_COOKIE['user']);
        $passwor=$_COOKIE['qwerty'];
        $connect=mysqli_connect($host,$user,$pass);
        $db=mysqli_select_db($connect,$DB);
        if($connect){
            if($db){
                $query = "select * from $tabla";
                    if($resultado =mysqli_query($connect,$query)){
                        while($registro = mysqli_fetch_row($resultado)){ 
                         if($registro[1]===$usuario && 
                          $passwor===$registro[3]) {
                          $neim=$registro[1];
                          $IdUser=$registro[0];
                          $nick=str_replace(" ","_",$neim);
                          if($registro[5]==="true"){
                            $valido=1;
                            }
                        }
                    }
                }else{ echo mysqli_error($content);}
            }else{ echo mysqli_error($content);}
        }else{ echo mysqli_error($content);}
  }
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>PS</title>
	<meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0, minimal-ui, viewport-fit=cover">
	<meta name="description" content="Comparte tus fotos favoritas y agregales una historia!">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="icon" href="tools/logo.png">
    <link rel="stylesheet" type="text/css" href="tools/main.css">
	<link rel="stylesheet" type="text/css" href="../icomoon/style.css">
    <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="tools/main.js"></script>
    <script type="text/javascript" src="gifer.min.js"></script>
<?php
if(isset($nick)){
$file='usuarios/'.$nick.'/style.json';
if(is_file($file) || is_link($file)){
$data=file_get_contents($file);
$json = json_decode($data,true);
 if($json["usar"]==="true"){
    
     echo "<style>
     body{
     background:".$json['cuerpo']['fondo'].";
     color:".$json['cuerpo']['color'].";    
     }
     header,table span, #seachDiv{
     background:".$json['cabecera']['fondo'].";
     color:".$json['cabecera']['color'].";
     }
     </style>";
 }
}
echo "<script>user='$nick';idUser=$IdUser;</script>";
}
?>
<div id="loadding">
<span class="icon-toys"></span>
Cargando...
</div>

</head>
<body onload=<?php
if(isset($_GET['recovery'])){echo " showMore('','','','','','','','recovery');xxx=1";}else if(isset($neim) && !empty($neim)){if(isset($_GET['search'])&&!empty($_GET['search'])){echo " showMore('','search=".$_GET['search']."');xxx=1;";}else if(isset($_GET['post'])&&!empty($_GET['post'])){echo " showMore('".$_GET['post']."');xxx=1;";}else if(isset($_GET['profile'])&&!empty($_GET['profile'])){echo " showMore('','','".$_GET['profile']."');xxx=1;";}else if(isset($_GET['mensajes'])){echo " showMore('','','','read');xxx=1;";}else if(isset($_GET['favoritos'])){echo " showMore('','','','','read');xxx=1;";}else if(isset($_GET['friends'])){echo " showMore('','','','','','read');xxx=1;";}else if(isset($_GET['ajustes'])){echo " showMore('','','','','','','ajustes');xxx=1;";}else if(isset($_GET['Inicio'])){echo "showMore('','','','','','','','','inicio');";}echo 'load(1,"'.$nick.'","'.$passwor.'");';}else{echo 'load(0,0,0);';}
?> >
<input type="checkbox" id="navActive"hidden>
<header class="header">
 <h1 style="cursor:pointer"class="title icon-camera2"> PhotoStory
 </h1>
 <table class="button_header">
  <td>
    <span class="icon-refresh"></span>
  </td>
  <td>
   <label for="navActive">
   <span class="icon-menu"></span>
   </label>
  </td>
  <td>
   <span class="icon-search"></span>
  </td>
  <td>
   <span class="icon-notification"></span>
  </td>
 </table>
</header>
<nav id="nav">
    	<aside id="portada">
    		<h3 class="user_name"></h3>
    	</aside>
    	<br>
    	<aside id="nav_contents">
        <?php
        //items de la nav
         $items=['Inicio','Perfil','Favoritos','Notificaciones','Contacto','Configuracion','Compartir','Salir'];
         //iconos de la nav
         $icons=['home','profile','favorite','notifications','contact_mail','settings','share','exit'];
         for($c=0;$c<count($items);$c++){
            if($c===6){
                echo '<aside id="nav_foot">';
            }
            echo '
            <div title="'.$items[$c].'"class="icon-'.$icons[$c].'">
            <span class="texts">'.$items[$c].'</span>
            </div>';
         }
         echo '</aside>';
        ?>
    	</aside>
    </nav>
<div id="unVerified">
<span class="icon-warning"></span>
   <span id="textoAlerta">Se ha enviado un codigo de verificacion a tu correo electronico.
 <br> Por favor verificalo para acceder a todas las funciones
 <form id="VC"onsubmit="return verifyCode();">
  <input name="vC" type="text" placeholder="codigo" required>
  <input type="submit" value="Verificar">
  <span id="resultCode"></span>
 </form>
 </span>
</div>