<?php

class SagaVideoludica extends DBPattern {

	protected $id, $titolo;

	public static function load($pk): ?self {
		try {
			return new self($pk);
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getId(): int {
		return $this->id;
	}

	public function getTitolo(): string {
		return $this->titolo;
	}

}
