<?php

class VideogiocoView implements View {

	public static function put($vid = null) {
		$videogioco = Videogioco::load($vid);
		if (!$videogioco) {
			LogSession::redirect("Videogioco non presente.", "/");
		}
		$descrizione = VideogiocoDescrizione::load($vid)->getDescrizione();
		$softwareHouse = SoftwareHouse::load($videogioco->getSoftwareHouse());
		?>
		<div id="scheda">
			<div id="preview">
				<img src='<?php echo LogSession::$BASELINK; ?>/img/videogioco/<?php echo $videogioco->getId(); ?>'
				     alt="<?php echo $videogioco->getTitolo(); ?>" id="cover"/>
				<div class='description'>
					<header> <?php echo $videogioco->getTitolo(); ?> </header>
					<p> <?php echo $descrizione; ?> </p>
				</div>
			</div>
			<!-- TODO: RELATED -->
			<div class="infoboxes">
				<?php
				$shvs = SagaHasVideogioco::getFromVideogioco($vid);
				foreach ($shvs as $shv) {
					$saga = SagaVideoludica::load($shv->getSaga());
					?>
					<div class="infobox">
						<header>In saga "<?php echo $saga->getTitolo(); ?>"</header>
						<ul>
							<?php
							foreach (SagaHasVideogioco::getFromSaga($saga->getId()) as $shf2) {
								$videogioco = Videogioco::load($shf2->getVideogioco());
								echo "<li>";
								echo "<a href='" . LogSession::$BASELINK . "/videogioco/{$videogioco->getId()}'>";
								echo "<img src='" . LogSession::$BASELINK . "/img/videogioco/{$videogioco->getId()}' alt='{$videogioco->getTitolo()}'/>";
								echo "<span>";
								echo $videogioco->getTitolo();
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
				<div class="infobox">
					<header>Prodotti da "<?php echo $softwareHouse->getNome(); ?>"</header>
					<ul>
						<?php
						foreach ($softwareHouse->getVideogiochiExceptThis($vid) as $videogioco) {
							echo "<li>";
							echo "<a href='" . LogSession::$BASELINK . "/videogioco/{$videogioco->getId()}'>";
							echo "<img src='" . LogSession::$BASELINK . "/img/videogioco/{$videogioco->getId()}' alt='{$videogioco->getTitolo()}'/>";
							echo "<span>";
							echo $videogioco->getTitolo();
							echo "</span>";
							echo "</a>";
							echo "</li>";
						}
						?>
					</ul>
				</div>
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
