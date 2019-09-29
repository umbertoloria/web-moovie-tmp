<?php

class Error404 implements View {

	public static function put($arg = null) {
		LogSession::redirect("Pagina non trovata. Verrai ricondotto alla homepage.", "/");
	}

}
