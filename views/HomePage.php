<?php

class HomePage implements View {

	public static function put($arg = null) {
		echo "<header>Film</header>";
		echo "<div id='showcase'>";
		$visioni = Visione::getFromUtente(LogSession::user()->getId());
		foreach ($visioni as $visione) {
			FilmDrawer::drawBox($visione);
		}
		echo "</div>";

		echo "<header>Videogiochi</header>";
		echo "<div id='showcase'>";
		$giocate = Giocata::getFromUtente(LogSession::user()->getId());
		foreach ($giocate as $giocata) {
			VideogiocoDrawer::drawBox($giocata);
		}
		echo "</div>";
	}

}
