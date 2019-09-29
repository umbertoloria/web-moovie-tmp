<?php

class FilmDrawer extends BoxDrawer {

	public static function drawBox(Visione $v) {
		$f = Film::load($v->getFilm());
		$href = LogSession::$BASELINK . "/film/{$f->getId()}";
		$img_src = LogSession::$BASELINK . "/img/film/{$f->getId()}";
		self::draw($href, $img_src, $href, $href, $f->getTitolo(), $v->getVoto(), $f);
	}

}