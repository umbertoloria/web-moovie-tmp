<?php

class GenereView implements View {

	public static function put($gid = null) {
		$genere = Genere::load($gid);
		if (!$genere) {
			LogSession::redirect("Genere non presente.", "/");
		}
		echo "<header>{$genere->getNome()}</header>";
		$films = array();
		foreach (FilmHasGenere::getFromGenere($gid) as $fhg) {
			$films[] = Film::load($fhg->getFilm());
		}
		if (count($films) > 0) {
			self::putFilms($films);
		}
	}

	/**
	 * @param $films Film[]
	 */
	private static function putFilms($films) {
		echo "<div class='covers_group'>";
		echo "<ul>";
		foreach ($films as $film) {
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
