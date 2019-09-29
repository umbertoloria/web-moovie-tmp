<?php

class Visione extends DBPattern {

	protected $utente, $film, $momento, $voto;

	public static function load($utente, $film): ?self {
		try {
			return new self(array($utente, $film));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getUtente() {
		return $this->utente;
	}

	public function getFilm() {
		return $this->film;
	}

	public function getMomento() {
		return $this->momento;
	}

	public function getVoto() {
		return $this->voto;
	}

	// STATICS

	/** @return self[] */
	public static function getFromUtente($utente): ?array {
		$q = DB::query("
			SELECT film
			FROM visioni
			WHERE utente = ?
			ORDER BY (voto IS NOT NULL), momento DESC
		", $utente);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($utente, $r[0]);
		}
		return $res;
	}

}
