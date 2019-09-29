<?php

class SagaHasVideogioco extends DBPattern {

	protected $saga, $videogioco;

	public static function load($saga, $videogioco): ?self {
		try {
			return new self(array($saga, $videogioco));
		} catch (Exception $e) {
			return null;
		}
	}

	// GETTERS

	public function getSaga(): int {
		return $this->saga;
	}

	public function getVideogioco(): int {
		return $this->videogioco;
	}

	// STATICS

	/** @return self[] */
	public static function getFromVideogioco($videogioco): ?array {
		$q = DB::query("SELECT saga FROM saga_has_videogioco WHERE videogioco = ?", $videogioco);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($r[0], $videogioco);
		}
		return $res;
	}

	/** @return self[] */
	public static function getFromSaga($saga): ?array {
		$q = DB::query("SELECT videogioco FROM saga_has_videogioco JOIN videogiochi
						ON saga_has_videogioco.videogioco = videogiochi.id WHERE saga = ? ORDER BY anno", $saga);
		$res = array();
		while ($r = $q->fetch()) {
			$res[] = self::load($saga, $r[0]);
		}
		return $res;
	}

}
