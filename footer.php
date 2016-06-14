<?php
	$refer_parse = parse_url($_SERVER['REQUEST_URI']);
	$url_parse = parse_url($web['url']);
	if($refer_parse['path'] == $url_parse['path']."footer.php") {
		header("Location: ".$web['url']);
		exit();
	}
?>
	</div>

	<div id="footer">
		<div id="footer-datos">
			
			<span style="font-family: Helvetica; color: #333; font-size: 9px;">Copyright <?=$web['nombre'];?> <span onclick="$('body').attr('contenteditable', 'true');$('body').css('-moz-user-select', '');"> &copy </span> <a href="http://alb1183.es">alb1183</a> 2015-<?php echo date("Y"); ?> </span>
			<meta name="copyright" content="Copyright <?=$web['nombre'];?> &copy alb1183 2015-<?php echo date("Y"); ?>">
		</div>
	</div>
	<!--<center>
		<a href="http://www.mysql.com/"><img vspace="5" src="<?=$web['url']; ?>img/mysql2.gif" title="Mysql"></a>
		<a href="http://www.php.net/"><img vspace="5" src="<?=$web['url']; ?>img/php.png" title="PHP"></a>
		<a href="https://developer.mozilla.org/en-US/docs/AJAX"><img vspace="5" src="<?=$web['url']; ?>img/icon_ajax.gif" title="AJAX"></a>
		<a href="http://jquery.com/"><img vspace="5" src="<?=$web['url']; ?>img/jquery.gif" title="JQuery"></a>
		<a href="https://developer.mozilla.org/en-US/docs/CSS"><img vspace="5" src="<?=$web['url']; ?>img/btn_css.gif" title="CSS"></a>
		<a href="http://www.mozilla.org/es-ES/firefox/new/"><img vspace="5" src="<?=$web['url']; ?>img/no-ie.png" title="No al internet explorer"></a>
		<a href="http://www.mozilla.org/es-ES/firefox/new/"><img vspace="5" src="<?=$web['url']; ?>img/firefox.png" title="Firefox es el mejor!"></a>
	</center>-->
</body>