<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link type="text/css" rel="stylesheet" href="CSS/tt_stylesheet.css"/>
		<link type="text/css" rel="stylesheet" href="../fonts/stylesheet.css"/>
		<title>Thunder Trials</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
		<script type="text/javascript" src="https://flesler-plugins.googlecode.com/files/jquery.scrollTo-1.4.2-min.js"></script>
		<script type="text/javascript" src="https://flesler-plugins.googlecode.com/files/jquery.localscroll-1.2.7-min.js"></script>
		<script>
			$(document).ready(function(){
		        $('#nav_links').localScroll({
		           target:'body'
		        });
				
				$('#links-footer').localScroll({
		           target:'body'
		        });
		        
				var form = document.getElementById('bgform');
				if (form.attachEvent) {
				    form.attachEvent("submit", processForm);
				} else {
				    form.addEventListener("submit", processForm);
				}
		    });
			
			function processForm(e) {
			    if (e.preventDefault) e.preventDefault();
		            $('#empty').fadeOut();
		            $('#wrong').fadeOut();
		            $('#finished').fadeOut();
		            $('#registered').fadeOut();
		            $('#nomatch').fadeOut();
		            $('#fail').fadeOut();
				var name, lastName, email, phone, password1, password2, program;
				var errorField = false;
				var errorPassField = false;
				name=$("#nameinput").val();
				email=$("#mailinput").val();
				phone=$("#telephoneinput").val();
				password1=$("#passwordinput").val();
				password2=$("#passwordconfirminput").val();
				program=$("#programinput").val();
				
				if(name==null || name=="" ||
						email==null || email=="" ||
						phone==null || phone=="" ||
						password1==null || password1=="" ||
						password2==null || password2=="" ||
						program==null || program==""){
				    $('#empty').fadeIn();
				    return false;
				}else{
					var at_position=email.indexOf('@');
					var dot_position=email.indexOf('.', at_position);
					var email_size=email.length;
					
					if(!isEmail(email)||(at_position==-1)||(dot_position<(at_position+2))||(dot_position+2>email_size))
						errorField=true;
					if(password1.localeCompare(password2)!=0)
						errorPassField=true;
					//SEPARAR Y CHECAR NOMBRE
					var space_position=name.indexOf(' ');
					if(space_position==-1){
						$('#wrong').fadeIn();
						return false;
					}
					lastName=name.substring(space_position+1);
					name=name.substring(0,space_position);
					//CHECAR TELEFONO
					//TODO
					if(errorField==true){
					    $('#wrong').fadeIn();
					    return false;
					}
					if(errorPassField==true){
					    $('#nomatch').fadeIn();
					    return false;
					}
					
					var sourceURL=document.URL;
					console.log(sourceURL);
					
					var formURL=$('#bgform').attr('action');
					var URLprefix = formURL.split("/tt/");
					var url = URLprefix[0].concat(formURL);
					console.log(url);
					
					var semester, university;
					semester = $('select[name=semestre]').val();
					console.log ( semester );
					university = $('select[name=universidad]').val();
					console.log ( university );
					var methodValue = "registro";
								
					
					$.post( url, { 
                           nombre: name,
                           apellido: lastName,
                           email: email, 
                           password: password1,
                           telefono: phone,
                           carrera: program,
                           semestre: semester,
                           universidad: university,
                           method: methodValue
                     }, function( data ) {
                     	if(typeof data =='object'){
						    var obj = jQuery.parseJSON(JSON.stringify(data));
		             		console.log(obj);
			             	if(obj.code!=null){
		             			console.log(obj.code);
				             	if(obj.code==1){
					             	console.log("registry suceeded.")
					             	$('#finished').fadeIn();
									document.getElementById("bgform").reset();
									return true;
								}
								else if(obj.code==13){
					             	$('#registered').fadeIn();
									return false;
								}else{
									console.log("Registry not suceeded.")
									$('#fail').fadeIn();
								}
		             		}else{
		             			console.log("NO CODE");
		             			$('#fail').fadeIn();
		             		}
		             	}else{
		             		console.log("NO JSON");
		             		$('#fail').fadeIn();
		             	}
					 }, 'json');
				}
				$('#fail').fadeIn();
				return false;
			}
			
			function isEmail(email){
        		return /^([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x22([^\x0d\x22\x5c\x80-\xff]|\x5c[\x00-\x7f])*\x22))*\x40([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d)(\x2e([^\x00-\x20\x22\x28\x29\x2c\x2e\x3a-\x3c\x3e\x40\x5b-\x5d\x7f-\xff]+|\x5b([^\x0d\x5b-\x5d\x80-\xff]|\x5c[\x00-\x7f])*\x5d))*$/.test(email);
			}
		</script>
	</head>
	<body class="content">
		<div class="main_container">
	        <div class="nav_bar_bg">
				<div class="nav_bar" id="nav_links">
					<a href="#about"><img class="nav-logo" src="images/txt-only-logo.png"></a>
					<ul class="nav_list">
						<li class="nav_item"><a class="nav_link" id="first_nav_link" href="#second">Sedes</a></li><li class="nav_item"><a class="nav_link" href="#calendar">Calendario</a></li><li class="nav_item"><a class="nav_link" href="#third">Registro</a></li><li class="nav_item"><a class="nav_link" href="login.php">Participantes</a></li><li class="nav_item"><a class="nav_link" href="../contact.php">Contacto</a></li>
					</ul>
				</div>
			</div>
		    <div class="content-wrapper" id="top">
		    	<div class="parallax_div" id="first">
		    		<div class="thunder-logo-container center-container">
		    			<img class="thundertrials-logo" src="../images/thunder-trials-logo.png"/>
			    		<h1 class="title thundertrials-title">THUNDER TRIALS</h1>
			    		<h2 class="subtitle thundertrials-subtitle">ENERO-MAYO 2014</h2>
		    		</div>
		    	</div>
		    	<div id="about" class="plain_container">
		    		<h1 class="title">ACERCA DEL EVENTO</h1>
		    		<p class="black_text centered_text">
		    			Thunder Trials es un evento enfocado a encontrar universitarios talentosos e impulsarlos para construir start-ups exitosas. A través de 90 días, se seleccionarán a 60 de los mejores alumnos de cada universidad, los cuales formaran equipos multidisciplinarios para concursar por premios increíbles.
		    			El concurso tiene como objetivo el convertir una idea innovadora en un producto mínimo viable que se pueda convertir en negocio, para ello se les proveerá con capacitación, mentoreo y vinculación en las áreas involucradas.
		    			La etapa final del concurso está dedicada a pulir el desarrollo de su proyecto y llevarlo a un jurado con profesionales de área y representantes de fondos de capital privado.<br>
		    			Ahora bien, para la edición Enero-Mayo 2014, los Thunder Trials están enfocados al desarrollo start-ups con aplicaciones móviles. Una área de oportunidad enorme para los negocios, que usualmente viene de la mano de desarrollos de gran escalabilidad y crecimiento acelerado.
		    		</p>
		    		<ul class="circle_list">
		    			<li class="circle_list_item">
		    				<a id="circle1" class="ec-circle">
							</a>
		    			</li>
		    			<li class="circle_list_item">
		    				<a id="circle2" class="ec-circle">
							</a>
		    			</li>
		    			<li class="circle_list_item">
		    				<a id="circle3" class="ec-circle">
							</a>
		    			</li>
		    		</ul>
		    		<h2 class="subtitle">SELECCIÓN</h2>
		    		<p class="black_text centered_text">
		    			El proceso de selección de alumnos se realizará en base a tres criterios: técnico, creativo y negocios. El participante debe elegir el área de su mayor interés y deberá completar una serie de retos para demostrar que es el mejor. 
		    			Estos desafíos buscan encontrar aquellos alumnos con la mayor disposición a emprender, las mejores capacidades como autodidacta y un talento innato. Por ello, en algunas ocasiones no es necesario que el participante requiera amplios conocimientos de la materia.
		    			Se elegirán a los 20 mejor participantes por categoría en cada escuela.
		    		</p>
		    		<ul class="circle_list">
		    			<li class="circle_list_item">
		    				<a id="circle4" class="ec-circle">
							</a>
		    			</li>
		    			<li class="circle_list_item">
		    				<a id="circle5" class="ec-circle">
							</a>
		    			</li>
		    			<li class="circle_list_item">
		    				<a id="circle6" class="ec-circle">
							</a>
		    			</li>
		    		</ul>
		    		<h2 class="subtitle">90 DÍAS PARA FUNDAR TU START-UP</h2>
		    		<p class="black_text centered_text">
		    			Una vez que se han elegido a los 60 concursantes de cada universidad, comienza oficialmente el desarrollo de tu idea de negocio. En los siguiente días, deberás reunir un equipo de 3 personas (uno de cada categoría) a partir de los seleccionados; para ello,
		    			te daremos acceso a una red social privada en la que podrás ver el trabajo de los otros durante los desafíos y comunicarte con ellos. Esta red social estará disponible en este sitio web y en la aplicación oficial del evento, donde también recibirás noticias del evento y serás notificado de 
		    			los cursos, talleres y conferencias que hemos preparado para que puedas construir un producto increíble. Durante los meses consecutivos, deberás ponerte de acuerdo con tu equipo respecto a que desarrollarán, comenzar la construcción de tu producto, buscar mentoría (si la necesitas) y prepararte para la final.
		    		</p>
		    		<h2 class="subtitle">CLAUSURA</h2>
		    		<p class="black_text centered_text">
		    			Para el cierre del evento, los participantes de las diferentes universidades deberán reunirse en la sede de clausura para el evento final, la selección de ganadores y la premiación. Este evento tiene una duración de 10 horas y busca pulir el producto final de los seleccionados para que puedan presentar un 
		    			desarrollo asombroso a inversionistas, profesionales del área, fondos de capital y demás jueces. Entre los premios están: cita con inversionistas interesados en el producto, becas de la incubadora de empresa del ITESM, recursos web para construir una página web, entre muchos otros.
		    		</p>
		    		<h3 class="big-text centered_text">
		    			Descarga la app del evento:
		    		</h3>
		    		<img class="button_gplay" src="images/googleplay-button.png" />
		    	</div>
		    	<div class="parallax_div" id="second">
		    		<div class="center-container">
			    		<h1 class="title thundertrials-title">SEDES</h1>
			    		<img src="images/place01.png" class="center-element place"/>
			    		<img src="images/place02.png" class="center-element place"/>
		    		</div>
		    	</div>
		    	<div id="calendar" class="plain_container">
		    		<h1 class="title">CALENDARIO</h1>
		    		<p class="black_text centered_text">
		    			El evento se realizará en paralelo en ambas sedes y tendrán sus eventos individuales; a excepción de la clausura, la cual se realizará en el ITESM Campus Estado de México.
		    			La inauguración de los Thunder Trials se realizará con una conferencia impartida por uno de los emprendedores tecnológicos mexicanos más reconocidos: Ricardo Gómez Quiñones, fundador de Kaxan Media Group.
		    			Te invitamos a asistir a esta ponencia donde además se ahondará en detalles respecto al evento (bases, premios, etc). 
		    		</p>
		    		<img src="images/opening-banner.png" class="event"/>
		    		<table>
		    			<thead>
		    				<tr class="head">
		    					<th></th>
		    					<th colspan="2">ITESM CEM</th>
		    					<th colspan="2">ITESM TOL</th>
		    					<th></th>
		    				</tr>
		    				<tr class="head">
		    					<th>Evento</th>
		    					<th>Fecha</th>
		    					<th>Lugar</th>
		    					<th>Fecha</th>
		    					<th>Lugar</th>
		    					<th>Duración</th>
		    				</tr>
		    			</thead>
		    			<tbody>
		    				<tr class="odd">
			    				<td>Activación Promocional</td>
			    				<td>18 de Febrero<br>13:00 hrs</td>
			    				<td>Entre Aulas 2 y 3</td>
			    				<td></td>
			    				<td></td>
			    				<td>3 y 1/2 horas</td>
			    			</tr>
			    			<tr>
			    				<td>Conferencia de Apertura</td>
			    				<td>21 de Febrero<br>17:00 hrs</td>
			    				<td>Auditorio de Profesional</td>
			    				<td>20 de Febrero<br>17:30 hrs</td>
			    				<td>Auditorio 2</td>
			    				<td>Aprox. 90 min</td>
			    			</tr>
			    			<tr class="odd">
			    				<td>Cierre Convocatoria</td>
			    				<td colspan="4">23 de Marzo<br>Medios Electrónicos</td>
			    				<td></td>
			    			</tr>
			    			<tr>
			    				<td>Anuncio de Seleccionados</td>
			    				<td colspan="4">26 de Marzo<br>Medios Electrónicos</td>
			    				<td></td>
			    			</tr>
			    			<tr class="odd">
			    				<td>Conferencia de Negocios en Mobile</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Aprox. 3 horas</td>
			    			</tr>
			    			<tr>
			    				<td>Curso de diseño para Mobile</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Aprox. 3 horas</td>
			    			</tr>
			    			<tr class="odd">
			    				<td>Curso de programación Android</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Abril<br>Horario por confirmar</td>
			    				<td>Por confirmar</td>
			    				<td>Aprox. 12 horas</td>
			    			</tr>
			    			<tr>
			    				<td>Clausura</td>
			    				<td colspan="4">23 de Mayo<br>ITESM CEM</td>
			    				<td>Aprox. 10 horas</td>
			    			</tr>
		    			</tbody>
		    		</table>
		    	</div>
		    	<div class="parallax_div" id="third">
		    		<div class="center-container">
			    		<h1 class="title thundertrials-title">REGISTRO</h1>
						<form id="bgform" action="https://www.polychoron.org/apps/polychoron/controller/servicios.php" method="post">
							<input type="hidden" name="method" value="registro"/>
					        <input id="nameinput" type="text" name="nombre" placeholder="Nombre y Apellido">
					        <input type="hidden" name="apellido" value=""/>
					        <input id="mailinput" type="text" name="email" placeholder="Email">
					        <input id="telephoneinput" type="text" name="telefono" placeholder="Teléfono">
					        <input id="passwordinput" type="password" name="password" placeholder="Contraseña">
					        <input id="passwordconfirminput" type="password" name="confirmar_password" placeholder="Confirmación de Contraseña">
							<div class="university-container">
								<p class="label">Universidad</p>
								<select name="universidad">
									<option value="ITESM-CEM" selected>ITESM CEM</option>
									<option value="ITESM-TOL">ITESM TOL</option>
								</select>
							</div>
							<div class="semester-container">
								<p class="label">Semestre</p>
								<select name="semestre">
									<option value="1" selected>1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">+10</option>
									<option value="12">Posgrado</option>
									<option value="13">Exatec</option>
								</select>
							</div>
							<input id="programinput" type="text" name="carrera" placeholder="Carrera (Sólo Siglas)">
					        <input value="Enviar" type="submit" id="sendbutton">
					    </form>
					    <div style="display: none;" class="error" id="empty">Todos los campos son requeridos</div>
					    <div style="display: none;" class="error" id="wrong">Campo con contenido invalido</div>
					    <div style="display: none;" class="error" id="nomatch">Password no coincide</div>
					    <div style="display: none;" class="error" id="registered">Usuario registrado previamente. Por favor, utiliza el correo de confirmación e inicia sesión. Si no recibiste el correo, contáctanos en info@polychoron.org</div>
					    <div style="display: none;" class="error" id="fail">Error en servidor, por favor si no recibes un correo de confirmacion, envianos tus datos a info@polychoron.org</div>
					    <div style="display: none;" class="success" id="finished">Registro satisfactorio</div>
		    		</div>
		    	</div>
		    </div>
		    <div id="footer">
		    	<h5>REDES SOCIALES</h5>
		    	<div class="social_networks_container">
					<a id="button_style_f" href="https://www.facebook.com/polychoronmx">Facebook</a>
					<a id="button_style_t" href="https://twitter.com/polychoron_mx">Twitter</a>
    			</div>
        		<h5>PATROCINADORES Y ALIADOS</h5>
        		<div class="center-container">
        			<img src="images/sponsors.png"/>
	    		</div>
	    		<h5>TODOS LOS DERECHOS RESERVADOS 2014  ©POLYCHORON</h5>
	            <div id="links-footer" class="clearfix">
	                <ul class="clearfix">
	                    <li><a href="#top">INICIO</a></li>
	                    <li><a href="javascript:void(0)">|</a></li>
	                    <li><a href="../">POLYCHORON</a></li>
	                    <li><a href="javascript:void(0)">|</a></li>
	                    <li><a href="../privacy.html">AVISO DE PRIVACIDAD</a></li>
	                </ul>
        		</div>
        	</div>
	    </div>
  	</body>
</html>