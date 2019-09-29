<?php

class ImageViewer implements View {

	public static function put($arg = null) {
		if (count($arg) != 2 || empty($arg[0]) || empty($arg[1])) {
			LogSession::redirect("Immagine non valida.", "/");
		}
		$img = "";
		if ($arg[0] == "artista") {
			$img = @ArtistaFaccia::load($arg[1])->getFaccia();
		} elseif ($arg[0] == "film") {
			$img = @FilmCopertina::load($arg[1])->getCopertina();
		} elseif ($arg[0] == "videogioco") {
			$img = @VideogiocoCopertina::load($arg[1])->getCopertina();
		}

		if (!empty($img)) {
			header("Content-type: image/jpg");
			echo $img;
		}
	}

}
