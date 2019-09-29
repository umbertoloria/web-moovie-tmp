<?php

abstract class DBPattern {

	/**
	 * Constructs a DBPattern.
	 * @param $pk mixed is the primary key of the record to load
	 * @throws Exception if the Object that inherits this class is unknown
	 */
	protected function __construct($pk) {
		if ($this instanceof Film) {
			$sql = "SELECT id, titolo, durata, anno FROM films WHERE id = ?";
		} elseif ($this instanceof Artista) {
			$sql = "SELECT id, nome, data_nascita FROM artisti WHERE id = ?";
		} elseif ($this instanceof Recitazione) {
			$sql = "SELECT film, attore, personaggio FROM recitazioni WHERE film = ? AND attore = ?";
		} elseif ($this instanceof Utente) {
			$sql = "SELECT id, username, email, password, ruolo FROM utenti WHERE id = ?";
		} elseif ($this instanceof Visione) {
			$sql = "SELECT utente, film, momento, voto FROM visioni WHERE utente = ? AND film = ?";
		} elseif ($this instanceof Videogioco) {
			$sql = "SELECT id, titolo, anno, software_house FROM videogiochi WHERE id = ?";
		} elseif ($this instanceof Giocata) {
			$sql = "SELECT utente, videogioco, momento, voto FROM giocate WHERE utente = ? AND videogioco = ?";
		} elseif ($this instanceof Regia) {
			$sql = "SELECT film, regista FROM regie WHERE film = ? AND regista = ?";
		} elseif ($this instanceof ArtistaFaccia) {
			$sql = "SELECT artista, faccia FROM artisti_facce WHERE artista = ?";
		} elseif ($this instanceof FilmCopertina) {
			$sql = "SELECT film, copertina FROM films_copertine WHERE film = ?";
		} elseif ($this instanceof VideogiocoCopertina) {
			$sql = "SELECT videogioco, copertina FROM videogiochi_copertine WHERE videogioco = ?";
		} elseif ($this instanceof FilmDescrizione) {
			$sql = "SELECT film, descrizione FROM films_descrizioni WHERE film = ?";
		} elseif ($this instanceof ArtistaDescrizione) {
			$sql = "SELECT artista, descrizione FROM artisti_descrizioni WHERE artista = ?";
		} elseif ($this instanceof VideogiocoDescrizione) {
			$sql = "SELECT videogioco, descrizione FROM videogiochi_descrizioni WHERE videogioco = ?";
		} elseif ($this instanceof SagaCinematografica) {
			$sql = "SELECT id, titolo FROM saghe_cinematografiche WHERE id = ?";
		} elseif ($this instanceof SagaHasFilm) {
			$sql = "SELECT saga, film FROM saga_has_film WHERE saga = ? AND film = ?";
		} elseif ($this instanceof SoftwareHouse) {
			$sql = "SELECT id, nome FROM software_houses WHERE id = ?";
		} elseif ($this instanceof FilmHasGenere) {
			$sql = "SELECT film, genere FROM film_has_genere WHERE film = ? AND genere = ?";
		} elseif ($this instanceof Genere) {
			$sql = "SELECT id, nome FROM generi WHERE id = ?";
		} elseif ($this instanceof SagaVideoludica) {
			$sql = "SELECT id, titolo FROM saghe_videoludiche WHERE id = ?";
		} elseif ($this instanceof SagaHasVideogioco) {
			$sql = "SELECT saga, videogioco FROM saga_has_videogioco WHERE saga = ? AND videogioco = ?";
		} else {
			throw new Exception();
		}
		if (is_array($pk)) {
			if (count($pk) == 2) {
				$q = DB::query($sql, $pk[0], $pk[1]);
			} else {
				throw new Exception();
			}
		} else {
			$q = DB::query($sql, $pk);
		}
		$dati = $q->fetch(2);
		if (!$dati) {
			throw new Exception();
		}
		foreach ($dati as $k => $v) {
			$this->$k = $v;
		}
	}

}
