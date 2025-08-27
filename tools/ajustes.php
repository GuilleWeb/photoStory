<?php
if(isset($_COOKIE['user'])){
 include('validAcount.php');
 if(xD($_COOKIE['user'])==="false"){
  echo 'Por favor valida tu cuenta para continuar!';
 }else{
    $jsonFile='../usuarios/'.str_replace(' ','_',$_COOKIE['user']).'/style.json';
    $jsonString = file_get_contents($jsonFile);
    $data = json_decode($jsonString, true);
     if(isset($_POST['usar'])){
         $usar=$_POST['usar'];
         if($usar==='true'){
             if($data['usar']==='true'){
                 echo "2";
             }else{
                $data['usar']="true";
                $newJsonString = json_encode($data);
                $enter=file_put_contents($jsonFile,
                $newJsonString);
                if($enter){
                    echo "1";
                }else{
                    echo "0";
                }
             }
         }else if($usar==='false'){
             
             if($data['usar']==='false'){
                 echo "0";
             }else{
                $data['usar'] = "false";
                $newJsonString = json_encode($data);
                $enter=file_put_contents($jsonFile, $newJsonString);
                if($enter){
                    echo "0";
                }else{
                    echo "1";
                }
            }
         }
     }
     if(isset($_POST['elemento'])){
         $el=$_POST['elemento'];
        if($_POST['color1']){
          $c1=$_POST['color1'];
          $data[$el]['fondo'] = $c1;
          $newJsonString = json_encode($data);
          $enter=file_put_contents($jsonFile, $newJsonString);
          if($enter){
            echo "<b>se guardo el color de fondo de ".$el."</b><br>";
          }else{
            echo "<b> error al guardar color de fondo de ".$el." </b><br>";
          }   
        }
        if($_POST['color2']){
          $c2=$_POST['color2'];
         $data[$el]['color'] = $c2;
         $newJsonString = json_encode($data);
         $enter=file_put_contents($jsonFile, $newJsonString);
         if($enter){
            echo "<b>se guardo el color de letra de ".$el."</b>";
         }else{
            echo "<b>error al guardar color de letra</b>";
         }   
        }
        
     }

if(isset($_GET['ajustes']) && $_GET['ajustes'] ==="edit" ){
if($data['usar']==="true"){$check="checked";$label='icon-checkbox-checked';}else{$check="";$label='icon-checkbox-unchecked';}
 echo "<div class='flexbox'>
 <article class='item'><section class='title'>Ajustes de color 
 <label style='float:right;'id='labelCheck'for='actionStyle'title='marca esta opcion para usar los estilos personalizados'class=$label></label>
 <input id='actionStyle'onchange='usarIt(this,event);'type='checkbox' $check hidden>
</section>
<form onsubmit=saveStyles(this,event,'cuerpo'); >
<section class='resum'><b>Cuerpo</b>
 <input type='submit'value='Guardar'><br>
    Fondo del cuerpo: <input type='color' onchange=$('body').css({'background':this.value}) name='color1' value='#ececec'><br>
    Fondo de texto del cuerpo: 
    <input type='color' onchange=$('body').css({'color':this.value}) name='color2' value='#000000'>
</section>
</form>
<form onsubmit=saveStyles(this,event,'cabecera')>
<section class='resum'><b>Cabecera</b> <input type='submit'value='Guardar'><br>
    Fondo del cabecera: <input type='color' onchange=$('header').css({'background':this.value})  value='#4048af' name='color1'><br>
    Color del texto en cabecera: <input type='color' onchange=$('header').css({'color':this.value}); value='#ffffff'name='color2'>
</section>
</form>
<section class='resum'>
<details>
<summary style='cursor:pointer'><b>Nota</b></summary>
1)Para que algunos cambios surjan efecto quiza necesites actualizar la pagina completamente.<br>2) si quieres volver a los estilos por defecto, desmarca la opcion de arriba, o presiona el boton guardar sin haber modificado los colores, si los modificaste prueba actualizando la pagina, despues guardar.
</details>
</section>
</article>
<article class='item'>
<section class='title'>Ajustes de cuenta</section>
<section class='resum'><b>Recibir Notificaciones</b>
<label id='labelCheckNotif'for='actionNotif'title='marca esta opcion para recibir notificaciones'class='icon-checkbox-unchecked'></label>
 <input id='actionNotif'onchange=''type='checkbox'></section>
<section class='resum'><b>Invertir colores</b>
<label id='labelCheckNotif'for='actionInvert'title='marca esta opcion para invertir el color'class='icon-checkbox-unchecked'></label>
 <input id='actionInvert'onchange='nightMode(this.checked)' type='checkbox' ></section>
";
echo "
</section>
<form method='post' onsubmit='editInfo(this,event);' id='formPI'>
<section class='resum'><b>Cambiar contraseña
<input type='submit'value='cambiar'>
<ol>
<input name='passOld'title='8 a 30 caracteres, agrega almenos un numero y/o letra  no simbolos ni espacios' pattern='(?=.*\d).[0-9a-z]{8,30}'placeholder='contraseña actual'type='password'required><br>
<input name='pass'title='8 a 30 caracteres, agrega almenos un numero y/o letra no simbolos ni espacios' pattern='(?=.*\d).[0-9a-z]{8,30}'placeholder='nueva contraseña'type='password'required><br>
<input name='pass2'title='8 a 30 caracteres, agrega almenos un numero y/o letra no simbolos ni espacios' pattern='(?=.*\d).[0-9a-z]{8,30}'placeholder='repetir contraseña'required>
</ol>
<p id='infoAlerts'></p>
</section>
</form>
</article>
</div>";
     }
 }   //header("location://guilleweb.cf/webApp");
}

?>