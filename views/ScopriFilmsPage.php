<?php

class ScopriFilmsPage implements View {

	public static function put($args = null) {

		echo "<header>Film</header>";
		echo "<div class='covers_group'>";
		echo "<ul>";
		foreach (Film::get() as $film) {
			echo "<li class='cover'>";
			echo "<a href='" . LogSession::$BASELINK . "/film/{$film->getId()}'>";
			echo "<img src='" . LogSession::$BASELINK . "/img/film/{$film->getId()}' alt='{$film->getTitolo()}'/>";
			echo "<span>";
			echo $film->getTitolo() . " (" . $film->getAnno() . ")";
			echo "</span>";
			echo "</a>";
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}

}
