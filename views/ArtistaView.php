<?php

class ArtistaView implements View {

	public static function put($aid = null) {
		$artista = Artista::load($aid);
		if (!$artista) {
			LogSession::redirect("Artista non presente.", "/");
		}
		$descrizione = ArtistaDescrizione::load($aid)->getDescrizione();
		$recitazioni = Recitazione::getFromAttore($aid);
		$regie = Regia::getFromRegista($aid);
		?>
		<div id="scheda">
			<div id="preview">
				<img src='<?php echo LogSession::$BASELINK; ?>/img/artista/<?php echo $artista->getId(); ?>'
				     alt="<?php echo $artista->getNome(); ?>" id="cover"/>
				<div class='description'>
					<header> <?php echo $artista->getNome(); ?> </header>
					<?php
					InfoListDrawer::draw($artista, false);
					?>
					<p> <?php echo $descrizione; ?> </p>
				</div>
			</div>
			<div class="infoboxes">
				<?php
				if (count($recitazioni) > 0) {
					self::putRecitazioni($recitazioni);
				}
				if (count($regie) > 0) {
					self::putRegie($regie);
				}
				?>
			</div>
		</div>
		<?php
	}

	/**
	 * @param $recitazioni Recitazione[]
	 */
	private static function putRecitazioni($recitazioni) {
		?>
		<div class="infobox">
			<header>Recitazioni</header>
			<ul>
				<?php
				foreach ($recitazioni as $recitazione) {
					$film = Film::load($recitazione->getFilm());
					echo "<li>";
					echo "<a href='" . LogSession::$BASELINK . "/film/{$film->getId()}'>";
					echo "<img src='" . LogSession::$BASELINK . "/img/film/{$film->getId()}' alt='{$film->getTitolo()}'/>";
					echo "<span>";
					echo $recitazione->getPersonaggio();
					echo "</span>";
					echo "</a>";
					echo "</li>";
				}
				?>
			</ul>
		</div>
		<?php
	}

	/**
	 * @param $regie Regia[]
	 */
	private static function putRegie($regie) {
		?>
		<div class="infobox">
			<header>Regie</header>
			<ul>
				<?php
				foreach ($regie as $regia) {
					$film = Film::load($regia->getFilm());
					echo "<li>";
					echo "<a href='" . LogSession::$BASELINK . "/film/{$film->getId()}'>";
					echo "<img src='" . LogSession::$BASELINK . "/img/film/{$film->getId()}' alt='{$film->getTitolo()}'/>";
					echo "<span>";
					echo $film->getTitolo();
					echo "</span>";
					echo "</a>";
					echo "</li>";
				}
				?>
			</ul>
		</div>
		<?php
	}

}
