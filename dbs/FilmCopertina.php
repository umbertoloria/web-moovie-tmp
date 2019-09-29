<?php

class FilmCopertina extends DBPattern {

	protected $film, $copertina;

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

	public function getCopertina(): string {
		return $this->copertina;
	}

}
