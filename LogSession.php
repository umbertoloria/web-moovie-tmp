<?php

class LogSession {

	public static $BASELINK = "";

	private static $user;

	public static function init() {
//		$uid = @$_COOKIE['uid'];
		self::$user = Utente::load(1);
	}

	public static function user(): Utente {
		return self::$user;
	}

	public static function redirect($msg, $redirect, $delay = 3000) {
		?>
		<script type="text/javascript">
			setTimeout(function () {
				location.href = "<?php echo LogSession::$BASELINK . $redirect; ?>";
			}, <?php echo $delay; ?>);
		</script>
		<?php
		die($msg);
	}

}