<?php

class VideogiocoDescrizione extends DBPattern {

	protected $videogioco, $descrizione;

	public static function load($pk): ?self {
		try {
			return new self($pk);
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getVideogioco(): int {
		return $this->videogioco;
	}

	public function getDescrizione(): string {
		return $this->descrizione;
	}

}
