<?php

class Regia extends DBPattern {

	protected $film, $regista;

	public static function load($film, $attore): ?self {
		try {
			return new self(array($film, $attore));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getFilm(): int {
		return $this->film;
	}

	public function getRegista(): int {
		return $this->regista;
	}

	// STATICS

	/** @return self[] */
	public static function getFromFilm($film): ?array {
		$q = DB::query("SELECT regista FROM regie JOIN artisti ON regie.regista = artisti.id
						WHERE film = ? ORDER BY nome", $film);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($film, $r[0]);
		}
		return $res;
	}

	/** @return self[] */
	public static function getFromRegista($regista): ?array {
		$q = DB::query("SELECT film FROM regie JOIN films ON regie.film = films.id
						WHERE regista = ? ORDER BY anno DESC", $regista);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0], $regista);
		}
		return $res;
	}

}
