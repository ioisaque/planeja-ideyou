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

	// Add event listeners for change events
	// $('input, textarea, select').on('change paste keyup', function (event) {
	// 	console.log(`event => `, event);
	// 	const name = $(this).attr('name');
	// 	const value = $(this).val();
	// 	setCookie(name, value);
	// });

	// Populate form elements with cookie values (on page load)
	// $('input, textarea, select').each(function () {
	// 	const name = $(this).attr('name');
	// 	const value = getCookie(name);
	// 	if (value !== null) {
	// 		$(this).val(value);
	// 	}
	// });

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
	$("#processarPlanejamento").on("submit", function (event) {
		event.preventDefault();

		// Extracting values from dynamic fields
		let descricaoValues = [];
		let linkValues = [];

		$('input[name="descricao[]"]').each(function () {
			descricaoValues.push($(this).val());
		});

		$('input[name="link[]"]').each(function () {
			linkValues.push($(this).val());
		});

		let planejamento = $(this).serializeArray().reduce(function (a, x) { a[x.name] = x.value; return a; }, {});
		planejamento.descricao = descricaoValues;
		planejamento.link = linkValues;

		let LISTA = JSON.parse(localStorage.planejamentos || "[]");

		planejamento.criado_em = new Date();
		planejamento.formData = encodeURI($(this).serialize());

		if (!planejamento?.id) {
			planejamento.id = crypto.randomUUID();
			$('input[name="id"]').val(planejamento.id);
			LISTA.push(planejamento);
		} else {
			LISTA = LISTA.map((item) => {
				return item.id === planejamento.id ? planejamento : item;
			});
		}

		localStorage.planejamentos = JSON.stringify(LISTA);

		event.target.submit();
		listarPlanejamentos();

		setTimeout(() => {
			event.target.reset();
		}, 1000);
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
