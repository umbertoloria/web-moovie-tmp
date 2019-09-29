<?php

class Giocata extends DBPattern {

	protected $utente, $videogioco, $momento, $voto;

	public static function load($utente, $videogioco): ?self {
		try {
			return new self(array($utente, $videogioco));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getUtente() {
		return $this->utente;
	}

	public function getVideogioco() {
		return $this->videogioco;
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
			SELECT videogioco
			FROM giocate
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
