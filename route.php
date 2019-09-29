<?php
require_once "dbs/DB.php";
require_once "dbs/DBPattern.php";
require_once "dbs/Film.php";
require_once "dbs/Artista.php";
require_once "dbs/Recitazione.php";
require_once "dbs/Utente.php";
require_once "dbs/Visione.php";
require_once "dbs/Videogioco.php";
require_once "dbs/Giocata.php";
require_once "dbs/FilmHasGenere.php";
require_once "dbs/Genere.php";
require_once "dbs/Regia.php";
require_once "dbs/ArtistaFaccia.php";
require_once "dbs/FilmCopertina.php";
require_once "dbs/VideogiocoCopertina.php";
require_once "dbs/FilmDescrizione.php";
require_once "dbs/ArtistaDescrizione.php";
require_once "dbs/VideogiocoDescrizione.php";
require_once "dbs/SagaCinematografica.php";
require_once "dbs/SagaHasFilm.php";
require_once "dbs/SoftwareHouse.php";
require_once "dbs/SagaVideoludica.php";
require_once "dbs/SagaHasVideogioco.php";

require_once "views/View.php";
require_once "views/ChiSiamo.php";
require_once "views/HomePage.php";
require_once "views/Error404.php";
require_once "views/Head.php";
require_once "views/TopMenu.php";
require_once "views/ImageViewer.php";
require_once "views/FilmView.php";
require_once "views/VideogiocoView.php";
require_once "views/ArtistaView.php";
require_once "views/GenereView.php";
require_once "views/ScopriFilmsPage.php";
require_once "views/ScopriVideogiochiPage.php";

require_once "controllers/Controller.php";
require_once "controllers/InserisciIngrediente.php";

require_once "drawers/BoxDrawer.php";
require_once "drawers/FilmDrawer.php";
require_once "drawers/VideogiocoDrawer.php";
require_once "drawers/InfoListDrawer.php";

require_once "utils/Formats.php";

require_once "LogSession.php";

$route = $_GET['route'];
$parts = explode("/", $route);
$a = @$parts[0];
$b = @$parts[1];
$c = @$parts[2];

LogSession::init();

$views = array(
	"" => "HomePage",
	"films" => "ScopriFilmsPage",
	"videogiochi" => "ScopriVideogiochiPage",
	"amici" => "AmiciPage",
	"img" => "ImageViewer",
	"inserisci-film" => "InserisciFilm",
	"film" => "FilmView",
	"videogioco" => "VideogiocoView",
	"artista" => "ArtistaView",
	"genere" => "GenereView",
);

$view = @$views[$a];

if ($view == 'ImageViewer') {
	$view::put(array($b, $c));
	die();
}

Head::put();
TopMenu::put();
echo "<div id='container'>";
if ($view !== null) {
	$view::put($b);
} else {
	Error404::put();
}
echo "</div>";
