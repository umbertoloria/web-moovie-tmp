<?php

class Artista extends DBPattern {

	protected $id, $nome, $data_nascita;

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

	public function getNome(): string {
		return $this->nome;
	}

	public function getDataNascita(): string {
		return $this->data_nascita;
	}

}
