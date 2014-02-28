<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link type="text/css" rel="stylesheet" href="CSS/tt_stylesheet.css"/>
		<link type="text/css" rel="stylesheet" href="../fonts/stylesheet.css"/>
		<title>Iniciar Sesión: Thunder Trials</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
		<script>
			$(document).ready(function(){		        
				var form = document.getElementById('bgform_login');
				if (form.attachEvent) {
				    form.attachEvent("submit", processForm);
				} else {
				    form.addEventListener("submit", processForm);
				}
		    });
			
			function processForm(e) {
			    if (e.preventDefault) e.preventDefault();
		            $('#empty').fadeOut();
		            $('#notregistered').fadeOut();
		            $('#notactivated').fadeOut();
		            $('#password').fadeOut();
		            $('#fail').fadeOut();
				var email, password;
				var errorField = false;
				var errorPassField = false;
				email=$("#login_email").val();
				password=$("#login_password").val();
				
				if(email==null || email=="" ||
						password==null || password==""){
				    $('#empty').fadeIn();
				    return false;
				}else{
					var sourceURL=document.URL;
					console.log(sourceURL);
					
					var formURL=$('#bgform_login').attr('action');
					var URLprefix = formURL.split("/tt/");
					var url = URLprefix[0].concat(formURL);
					console.log(url);
					var methodValue = "acceso";		
					
					$.post( url, {
                           email: email, 
                           password: password,
                           method: methodValue
                     }, function( data ) {
					    var obj = jQuery.parseJSON( data );
		             	console.log(data);
		             	if(obj){
		             		console.log(obj);
		             		if(obj.code){
		             			console.log(obj.code);
				             	if(obj.code==1){
									document.getElementById("bgform").reset();
									return true;
								}
								if(obj.code==8 || obj.code==12){
					             	$('#notregistered').fadeIn();
									return false;
								}
								if(obj.code==11){
					             	$('#notactivated').fadeIn();
									return false;
								}
								if(obj.code==4){
					             	$('#password').fadeIn();
									return false;
								}
		             		}else{
		             			console.log("NO CODE");
		             		}
		             	}else{
		             		console.log("NO JSON");
		             	}
					 }, 'json');
				}
				$('#fail').fadeIn();
				return false;
			}
		</script>
	</head>
	<body class="content">
		<div class="main_container login_wrapper">
		    <div class="content-wrapper">
		    	<div class="parallax_div" id="login">
		    		<div class="center-container">
						<form id="bgform_login" action="https://www.polychoron.org/apps/polychoron/controller/servicios.php" method="post">
							<input type="hidden" name="method" value="acceso"/>
					        <input id="login_email" type="text" name="email" placeholder="Email">
					        <input id="login_password" type="password" name="password" placeholder="Contraseña">
					        
					        <input value="Entrar" type="submit" id="login_button">
					    </form>
					    <div style="display: none;" class="error" id="empty">Todos los campos son requeridos</div>
					    <div style="display: none;" class="error" id="notregistered">No te has registrado como usuario, por favor registrate <a href="index.php#third">aqui</a>.</div>
					    <div style="display: none;" class="error" id="password">Password incorrecto. Si olvidaste tu password, por favor escribenos a info@polychoron.org para asistirte.</div>
					    <div style="display: none;" class="error" id="fail">Error de conexion a servidor, intentalo mas tarde o si el problema persiste, por favor escribenos a info@polychoron.org para asistirte.</div>
					    <div style="display: none;" class="success" id="notactivated">Tu correo no ha sido confirmado, por favor revisa tu buzon de entrada o la seccion de spam y accede al link provisto.</div>
		    		</div>
		    	</div>
		    </div>
		    <div id="footer">
	    		<h5>TODOS LOS DERECHOS RESERVADOS 2014  ©POLYCHORON</h5>
	            <div id="links-footer" class="clearfix">
	                <ul class="clearfix">
	                    <li><a href="index.php">THUNDER TRIALS</a></li>
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