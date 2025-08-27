
<article class="logginPanel">
	<form id="registro" onsubmit="return RegistroVal(this['nombre'].value);">
	<h3>Registro</h3>
		<p>Nombre y Apellido</p> 
		<input title="5 a 15 caracteres" pattern="[A-Za-z- ]{5,15}" name="nombre"type="name" required>
		<p>Correo:</p> 
		<input title="escribe una @ y .com, .es, .net al final"name="correo" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"required>
		<p>Contraseña:</p>
		<input title="8 a 30 caracteres, agrega almenos un numero no simbolos ni espacios" pattern="(?=.*\d).[0-9a-z]{8,30}"name="pass"type="password" required>
		<p>Repite Contraseña:</p>
		<input title="8 a 30 caracteres, agrega almenos un numero no simbolos ni espacios" pattern="(?=.*\d).[0-9a-z]{8,30}" name="pass1"type="" required>
		<br><br>
		<input value="Registrar" type="submit">
	</form><br>
	<div id="resultR"></div>
</article>

<article class="logginPanel">
	<form id="loggin" onsubmit="return LogginVal();">
	<h3>Iniciar</h3>
		<p>Correo:</p> 
		<input value="admin@root.com"title="escribe una @ y .com, .es, .net al final" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" name="user" type="email" required>
		<p>Contraseña:</p>
		<input value="admin12345"title="8 a 30 caracteres, agrega almenos un numero no simbolos ni espacios" pattern="(?=.*\d).[0-9a-z]{8,30}" name="contra"type="password" required>
		<br>
		<p><a href="#"onclick="$('#body').load('tools/recovery.php');">Recuperar contraseña</a></p>
		<br>
		<input value="Entrar" type="submit">
<br><b>correo: </b><i>admin@root.com</i><br><b>pass:</b><i>admin1234</i>
	</form><br>
	<img data-gifffer="https://hongkiat.github.io/gif-onclick/img/get-low.gif"/>

	<div id="resultL"></div>
</article>
