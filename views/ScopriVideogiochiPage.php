<?php

class ScopriVideogiochiPage implements View {

	public static function put($args = null) {

		echo "<header>Videogiochi</header>";
		echo "<div class='covers_group'>";
		echo "<ul>";
		foreach (Videogioco::get() as $videogioco) {
			echo "<li class='cover'>";
			echo "<a href='" . LogSession::$BASELINK . "/videogioco/{$videogioco->getId()}'>";
			echo "<img src='" . LogSession::$BASELINK . "/img/videogioco/{$videogioco->getId()}' alt='{$videogioco->getTitolo()}'/>";
			echo "<span>";
			echo $videogioco->getTitolo() . " (" . $videogioco->getAnno() . ")";
			echo "</span>";
			echo "</a>";
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}

}
