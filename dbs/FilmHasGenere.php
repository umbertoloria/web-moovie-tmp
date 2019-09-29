<?php

class FilmHasGenere extends DBPattern {

	protected $film, $genere;

	public static function load($film, $genere): ?self {
		try {
			return new self(array($film, $genere));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getFilm(): int {
		return $this->film;
	}

	public function getGenere(): int {
		return $this->genere;
	}

	// STATICS

	/** @return self[] */
	public static function getFromFilm($film): ?array {
		$q = DB::query("SELECT genere FROM film_has_genere WHERE film = ?", $film);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($film, $r[0]);
		}
		return $res;
	}

	/** @return self[] */
	public static function getFromGenere($genere): ?array {
		$q = DB::query("SELECT film FROM film_has_genere WHERE genere = ?", $genere);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0], $genere);
		}
		return $res;
	}

}
