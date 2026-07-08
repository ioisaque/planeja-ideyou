const cDevice = navigator.userAgent;
const urlParams = new URLSearchParams(window.location.search);

$(function () {
	$(".datepicker").datepicker({
		language: "pt-BR",
		autoclose: true,
		todayHighlight: true,
		format: "dd/mm/yyyy",
		todayBtn: "linked",
		orientation: "bottom auto",
	});
	$(".preloader").fadeOut(250);

	listarPlanejamentos();
	abrirPlanejamentoPorHash();

	$(window).on("hashchange", abrirPlanejamentoPorHash);

	$("#processarPlanejamento").on("reset", function (event) {
		$("#anexos").html(`
			<div class="row">
				<div class="col-5">
						<label>Descrição</label>
						<input type="text" name="descricao[]" class="form-control">
				</div>
				<div class="col-5">
						<label>Link</label>
						<input type="text" name="link[]" class="form-control">
				</div>
				<div class="col-2">
						<label></label>
						<button type="button" onClick="addAnexo()" class="btn p-1 btn-block btn-success">
								<i class="mdi id_font14x mdi-plus"></i>
						</button>
				</div>
			</div>
		`);
	});

	$('button[type="submit"][form="processarPlanejamento"]').on("click", function () {
		try {
			salvarPlanejamentoLocal($("#processarPlanejamento"));
		} catch (err) {
			console.error("Erro ao salvar planejamento:", err);
		}
	});

	if ("serviceWorker" in navigator) {
		console.log("Will the service worker register?");

		if (navigator.serviceWorker.controller)
			console.log("Already registered.");
		else
			navigator.serviceWorker.register("service-worker.js")
				.then(function (reg) {
					console.log("Yes, it did.");
				})
				.catch(function (err) {
					console.log("Registration failed:", err);
				});
	}

	let bInstallPrompt = null;

	window.addEventListener("beforeinstallprompt", (event) => {
		event.preventDefault();
		bInstallPrompt = event;
		console.log(`Default prevented.`);
		$("#install-prompt").removeClass("d-none");
	});

	if (window.navigator.standalone != true) {
		$("#install-prompt").on("click", (click) => {
			if ($(click.target).hasClass('mdi')) {
				$("#install-prompt").addClass("d-none");
			} else {
				bInstallPrompt.prompt();
				bInstallPrompt.userChoice.then((choiceResult) => {
					if (choiceResult.outcome === "accepted") {
						console.log(`User accepted.`);
						$("#install-prompt").addClass("d-none");
					}
				});
			}
		});
	}
});
