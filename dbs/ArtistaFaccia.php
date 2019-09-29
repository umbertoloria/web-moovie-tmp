<?php

class ArtistaFaccia extends DBPattern {

	protected $artista, $faccia;

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

	public function getFaccia(): string {
		return $this->faccia;
	}

}
