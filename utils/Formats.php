<?php

class Formats {

	public static function durata($minuti) {
		if ($minuti > 60) {
			return (int)($minuti / 60) . "h " . ($minuti % 60) . "m";
		}
		return $minuti . "m";
	}

	public static function data($data) {
		$comps = explode("-", $data);
		return (int)($comps[2]) . " " . self::$MESI[$comps[1] - 1] . " " . $comps[0];
	}

	private static $MESI = array(
		"Gennaio", "Febbraio", "Marzo", "Aprile",
		"Maggio", "Giugno", "Luglio", "Agosto",
		"Settembre", "Ottobre", "Novembre", "Dicembre"
	);

}