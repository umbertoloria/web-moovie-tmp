<?php

class Utente extends DBPattern {

	protected $id, $username, $email, $password, $ruolo;

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

	public function getUsername(): string {
		return $this->username;
	}

	public function getEmail(): string {
		return $this->email;
	}

	public function getPassword(): string {
		return $this->password;
	}

	public function getRuolo(): string {
		return $this->ruolo;
	}

}
