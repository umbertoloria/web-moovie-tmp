<?php

class TopMenu implements View {

	public static function put($arg = null) {
		?>
		<div id="topmenu">
			<ul>
				<li>
					<a href="<?php echo LogSession::$BASELINK; ?>/">Home</a>
				</li>
				<li>
					<a href="<?php echo LogSession::$BASELINK; ?>/films">Film</a>
				</li>
				<li>
					<a href="<?php echo LogSession::$BASELINK; ?>/videogiochi">Videogioco</a>
				</li>
				<!--<li>
					<a href="<?php /*echo LogSession::$BASELINK; */ ?>/amici">Amici</a>
				</li>-->
			</ul>
		</div>
		<?php
	}

}
