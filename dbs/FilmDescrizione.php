<?php

class FilmDescrizione extends DBPattern {

	protected $film, $descrizione;

	public static function load($pk): ?self {
		try {
			return new self($pk);
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getFilm(): int {
		return $this->film;
	}

	public function getDescrizione(): string {
		return $this->descrizione;
	}

}
