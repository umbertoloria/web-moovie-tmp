<?php

class FilmView implements View {

	public static function put($fid = null) {
		$film = Film::load($fid);
		if (!$film) {
			LogSession::redirect("Film non presente.", "/");
		}
		$descrizione = FilmDescrizione::load($fid)->getDescrizione();
		$durata = $film->getDurata();
		$generi = FilmHasGenere::getFromFilm($film->getId());
		$recitazioni = Recitazione::getFromFilm($fid);
		$regie = Regia::getFromFilm($fid);
		?>
		<div id="scheda">
			<div id="preview">
				<img src='<?php echo LogSession::$BASELINK; ?>/img/film/<?php echo $film->getId(); ?>'
				     alt="<?php echo $film->getTitolo(); ?>" id="cover"/>
				<div class='description'>
					<header> <?php echo $film->getTitolo(); ?> </header>
					<?php
					InfoListDrawer::draw($film, false);
					?>
					<p> <?php echo $descrizione; ?> </p>
				</div>
			</div>
			<div class="infoboxes">
				<div class="infobox">
					<header>Personaggi</header>
					<ul>
						<?php
						foreach ($recitazioni as $recitazione) {
							$attore = Artista::load($recitazione->getAttore());
							echo "<li>";
							echo "<a href='" . LogSession::$BASELINK . "/artista/{$attore->getId()}'>";
							echo "<img src='" . LogSession::$BASELINK . "/img/artista/{$attore->getId()}' alt='{$attore->getNome()}'/>";
							echo "<span>";
							echo $recitazione->getPersonaggio();
							echo "</span>";
							echo "</a>";
							echo "</li>";
						}
						?>
					</ul>
				</div>
				<div class="infobox">
					<header>Registi</header>
					<ul>
						<?php
						foreach ($regie as $regia) {
							$regista = Artista::load($regia->getRegista());
							echo "<li>";
							echo "<a href='" . LogSession::$BASELINK . "/artista/{$regista->getId()}'>";
							echo "<img src='" . LogSession::$BASELINK . "/img/artista/{$regista->getId()}' alt='{$regista->getNome()}'/>";
							echo "<span>";
							echo $regista->getNome();
							echo "</span>";
							echo "</a>";
							echo "</li>";
						}
						?>
					</ul>
				</div>
				<?php
				$shfs = SagaHasFilm::getFromFilm($fid);
				foreach ($shfs as $shf) {
					$saga = SagaCinematografica::load($shf->getSaga());
					?>
					<div class="infobox">
						<header>In saga "<?php echo $saga->getTitolo(); ?>"</header>
						<ul>
							<?php
							foreach (SagaHasFilm::getFromSaga($saga->getId()) as $shf2) {
								$film = Film::load($shf2->getFilm());
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
				?>
				<!--
				TODO: amici...
				<div class="infobox">
					<header>I tuoi amici</header>
					<ul>
					</ul>
				</div>
				-->
			</div>
		</div>
		<?php
	}

}
