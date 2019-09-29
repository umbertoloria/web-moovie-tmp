<?php

class VideogiocoCopertina extends DBPattern {

	protected $videogioco, $copertina;

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

	public function getCopertina(): string {
		return $this->copertina;
	}

}
