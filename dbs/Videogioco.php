<?php

class Videogioco extends DBPattern {

	protected $id, $titolo, $anno, $software_house;

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

	public function getAnno(): string {
		return $this->anno;
	}

	public function getSoftwareHouse(): int {
		return $this->software_house;
	}

	// STATICS

	/**
	 * @return self[]
	 */
	public static function get(): array {
		$q = DB::query("SELECT id FROM videogiochi ORDER BY anno DESC");
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0]);
		}
		return $res;
	}

}
