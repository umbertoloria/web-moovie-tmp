<?php

class Recitazione extends DBPattern {

	protected $film, $attore, $personaggio;

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

	public function getAttore(): int {
		return $this->attore;
	}

	public function getPersonaggio(): string {
		return $this->personaggio;
	}

	// STATICS

	/** @return self[] */
	public static function getFromFilm($film): ?array {
		$q = DB::query("SELECT attore FROM recitazioni JOIN artisti ON recitazioni.attore = artisti.id
						WHERE film = ? ORDER BY nome", $film);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($film, $r[0]);
		}
		return $res;
	}

	/** @return self[] */
	public static function getFromAttore($attore): ?array {
		$q = DB::query("SELECT film FROM recitazioni JOIN films ON recitazioni.film = films.id
						WHERE attore = ? ORDER BY anno DESC", $attore);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0], $attore);
		}
		return $res;
	}

}
