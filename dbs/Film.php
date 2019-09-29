<?php

class Film extends DBPattern {

	protected $id, $titolo, $durata, $anno;

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

	public function getDurata(): int {
		return $this->durata;
	}

	public function getAnno(): string {
		return $this->anno;
	}

	// STATICS

	public static function esiste(int $id): bool {
		return DB::query("SELECT * FROM films WHERE id = ?", $id)->rowCount() > 0;
	}

	/**
	 * @return self[]
	 */
	public static function get(): array {
		$q = DB::query("SELECT id FROM films ORDER BY anno DESC");
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0]);
		}
		return $res;
	}

}
