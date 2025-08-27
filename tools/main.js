window.onerror=function(name){
  alert(name);
}
$userValid=false;$url='cPanel.php';myJson=null;
var reader,xxx=0;
function touch(){
	try{
		document.createEvent('TouchEvent')
		return true;
	}
	catch(e){
		return false;
	}
}
setTimeout(
	function(){
		//location.reload();
	}
,2000);
var activate=false;
function searchA(){
	if(activate==false){
		$div=document.createElement("div");
		$div.id="seachDiv";
		document.body.appendChild($div)
		$div.innerHTML="<form id='formBuscarEle'><input placeholder='buscar'name='search'required autofocus><br><br><input type='submit'></form>";
		activate=true;
$("#formBuscarEle").submit(function(e){
data=$("#formBuscarEle").serialize();
showMore('',data,'')
return false;
});
	}else{
		$div.remove();
		activate=false;
	}
}
//funcion principal
function load(x,name,qwerty){
	if(x==1 || x=="1"){
    if(xxx!=1){
      console.log(xxx);
    $('title').html('PS | Inicio');
     document.querySelector(".icon-home").click();
    }
    $(".icon-home,.icon-camera2").click(function(){
    //history.go(-1);
        $('title').html('PS|inicio');
        $url='cPanel.php';
        $("#body").load("cPanel.php");
        window.history.pushState("","home","?Inicio");
    });
    $(".icon-search").click(function(){
        searchA();
    });
    name=name.replace('_',' ');
		$userValid=true;
		$(".user_name").html(name);
    $('.icon-profile').click(function(){
    showMore('','',Base64.encode(name),'','','','','');
     });
    $('.icon-message').click(function(){
    showMore('','','','this','','','');
     });
    $('.icon-favorite').click(function(){
    showMore('','','','','this','','');
     });
    $('.icon-people').click(function(){
    showMore('','','','','',Base64.encode(name),'');
     });
    $('.icon-settings').click(function(){
    showMore('','','','','','','this');
     });
     	$(".icon-search").css("display","block");
		//boton salir
		$(".icon-exit").click(function(){
		$(".user_name").html("Invitado");
		document.cookie="user=;max-age=0;";
		document.cookie="qwerty=false;max-age=0;";
		$userValid=false;
		$(".icon-refresh").css("display","none");
		$("#body").load("loggin.php");
		$("#loadding").css({"display":"block"});
		setTimeout(function(){
		$("#loadding").css({"display":"none"});
		},1000);
		$(".icon-search").css("display","none");
		$(".icon-exit").css("display","none");
        $("#unVerified").css("display","none");
		});
	//boton reload
	$(".icon-refresh").click(function(){
    $("#body").load($url);
	$("#loadding").css({"display":"block"});
	setTimeout(function(){
	$("#loadding").css({"display":"none"});
	},1000);
  //window.history.pushState("","home","");
	});
	$(".icon-exit").css("display","inline-block");
	$(".icon-refresh").css("display","block");
	document.cookie="user="+name+";";
	document.cookie="qwerty="+qwerty+";";
	//$('#body').load('cpanel.php');
	}else{
		$userValid=false;
    $("#unVerified").css("display","none");
		$(".user_name").html("Invitado");
		$(".icon-exit").css("display","none");
		$(".icon-refresh").css("display","none");
		$(".icon-search").css("display","none");
		$('#navContainer').load('tools/nav.php');
		$('#body').load('loggin.php');
	}
}
//cambiar foto
var activateP=false;
function photoChange(){
  if(activateP==false){
    divP=document.createElement("div");
    divP.id="editPanelP";
    document.body.appendChild(divP)
    divP.innerHTML="<b class='title'>Elige una nueva foto de perfil</b><form method='post'onsubmit='editPhoto(this,event)'id='formPU' enctype='multipart/form-data'><input onchange='leerMediaPro(event)' type='file'name='photo'id='fotoUplProfile'required hidden><br><label title='agregar una foto'for='fotoUplProfile'><span id='imgPrevProfile'><img src='tools/logo.png'></span></label><br><input type='submit'value='Cambiar'> <input id='closeFoto'type='button'value='cerrar'onclick='photoChange()'><p id='fotoAlerts'></p></form>";
    activateP=true;
/*$("#closeFoto").click(function(){
      $(".icon-photo_camera").click();
});*/
  }else{
    divP.remove();
    activateP=false;
  }
}
function editPhoto(form,e){
 var url = "tools/editInfo.php?changeFoto=true&id="+idUser;
 var datos = new FormData(form);
 $('#fotoAlerts').html("Subiendo foto");
 try{
    $.ajax({
        url: url,
        type: "post",
        dataType: "html",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            $("#fotoAlerts").css({"color":"#df0056"});
            if(data==="1"){
             $('#fotoAlerts').html("Foto actualizada, si no la puedes ver, prueba actualizando la pagina completamente");
            setTimeout(function(){
                
                //$(".icon-photo_camera").click();
                $("#body").load($url);photoChange(); },2500);
            }else if(data==="2"){
                $('#fotoAlerts').html("Elige un archivo de imagen");
            }else if(data==="0"){
                $('#fotoAlerts').html("No se pudo actualizar,<br> intenta de nuevo mas tarde");
            }else{
                $('#fotoAlerts').html(data);
            }
        },
        error: function(error){
            $('#fotoAlerts').html(data);
        }
  });
}catch(error){
    alert(error);
}
  /*.done(function(res){
   $("#loadding").html(res);
  });*/
  e.preventDefault();
}
//editar info
var activateI=false;
function infoChange(descr){
  if(activateI==false){
    divI=document.createElement("div");
    divI.id="editPanelI";
    document.querySelector(".profileInfo1").appendChild(divI)
    divI.innerHTML="<form method='post'onsubmit='editInfo(this,event)'id='formPI'>Info<br><br><textarea max-length='150'placeholder='Informacion de usuario'name='info'>"+Base64.decode(descr).replace(/_/gi,' ')+"</textarea><br><input type='submit'value='Actualizar'> <input id='closeInfo'type='button'value='cerrar'><p id='infoAlerts'></p></form>";
    activateI=true;
  $("#closeInfo").click(function(){
      $(".icon-mode_edit").click();
  });
      
  }else{
    divI.remove();
    activateI=false;
  }
}
function editInfo(form,e){
var url = "tools/editInfo.php?id="+idUser;
 $.ajax({                        
  type: "POST",                 
  url: url,                     
  data: $("#formPI").serialize(), 
  success: function(data){
  if(data=="1"){
     dat="Tu informacion ha sido actualizada correctamente, si modificaste tu comtraseña o nombre, sera necesario cerrar sesion para que los cambios se apliquen.";
  }else if(data=="0"){
     dat="Error al actuallizar datos, puede que no hayas cumplido los requisitos, si esto problema continua despues de haber colocado los datos correctamente, por favor ponte en contacto con nosotros";
  }else if(data=="3"){
    dat="No has modificado ni un campo, no se actualizo nada.";
  }else{
      dat=data;
  }
   $("#infoAlerts").html(dat);
   $("#infoAlerts").css({"color":"#df0056"});
   setTimeout(function(){
	  $("#infoAlerts").html("");
	  $("#infoAlerts").css({"border":"0"});	
   },13000);               
  }
 });
e.preventDefault();
}
function follow(id){
var url = "tools/friends.php?follow="+id+"&myID="+idUser;
 $.ajax({
  url: url,
  success: function(data){
   if(data=="0"||data==0){
    //dejar de seguir
    $(".icon-remove").attr('title','Seguir a este usuario');
    $(".icon-remove").attr('class','icon-add');
   }else if (data=="1"||data==1){
    //seguir
    $(".icon-add").attr('title','Dejar de seguir');
    $(".icon-add").attr('class','icon-remove');
   }else if (data=="5"||data==5){
    //error al seguir
   }else{
       alert(data);
   }
  }
 });
}
$(document).ready(function(){
  $("#loadding").css({"display":"block"});
	setTimeout(function(){
	$("#loadding").css({"display":"none"});
	},1000);
	     $activeCopy=false;
	    $('.icon-share').click(function(){
      if($activeCopy===false){
      $activeCopy=true;
      comand='document.execCommand("copy")';
      cS=document.createElement('div');
      cS.id='copySection';
      cS.innerHTML="Presiona el cuadro del enlace que quieres copiar, y este lo hara automaticamente<br>Esta seccion: <textarea onClick='this.select();"+comand+"' readonly>"+document.URL+"</textarea><br>Pagina principal: <textarea onClick='this.select();"+comand+"' readonly>https://guilleweb.cf/webApp</textarea><br>Mi pagina de inicio: <textarea onClick='this.select();"+comand+"' readonly>https://guilleweb.cf</textarea><br><input type='submit'id='closeCopy'value='Cerrar'required> <mark id='mark'></mark>";
      if(document.body.appendChild(cS)){
          $activeCopy=true;
      }
      $("#closeCopy").click(function(){
        cS.remove();
      });
      cS.addEventListener("copy",function(){
        $("#mark").html(" enlace copiado");
      });
    }else{
        $activeCopy=false;
        cS.remove();
    }
    });
	window.addEventListener('offline',function(){
	$(".icon-notification").css({"display":"block"})
	$(".icon-notification").click(function(){
	 $("#loadding").css({"display":"block"});
	 $("#loadding").html("<span class='icon-warning'></span> Parece que no estas conectado a internet");
	 setTimeout(function(){
	  $("#loadding").css({"display":"none"});
	 },5000);
	});
	});
	window.addEventListener('online',function(){
	$(".icon-notification").css({"display":"none"})
	});
});
function rem(i,ii){
 if(i){
 favo(i);
 $("#MyFav"+i).remove();
 }else if(ii){
  $cd=ii.split(",");
  for($x=0;$x<$cd.length-1;$x++){
    favo($cd[$x]);
  }
  alert('se han borrado todas');
  $("#body").load($url);
 }
}
function ver(i){
  //e=$("#MyFav"+i);
  $("#MyFav"+i).children(".title").click();
  //s.click();
}
function borrarPub(i){
$con=confirm("seguro que quieres borrar esta publicacion?");
if($con==true){
 var url = "tools/borrar.php?element="+i;
 $.ajax({  
  url: url,
  success: function(data){
    if(data==1 || data=="1"){
     alert('se ha borrado de esta historia');
     $("#body").load($url);  
    }else if(data==0 || data=="0"){
      alert('tu no eres el creador de esta historia, \n si no te gusta puedes denunciarla.');
    }else{
     alert(data);
    }
  }
 });
}
}
editPubAppend=true;
function editarPub(i,t){
var src=$("#MyFav"+i+" img").attr("src");
//t=t.replace();
if(t!=undefined){
t=Base64.decode(t);
if(editPubAppend){
var formPub = document.createElement('div');
formPub.id='editPub';
formPub.innerHTML="<form id='editForm'onsubmit='return editarPub("+i+");'><b>Editar</b><br><input title='5 a 20 caracteres' pattern='.{5,20}' type='name'placeholder='titulo'name='title'value='"+t+"'><br><input type='hidden'name='id'value='"+i+"'><br><textarea title='15 a 1000 caracteres' placeholder='Escribe una historia para tu foto' minlength='15' maxlength='1000'name='history'></textarea><br><p id='editAlert'></p><img width='200px'height='200px'src="+src+"><br><input type='submit'value='Actualizar'> <input id='closeEditPub'type='button'value='cerrar'required></form>";
$("#body").append(formPub);
$("#closeEditPub").click(function(){
    $("#editPub").remove();
    editPubAppend=true;
});
editPubAppend=false;
}else{
     $("#editPub").remove();
    editPubAppend=true;
}
}else{
    var dataE = $("#editForm").serialize();
    $.ajax({                        
      type: "POST",                 
      url: "tools/borrar.php?edit=yes",                     
      data: $("#editForm").serialize(), 
      success: function(data){
                $("#editAlert").html(data);
            //alert(data)
        },
        error: function(error){
            //alert(error.error)
            $("#editAlert").html(error);
        }
    });
}
return false;
}
function contextMenuFav(id,e){
if(!document.getElementById("MenuFav")){
  $d=document.createElement("fieldset");
  $d.setAttribute("id","MenuFav");
  $d.innerHTML="<legend>Opciones</legend><section class='icon-delete'onclick='rem("+id+")' >Quitar</section><section class='icon-eye'onclick='ver("+id+")'>Ver</section>";
  document.body.appendChild($d);
  $d.style.top=e.pageY+'px';
  $d.style.left=e.pageX+'px';
  document.body.addEventListener('click',function(){
    $d.remove();
  })
}else{
  $d.remove();
}
return false;
}
function contextMenuEdit(id,e2,elemet,title){
//title=Base64.decode(title);
//title.replace(" ","_");
var elem=$("#"+elemet.id).offset();
//alert(elem.left+' top: '+elem.top)
if(!document.getElementById("MenuEdit")){
  $ed=document.createElement("fieldset");
  $ed.setAttribute("id","MenuEdit");
  $ed.innerHTML="<legend>Opciones</legend><section class='icon-mode_edit'onclick=editarPub("+id+",'"+title+"')>Editar</section><section class='icon-delete'onclick='borrarPub("+id+")'>Borrar</section><section class='icon-eye'onclick='ver("+id+")'>Ver</section>";
  document.body.appendChild($ed);
  $ed.style.top=e2.pageY+'px';//e2.pageY/2+'px';
  $ed.style.left=e2.pageX+'px';//e2.pageX/2+'px';
  //alert('x: '+e2.pageX+' y: '+e2.pageY)
  document.body.addEventListener('click',function(){
    $ed.remove();
  })
}else{
  alert(false)
  $ed.remove();
}
e2.preventDefault();
}
function myDrag(){
  v=document.getElementById('moveAction');
  if(touch()==true){
  document.body.setAttribute("ontouchmove","touchMove(event)");
  document.getElementById('Alert').innerHTML="Arrastra esta ventana hasta la posicion donde desees, tocala dos veces para soltar";	
  }else{
  document.body.setAttribute("onMouseMove","mover(event)");
  document.getElementById('Alert').innerHTML="Mueve el puntero hacia la posicion que quieres colacar la ventana, has doble click para soltarla";	
  }

  $('#publicSection').css({"opacity":".8","box-shadow":"0 0 15px red"});
  $off=true;
}
function mover(event){
  if($off==true){
    form=document.getElementById('publicSection');
    form.style.left=-50+event.clientX+'px';
    form.style.top=-50+event.clientY+'px';
    form.addEventListener('dblclick',function(){
    	document.body.removeAttribute("onMouseMove");
    	document.getElementById('Alert').innerHTML="";
  $('#publicSection').css({"opacity":"1","box-shadow":"0 0 15px gray"});
    	$off=false;
    });
  }
}
function touchMove(event){
  if($off==true){
  touched=event.targetTouches[0];
  document.body.style.position="fixed";
  form=document.getElementById('publicSection');
  form.style.transition="0s linear";
  form.style.left=-25+touched.pageX+'px';
  form.style.top=-25+touched.pageY+'px';
  form.addEventListener('dblclick',function(){
    	document.body.removeAttribute("ontouchmove");
    	document.getElementById('Alert').innerHTML="";
  $('#publicSection').css({"opacity":"1","box-shadow":"0 0 15px gray"});
  document.body.style.position="";
    	$off=false;
    });
  }
}
function showDialodP(){
  if($("#publicSection").css("display")=="none"){
  	$("#publicSection").css("display","block");
  	$("#publicSection").css("-webkit-animation","tras .5s");
  }else{
  	$("#publicSection").css("-webkit-animation","trasOff .5s");
  	setTimeout(function(){
  	 $("#publicSection").css("display","none");
  	},500);

  }
}
function verifyCode(){
 var url = "tools/code.php";
 $.ajax({                        
  type: "POST",                 
  url: url,                     
  data: $("#VC").serialize(), 
  success: function(data){
   $("#resultCode").html(data);
   $("#resultCode").css({"background":"#ececec","color":"#df0056"});
   setTimeout(function(){
	  $("#resultÇCode").html("");
	  $("#resultCode").css({"border":"0"});	
   },10000);               
  }
 });
 return false;
}
function RegistroVal(nam){
   // $('#registro').submit(function(){
 if(nam.indexOf(" ") === -1){
  $('#resultR').html('Hemos detectado que tu nombre no tiene espacios, deberas colocar un espacio entre tu nombre y apellido,<br> <b>ej: Guillermo Palma</b>');
 }else{
  var url = "tools/registro.php";
  $.ajax({                        
   type: "POST",                 
   url: url,                     
   data: $("#registro").serialize(), 
   success: function(data){
    $('#resultR').html(data);
    $("#resultR").css({"background":"#ececec","border":"solid 1px #4048af","color":"#df0056"});
    setTimeout(function(){
     $("#resultR").html("");
     $("#resultR").css({"border":"0"});
    },10000);
   }
  });
 }
 return false;
}
function LogginVal(){
 var url = "tools/loggin.php";
 $.ajax({                        
  type: "POST",                 
  url: url,                     
  data: $("#loggin").serialize(), 
  success: function(data){
   $("#resultL").html(data);
   $("#resultL").css({"background":"#ececec","border":"solid 1px #4048af","color":"#df0056"});
   setTimeout(function(){
	  $("#resultL").html("");
	  $("#resultL").css({"border":"0"});	
   },10000);               
  }
 });
return false;
}
function aplli(){
  var f = $(this);
  var formData = new FormData(document.getElementById("publicarForm"));
  formData.append("dato", "valor");
  $.ajax({
    url: "tools/public.php",
    type: "post",
    dataType: "html",
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  })
  .done(function(res){
   $("#Alert").html(res);
  });
return false;
}
//agregar a fovoritos
function favo(id){
 var url = "tools/favorites.php?this="+id;
 $.ajax({
  url: url,
  success: function(data){
   fav=$("#this_"+id);
   if(data=="0"||data==0){
    fav.css({"color":"#4048af"}); 
    fav.html(fav.html()-1);
   }else if (data=="3"||data==3){
    alert(false);
   }else if (data=="5"||data==5){
    alert('Por favor valida tu cuenta para continuar');
   }else{
    fav.css({"color":"#df0056"});
    fav.html(data);
    //$("#this_"+id).html();
   }
  }
 });
return false;
}
// Download function
function desca(id, elem) {
    var url = "tools/functions.php?desca=" + encodeURIComponent(id);
    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            if (data.status === 'success') {
                // Update the download count in the element's HTML
                $(elem).text(" "+data.downloads);
                
                // Trigger image download
                alert(data.imageUrl)
                var link = document.createElement('a');
                link.href = data.imageUrl;
                link.download = data.imageUrl.split('/').pop(); // Use the file name from URL
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                alert('Error: ' + data.message);
            }
        },
        error: function() {
            alert('Error connecting to the server');
        }
    });
    return false;
}

// Share function
function share(id, elem) {
    var url = "tools/functions.php?share=" + encodeURIComponent(id);
    $.ajax({
        url: url,
        dataType: 'json',
        success: function(data) {
            if (data.status === 'success') {
                // Update the share count in the element's HTML
                $(elem).text(" "+data.shares);
                
                // Show prompt with shareable link
                var userConfirmed = prompt('Presione OK para copiar el enlace para compartir:', data.shareUrl);
                if (userConfirmed !== null) {
                    // Copy link to clipboard
                    navigator.clipboard.writeText(data.shareUrl)
                        .then(() => alert('¡Enlace copiado al portapapeles!'))
                        .catch(() => alert('No se pudo copiar el enlace'));
                }
            } else {
                alert('Error: ' + data.message);
            }
        },
        error: function() {
            alert('Error connecting to the server');
        }
    });
    return false;
}
//leer media de perfil
function leerMediaPro(e){
        var archivoM=e.target.files[0],error=0,elementoM=document.getElementById('imgPrevProfile')
      if (!archivoM) {
        return;
      }
    var lectorM = new FileReader();
    lectorM.onprogress=loadProg;
    lectorM.onload = function(e) {
    var contenidoM = e.target.result;
    $vaI=new Array('jpg','jpeg','gif','png');
    $tipo=archivoM.type;
    $siz=archivoM.size/1024+'';
  //valida fotos
    for(x=0;x<$vaI.length;x++){
     if($tipo=="image/"+$vaI[x]){
        if($siz<5000){
      elementoM.innerHTML="<small>"+archivoM.name+"</small> <br> <img src='"+contenidoM+"'><br>"+$siz.substr(0,5)+" kb<b> | </b><span class='icon-delete quita'></span>";
        $('.quita').click(function(){
        document.getElementById('fotoUplProfile').value="";
        lectorM=" ";
        e=" ";
        elementoM.innerHTML="";
        });
        error=1;
        }
     }
    }
    if(error<1){
    elementoM.innerHTML="El archivo elegido no es compatible, o es mayor a 5mb";
    setTimeout(function(){
        elementoM.innerHTML="";
    },5000)
    }
    };
      lectorM.readAsDataURL(archivoM);
}
//---------mostrar video/imagen.-------------
function leerMedia(e){
        var archivoM=e.target.files[0],error=0,elementoM=document.getElementById('imgPrev'),prog=document.getElementById("prog");
      if (!archivoM) {
        return;
      }
    var lectorM = new FileReader();
    prog.hidden=false;
    lectorM.onprogress=loadProg;
    lectorM.onload = function(e) {
    var contenidoM = e.target.result;
    $vaI=new Array('jpg','jpeg','gif','png');
    $tipo=archivoM.type;
    $siz=archivoM.size/1024+'';
  //valida fotos
    for(x=0;x<$vaI.length;x++){
     if($tipo=="image/"+$vaI[x]){
        if($siz<5000){
      elementoM.innerHTML="<small>"+archivoM.name+"</small> <br> <img src='"+contenidoM+"'>"+$siz.substr(0,5)+" kb<b> | </b><span class='icon-delete quita'></span>";
        $('.quita').click(function(){
        document.getElementById('fotoUpl').value="";
        lectorM=" ";
        e=" ";
        elementoM.innerHTML="";
        });
        error=1;
        }
     }
    }
    if(error<1){
    elementoM.innerHTML="El archivo elegido no es compatible, o es mayor a 5mb";
    setTimeout(function(){
        elementoM.innerHTML="";
    },5000)
    }
    };
      lectorM.readAsDataURL(archivoM);
}
function loadProg(e){
    error=0;
    prog.max=e.total;
    prog.value=e.loaded;
    if(e.loaded==e.total){
    setTimeout(function(){
        prog.hidden=true;
        //prog.style.display="none";
    },3500)
    }
}
function mostrarContenidoM(contenidoM) {
var elementoM=document.getElementById('imgPrev');
elementoM.innerHTML="<img src='"+contenidoM+"' >";
}
//--------------mostrar textos----------------
function leerArchivo(e) {
  var archivo = e.target.files[0],elementoT=document.getElementById('imgPrev');
  if (!archivo) {
    return;
  }
  var lector = new FileReader();
  lector.onload = function(e) {
    var contenido = e.target.result;
    if(archivo.type=="text/plain"){
        mostrarContenido(contenido);
    }else{
        elementoT.innerHTML="No es un .txt";
    }
  };
  lector.readAsText(archivo);
}
function mostrarContenido(contenido){
  var elemento = document.getElementById('texto');
  elemento.value = contenido;
}
//mostrar las publicaciones individuales
function showMore(title,caract,profile,msm,favo,friends,settings,recovery,inicio){
$("#loadding").css({"display":"block"});
    setTimeout(function(){
    $("#loadding").css({"display":"none"});
},500);
if(title.length>0){//muestra una historia
 $('title').html('PS | '+Base64.decode(title));
 $url='tools/showMore.php?post='+title;
 $("#body").load("tools/showMore.php?post="+title);
 window.history.pushState("", "post", "?post="+title);
}else if(caract.length>0){//muestra busqueda
  $('title').html('PS | '+caract);
  $url='tools/showMore.php?'+caract;
  $("#body").load("tools/showMore.php?"+caract);
  window.history.pushState("", "search", "?"+caract);
}else if(profile.length>0){//muetra perfil
  $('title').html('PS | '+Base64.decode(profile));
  $url='tools/perfil.php?profile='+profile;
  $('#body').load('tools/perfil.php?profile='+profile);
  window.history.pushState("","profile","?profile="+profile);
}else if(msm.length>0){//muestra mensajes
 $('title').html('PS | mensajes');
 $url='tools/mensajes.php?mensajes';
 $('#body').load('tools/mensajes.php?mensajes');
 window.history.pushState("","inbox","?mensajes");
}else if(favo.length>0){//muestra favoritos
 $('title').html('PS | Favoritos');
 $url='tools/favorites.php?favoritos';
 $('#body').load('tools/favorites.php?favoritos');
 window.history.pushState("","favorite","?favoritos");
}else if(friends.length>0){//muestra amigos
 $('title').html('PS | amigos');
 $url='tools/friends.php?friends';
 $('#body').load('tools/friends.php?friends');
 window.history.pushState("","friends","?friends");
}else if(settings.length>0){//muestra ajustes
 $('title').html('PS | ajustes');
 $url='tools/ajustes.php?ajustes=edit';
 $('#body').load('tools/ajustes.php?ajustes=edit');
 window.history.pushState("","ajustes","?ajustes=edit");
}else if(recovery.length>0){
 $('title').html('PS | recuperar contraseña');
 $url='tools/recovery.php?recovery';
 $('#body').load('tools/recovery.php?recovery');
 window.history.pushState("","recovery","?recovery");
}else if(inicio.length>0){
$('title').html('PS | Inicio');
 $url='cPanel.php?Inicio';
 $('#body').load('cPanel.php');
 window.history.pushState("","Inicio","?Inicio");
}
}

//aplicar cambios de ajustes colores
    function saveStyles(form,e,DD){
    if(DD=="enable"){
      $data={"usar" : "true"};  
    }else if(DD=="disable"){
       $data={"usar" : "false"};
    }else{
      $data = {
      "elemento" : DD,
      "color1" : form.color1.value,
      "color2" : form.color2.value
      }
        //$data="&elemento="+DD+"&color1="+form.color1.value+"&color2="+form.color2.value;        
    }
var url = "tools/ajustes.php",aler=null;
 $.ajax({                        
  type: "POST",                 
  url: url,                     
  data:$data,
  datatype: "text",
  success: function(data){ 
      if(data==="1"){
          $('#labelCheck').attr('class','icon-checkbox-checked');
          aler="<b>Se han activado los estilos.</b>";
      }else if(data==="0"){
          $('#labelCheck').attr('class','icon-checkbox-unchecked');
          aler="<b>Se han desactivado los estilos.</b>";
      }else if(data==="2"){
          $('#labelCheck').attr('class','icon-checkbox-checked');
          aler="<b>Error, intenta de nuevo mas tarde.</b>";
      }else{
          aler=data;
      }
$("#loadding").css({"display":"block"});
$("#loadding").html(aler);
    setTimeout(function(){
    $("#loadding").css({"display":"none"});
    $("#loadding").html("<span class='icon-toys'></span>Cargando...");
    },5000);
},
  error: function(error){   
      alert(error);
  }
});
    e.preventDefault();
    }
    function usarIt(bol,e){
        if(bol.checked==true){
            saveStyles(null,e,"enable");
        }else{
            saveStyles(null,e,"disable");
        }
    }

//modo nocturno
function nightMode(boolean){
    if(boolean){
        $('#body').css('filter','invert(100%)');
        alert("El color invertido puede ocasionar errores");
    }else{
        $('#body').css('filter','invert(0%)');
    }
}














//base 64 encode/decode
var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}