<?php

class SoftwareHouse extends DBPattern {

	protected $id, $nome;

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

	/** @return Videogioco[] */
	public function getVideogiochiExceptThis($vid): ?array {
		$q = DB::query("SELECT id FROM videogiochi WHERE software_house = ? and id != ? ORDER BY anno", $this->id, $vid);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = Videogioco::load($r[0]);
		}
		return $res;
	}

}
