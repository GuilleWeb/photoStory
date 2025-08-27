<style type="text/css">
	#logo{
		width: 30%;
		float: left;
		margin-right: 5%;
	}
</style>
<img id="logo"src="https://guilleweb.cf/photoStory/tools/logo.png"alt='logo photoStory'>
<h1>Error 423</h1>
<hr>
<h3>Parece que estas intentando acceder a una pagina a la cual no tienes acceso, o esta bloqueada para tu IP, Computadora, etc.</h3>
<h3>Encuentra mas informacion <a href='https://es.wikipedia.org/wiki/Anexo:Códigos_de_estado_HTTP'>Aqui</a></h3>
<h3>Redirigiendo a pagina autorizada en <mark><b id="count">15</b></mark> segundos<br><button onclick="location.href='https://guilleweb.cf/photoStory'">Regresar ahora</button></h3>
<script type="text/javascript">
$e=document.getElementById('count');
function redirect(){
setTimeout('redirect()',1000);
$e.innerHTML=$e.innerHTML-1;
if($e.innerHTML<1){
location.href='https://guilleweb.cf/photoStory';
}
}
setTimeout(function(){
redirect();
},1000);
</script>