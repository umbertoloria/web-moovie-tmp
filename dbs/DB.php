<?php

class DB {

	/** @var PDO */
	private static $c;

	public static function init() {
		try {
			$host = "localhost";
			$dbname = "moovie";
			$usr = "root";
			$pwd = "ciaociao";
			self::$c = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usr, $pwd);
		} catch (PDOException $e) {
			die("Errore di connessione: {$e->getMessage()}");
		}
	}

	public static function query(): PDOStatement {
		$args = func_get_args();
		$stmt = self::$c->prepare(array_shift($args));
		$e = $stmt->execute($args);
		if (!$e) {
			return null;
		}
		return $stmt;
	}

	public static function last_inserted_id() {
		return self::$c->lastInsertId();
	}

}

DB::init();
