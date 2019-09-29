<?php

class SagaHasFilm extends DBPattern {

	protected $saga, $film;

	public static function load($saga, $film): ?self {
		try {
			return new self(array($saga, $film));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getSaga(): int {
		return $this->saga;
	}

	public function getFilm(): int {
		return $this->film;
	}

	// STATICS

	/** @return self[] */
	public static function getFromFilm($film): ?array {
		$q = DB::query("SELECT saga FROM saga_has_film WHERE film = ?", $film);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0], $film);
		}
		return $res;
	}

	/** @return self[] */
	public static function getFromSaga($saga): ?array {
		$q = DB::query("SELECT film FROM saga_has_film JOIN films ON saga_has_film.film = films.id
						WHERE saga = ? ORDER BY anno", $saga);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($saga, $r[0]);
		}
		return $res;
	}

}
