<?php


// TODO: Cancellare questo script!
class InserisciIngrediente implements Controller {

	public static function form() {
		?>
		<form data-action="/ajax/inserisci-ingrediente" onsubmit="form_submit(this, event)">
			<section>
				<label>
					<span>Nome</span>
					<input type="text" name="nome" placeholder="Nome ingrediente"/>
				</label>
				<label>
					<span>Categoria</span>
					<select name="categoria">
						<?php
						$cats = CategoriaIngrediente::getAll();
						foreach ($cats as $cat) {
							echo "<option value='{$cat->getTag()}' data-thatsit=''>{$cat->getNome()}</option>";
						}
						?>
					</select>
				</label>
				<label data-insertion="condimento">
					<span>Pericoloso?</span>
					<div class="radiocheck-container">
						<span><input type="radio" name="condimento_pericoloso" value="Si" checked/>Si</span>
						<span><input type="radio" name="condimento_pericoloso" value="No"/>No</span>
					</div>
				</label>
				<label data-insertion="verdura">
					<span>Colore</span>
					<input type="text" name="colore_verdura"/>
				</label>
				<label data-insertion="carne">
					<span>Tipo carne</span>
					<div class="radiocheck-container">
						<span><input type="radio" name="tipo_carne" value="Bianca" checked/>Bianca</span>
						<span><input type="radio" name="tipo_carne" value="Rossa"/>Rossa</span>
					</div>
				</label>
				<label data-insertion="formaggio">
					<span>Provenienza formaggio</span>
					<input type="text" name="provenienza_formaggio"/>
				</label>
				<label data-insertion="formaggio">
					<span>Tipo formaggio</span>
					<div class="radiocheck-container">
						<span><input type="radio" name="tipo_formaggio" value="Duro" checked/>Duro</span>
						<span><input type="radio" name="tipo_formaggio" value="Morbido"/>Morbido</span>
					</div>
				</label>
			</section>
			<button type="submit">Aggiungi</button>
		</form>
		<script>
			$("form label[data-insertion]").hide();
			$("form label[data-insertion='carne']").show();
			$("select[name='categoria']").change(function () {
				var insertion = $(this).val();
				$("form label").each(function (index) {
					if ($(this).is("[data-insertion]")) {
						if ($(this).is("[data-insertion='" + insertion + "']")) {
							$(this).show();
						} else {
							$(this).hide();
						}
					}
				});
			});
		</script>
		<?php
	}

	public static function procedure() {

		$nome = trim(@$_POST['nome']);
		$categoria = trim(@$_POST['categoria']);
		$condimento_pericoloso = trim(@$_POST['condimento_pericoloso']);
		$colore_verdura = trim(@$_POST['colore_verdura']);
		$tipo_carne = trim(@$_POST['tipo_carne']);
		$provenienza_formaggio = trim(@$_POST['provenienza_formaggio']);
		$tipo_formaggio = trim(@$_POST['tipo_formaggio']);

		$validations = array();

		if (strlen($nome) < 2 or strlen($nome) > 50) {
			$validations['nome'] = "Dimensioni consentite: da 2 a 50 caratteri";
		} elseif (Film::esiste($nome)) {
			$validations['nome'] = "Già esiste";
		}

		if (!CategoriaIngrediente::load($categoria)) {
			$validations['categoria'] = "Non valida";
		} elseif ($categoria == 'condimento') {
			$condimento_pericoloso = !empty($condimento_pericoloso);
		} elseif ($categoria == 'carne') {
			if ($tipo_carne != 'Bianca' and $tipo_carne != 'Rossa') {
				$validations['tipo_carne'] = "La carne deve essere Rossa o Bianca.";
			}
		} elseif ($categoria == 'formaggio') {
			if (strlen($provenienza_formaggio) < 2 or strlen($provenienza_formaggio) > 20) {
				$validations['provenienza_formaggio'] = "Dimensioni consentite: da 2 a 20 caratteri";
			}
			if ($tipo_carne != 'Duro' and $tipo_carne != 'Morbido') {
				$validations['tipo_carne'] = "Il formaggio deve essere Duro o Morbido.";
			}
		}

		if (empty($validations)) {

			echo "warning;Stiamo elaborando la richiesta.";

		} else {
			echo "validation;" . json_encode($validations);
		}
	}

}