<?php

class VideogiocoDrawer extends BoxDrawer {

	public static function drawBox(Giocata $g) {
		$v = Videogioco::load($g->getVideogioco());
		$voto = $g->getVoto();
		$href = LogSession::$BASELINK . "/videogioco/{$v->getId()}";
		$img_src = LogSession::$BASELINK . "/img/videogioco/{$v->getId()}";
		$titolo = $v->getTitolo();
		self::draw($href, $img_src, $href, $href, $titolo, $voto, $v);
	}

}
