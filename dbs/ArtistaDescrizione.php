<?php

class ArtistaDescrizione extends DBPattern {

	protected $artista, $descrizione;

	public static function load($pk): ?self {
		try {
			return new self($pk);
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getArtista(): int {
		return $this->artista;
	}

	public function getDescrizione(): string {
		return $this->descrizione;
	}

}
