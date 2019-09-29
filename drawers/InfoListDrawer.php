<?php

abstract class InfoListDrawer {

	public static function draw($infoObject, $complete) {
		$data = self::generateData($infoObject, $complete);
		echo "<div class='infolist'>";
		echo "<ul>";
		foreach ($data as $info) {
			echo "<li> {$info['title']} ";
			if (is_array($info['dati'])) {
				if ($info['format'] == 'images') {
					echo "<ul class='images'>";
					foreach ($info['dati'] as $item) {
						echo "<li>";
						echo "<a href='{$item['href']}'>";
						if (isset($item['text'])) {
							echo "<img src='" . $item['img'] . "' alt='{$item['text']}'/>";
						} else {
							echo "<img src='" . $item['img'] . "' alt=''/>";
						}
						echo "</a>";
						echo "</li>";
					}
					echo "</ul>";
				} elseif ($info['format'] == 'plain') {
					foreach ($info['dati'] as $item) {
						if (isset($item['href'])) {
							echo "<span><a href='{$item['href']}'>{$item['text']}</a></span>";
						} else {
							echo "<span>{$item['text']}</span>";
						}
					}
				}
			}
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}

	private static function generateData($infoObject, $complete) {
		if ($infoObject instanceof Film) {
			$data = array(
				array(
					'title' => 'Durata',
					'format' => 'plain',
					'dati' => array(
						array(
							'text' => Formats::durata($infoObject->getDurata())
						)
					)
				),
				array(
					'title' => 'Anno',
					'format' => 'plain',
					'dati' => array(
						array(
							'text' => $infoObject->getAnno()
						)
					)
				),
				array(
					'title' => 'Generi',
					'format' => 'plain',
					'dati' => array()
				)
			);
			foreach (FilmHasGenere::getFromFilm($infoObject->getId()) as $genere) {
				$genere = Genere::load($genere->getGenere());
				$data[2]['dati'][] = array(
					'href' => LogSession::$BASELINK . "/genere/{$genere->getId()}",
					'text' => $genere->getNome()
				);
			}
			if ($complete) {
				$data[3] = array(
					'title' => 'Personaggi',
					'format' => 'images',
					'dati' => array()
				);
				$data[4] = array(
					'title' => 'Registi',
					'format' => 'images',
					'dati' => array()
				);
				foreach (Recitazione::getFromFilm($infoObject->getId()) as $recitazione) {
					$data[3]['dati'][] = array(
						'href' => LogSession::$BASELINK . "/artista/{$recitazione->getAttore()}",
						'img' => LogSession::$BASELINK . "/img/artista/{$recitazione->getAttore()}"
					);
				}
				foreach (Regia::getFromFilm($infoObject->getId()) as $regia) {
					$data[4]['dati'][] = array(
						'href' => LogSession::$BASELINK . "/artista/{$regia->getRegista()}",
						'img' => LogSession::$BASELINK . "/img/artista/{$regia->getRegista()}"
					);
				}
			}
			return $data;
		} elseif ($infoObject instanceof Videogioco) {
			// TODO: Generi anche quì.
			$softwareHouse = SoftwareHouse::load($infoObject->getSoftwareHouse());
			$data = array(
				array(
					'title' => 'Anno',
					'format' => 'plain',
					'dati' => array(
						array(
							'text' => $infoObject->getAnno()
						)
					)
				),
				array(
					'title' => 'Produttore',
					'format' => 'plain',
					'dati' => array(
						array(
							'text' => $softwareHouse->getNome()
						)
					)
				)
			);
			return $data;
		} elseif ($infoObject instanceof Artista) {
			$data = array(
				array(
					'title' => 'Data di nascita',
					'format' => 'plain',
					'dati' => array(
						array(
							'text' => Formats::data($infoObject->getDataNascita())
						)
					)
				)
			);
			return $data;
		}
		return null;
	}

}