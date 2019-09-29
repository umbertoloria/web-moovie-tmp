<?php

class Head implements View {

	public static function put($arg = null) {
		?>
		<!DOCTYPE html>
		<head>
			<title>Gestore Film e Videogiochi</title>
			<meta name="author" content="Umberto Loria">
			<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/format.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/form.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/topmenu.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/showcase.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/scheda.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/infolist.css"/>
			<link rel="stylesheet" type="text/css" href="<?php echo LogSession::$BASELINK; ?>/css/covers_group.css"/>
			<script src="<?php echo LogSession::$BASELINK; ?>/js/jQuery.min.js"></script>
			<script src="<?php echo LogSession::$BASELINK; ?>/js/forms.js"></script>
		</head>
		<body>
		<?php
	}

}
