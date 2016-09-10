<?

// TODO: Working...

//
session_start();
	$headoffline = 1;
	require("head.php");
if(isset($_SESSION['id'])){
	header("Location: ".$web['url']);
	exit();
} else {
		$error = $_GET["error"];
		$refer = $_GET['refer'];
		if($refer == "salir/" || $refer == "salir.php" || $refer == "acceder/" || $refer == "login.php") {
			$refer_dir = "";
		}else{
			$refer_dir = $refer;
		}
		if ($error == "5"){
			echo '<h3 style="margin: 0px -300px 0px 0px; float: left; width: 650px;">Sesión incorrecta</h3>';
		};
	?>
	<div id="main-col" style="width: 100%; text-align: center;">
	<div style="width: 400px; margin-bottom: auto; display: inline-block;" class="box">
		<script type='text/javascript'>
			window.document.title = "<?=$web['nombre']?> -> Acceder";
				$(document).ready(function()
				{
						$('#boton_login').click(logearse);
						
						$('#acceder').submit(function(e) {   
							logearse();
						  e.preventDefault(); 
						});

						function logearse() {
							$.ajax({
								data:  {
											"login" : $("#login").val(),
											"pass" : $("#pass").val(),
											"refer" : "<?=$refer_dir;?>"
										},
								url:   '<?=$web['url']?>php/login-ajax.php',
								type:  'post',
								dataType : 'json',
								beforeSend: function () {
										$("#infoajax").html("<img src='<?=$web['url']?>img/loading_white.gif'>");
										$("#body").css({"cursor" : "progress"});
								},
								success:  function (data_resp) {
										if(data_resp.error == 1){
											$("#infoajax").html(data_resp.error_mensaje);
										}else if(data_resp.error == 0){
											window.location = data_resp.redireccion;
										}else{
											$("#infoajax").html("Error grave: " + data_resp)
										}
										$("#body").css({"cursor" : "auto"});
								}
							});
						}
				});
		</script>
		<div class="title select">
			<center>
				<h1 style="margin: 0;">
					<img src="<?=$web['url']?>img/lock_32.png">
					Acceso
				</h1>
			</center>
		</div>
		<div class="bloque interior">
			<div style="text-align: center;">
				<form id="acceder">
					<input type="text" name="login" id="login" class="caja_text" style="width: 140px; border-radius: 5px" placeholder="Usuario">
					<br>
					<input type="password" name="pass" id="pass" class="caja_text" style="width: 140px; margin-top: 8px; border-radius: 5px;" placeholder="Contraseña">
					<br>
					<input type="button" id="boton_login" value="Entrar" style="width: 60px; margin-top: 8px; border-radius: 5px;" class="buttonstyle navy caja">
					<br>
					<input type='submit' style="display: none;" value='Entrar'/>
				</form>
				<span id="infoajax" style="width: 650px; color: #747d8b; font-family: Tahoma; font-size: 13px; line-height: 18px; text-align: right;"> </span>
			</div>
		</div>
	</div>
	</div>
	<?
		require("footer.php");
 };
?>