/**
 * JS::capEvrFirst()
 *
 * @param string
 * @return
 */
function capEvrFirst(string = '') {
	return string.replace(/(^\w{1})|(\s+\w{1})/g, letter => letter.toUpperCase());
}

/**
 * JS::BRN()
 *
 * @param float valor
 * @return
 */
function BRN(valor) {
	if (!valor || valor == "") valor = 0;
	return valor.toLocaleString("pt-BR");
}

/**
 * JS::BRL()
 *
 * @param float valor
 * @return
 */
function BRL(valor) {
	valor = parseFloat(valor);
	if (!valor || valor == "") valor = 0;
	return valor.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
}

/**
 * JS::CELULAR()
 *
 * @param int numero
 * @return
 */
function CELULAR(numero) {
	// Extrair os dígitos do número original
	const codigoArea = numero.substr(0, 2);
	const nonoDigito = numero.substr(2, 1);
	const parte1 = numero.substr(3, 4);
	const parte2 = numero.substr(7, 4);

	// Formatar no padrão desejado: (XX) X XXXX XXXX
	const numeroFormatado = `(${codigoArea}) ${nonoDigito} ${parte1} ${parte2}`;

	return numeroFormatado;
}

/**
 * JS::rBRL()
 *
 * @param float valor
 * @return
 */
function rBRL(valor) {
	if (valor) {
		valor = valor.replace("&nbsp;", " ");
		valor = valor.replace("R$ ", "");
		valor = valor.replace("R$ ", ""); // ?? CHAR ENCODE
		valor = valor.replace(".", "");
		valor = valor.replace(",", ".");
		valor = parseFloat(valor);
	}

	return valor != "" ? valor : 0;
}

function charLimit(text, count) {
	return text.slice(0, count) + (text.length > count ? "..." : "");
}

function setCookie(cname, cvalue, secs = 31536000) {
	var d = new Date();
	d.setTime(d.getTime() + secs * 1000);
	var expires = "expires=" + d.toUTCString();
	cvalue = cvalue === true ? 1 : cvalue;
	cvalue = cvalue === false ? 0 : cvalue;
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for (var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(nameEQ) === 0) {
			var encodedValue = c.substring(nameEQ.length, c.length);
			var decodedValue = decodeURIComponent(encodedValue.replace(/%2F/g, '/').replace(/%3A/g, ':'));
			return decodedValue.replace(/%2523/g, '#');
		}
	}
	return null;
}


function debounce(func, wait, immediate) {
	let timeout;
	return function () {
		const context = this;
		const args = arguments;
		const later = function () {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		const callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
}

function remFromURL(param) {
	const url = new URL(window.location.href);
	url.searchParams.delete(param);
	const newUrl = url.toString();
	window.history.replaceState({ path: newUrl }, '', newUrl);
}

function refreshLocalStorage() {
	localStorage.clear()
	window.location.reload();
}

/**
 * Checks if number sequence is increasing
 * @param {Number} numbers - a sequence of input numbers
 * @return {Boolean} - true if given sequence is increasing, false otherwise
 */
function isIncreasing(num) {
	let wasLess = 0;
	let wasMore = 0;
	for (let i = 0; i < num.length - 1; i++) {
		if (i && num[i] > (num[i - 1] ? num[i - 1] : 0)) wasMore++;
		else if (i) wasLess++;
	}
	return wasMore > wasLess;
}

function visualizarPlanejamento(uuid) {
	const planejamentos = JSON.parse(localStorage.getItem('planejamentos')) || [];
	const planejamento = planejamentos.find(obj => obj.id === uuid);

	$("#anexos").html(`
	<div class="row">
		<div class="col-5">
				<label>Descrição</label>
				<input type="text" name="descricao[]" class="form-control" value="${planejamento.descricao}">
		</div>
		<div class="col-5">
				<label>Link</label>
				<input type="text" name="link[]" class="form-control" value="${planejamento.link}">
		</div>
		<div class="col-2">
				<label></label>
				<button type="button" onClick="addAnexo()" class="btn p-1 btn-block btn-success">
						<i class="mdi id_font14x mdi-plus"></i>
				</button>
		</div>
	</div>
`);

	if (planejamento) {
		// Assuming the attributes in the object have the same names as form elements
		for (const key in planejamento) {
			if (planejamento.hasOwnProperty(key)) {
				const value = planejamento[key];

				if (key != 'descricao[]' && key != 'link[]')
					$(`[name="${key}"]`).val(value);

				if (key == 'periodo_i' || key == 'periodo_f')
					$(`[name="${key}"]`).datepicker('update', value);
			}
		}


		planejamento.link.forEach((item, index) => {
			// Check if the field exists, if not, create it
			if (!$(`[name="descricao[]"]`).eq(index).length)
				// Create the input field
				addAnexo(planejamento.descricao[index], planejamento.link[index]);
			else {
				$(`[name="descricao[]"]`).eq(index).val(planejamento.descricao[index]);
				$(`[name="link[]"]`).eq(index).val(planejamento.link[index]);
			}
		});
	}
}


function listarPlanejamentos() {
	$("#planejamentos").html('');
	const LISTA = JSON.parse(localStorage?.planejamentos || "[]");

	LISTA.sort((a, b) => new Date(b.criado_em) - new Date(a.criado_em));

	LISTA.forEach(planejamento => {
		$("#planejamentos").append(`<a href="#${planejamento.id}" onclick="visualizarPlanejamento('${planejamento.id}')" class="d-block mb-1 text-primary"><i class="mdi id_font12x mdi-file-pdf-box"></i> ${planejamento.professor}, ${planejamento.turma} - ${moment(planejamento.criado_em).format("DD/MM/YY")} às ${moment(planejamento.criado_em).format("HH:mm")}</a>`);
	});
}

function addAnexo(descricao = '', link = '') {
	const anexos = document.getElementById('anexos');

	const newRow = document.createElement('div');
	newRow.className = 'row';

	newRow.innerHTML = `
			<div class="col-5">
					<label>Descrição</label>
					<input type="text" name="descricao[]" class="form-control" value="${descricao}">
			</div>
			<div class="col-5">
					<label>Link</label>
					<input type="text" name="link[]" class="form-control" value="${link}">
			</div>
			<div class="col-2">
					<label></label>
					<button type="button" onClick="removeAnexo(this)" class="btn p-1 btn-block btn-danger">
							<i class="mdi id_font14x mdi-minus"></i>
					</button>
			</div>
	`;

	anexos.insertBefore(newRow, anexos.firstChild);
}


function removeAnexo(button) {
	button.parentNode.parentNode.remove();
}


/**
 * Select fill by DB
 * @param {string} element
 * @param {string} tabela
 */
async function fillSelectFromTable(select, initAt = 0) {
	const table = select.attr("data-fill-table");

	if (table == "lojas")
		initAt = select.attr("id") ? getCookie("CURRENT_STORE") : 0;

	if (table == "produtos_categoria") {
		if (getCookie("COZ_T_CATEGORIA") == null)
			setCookie("COZ_T_CATEGORIA", 0)

		initAt = urlParams.get("id_categoria") ?? getCookie("COZ_T_CATEGORIA");
	}

	const trigger = !select.attr("data-trigger");
	const zeroText = select.attr("data-zero-text") ?? false;
	const valueIs = select.attr("data-value-is") ?? "id";
	const labelIs = select.attr("data-label-is") ?? "nome";
	const orderBy = select.attr("data-order") ?? false;
	const selectVal = select.attr("data-select") ?? false;

	await buscarTabela(table, false, orderBy).then(async (lista) => {
		if (!lista?.length)
			return;

		let selectValFound = (selectVal !== false && selectVal.length > 0) ? false : true;
		select.empty();

		if (zeroText)
			$('<option>', { value: 0, text: zeroText }).appendTo(select);
		else
			initAt = parseInt(initAt) ? initAt : lista[0][valueIs];

		lista?.forEach((item) => {
			if (selectVal == item[valueIs])
				selectValFound = true;

			$('<option>', { value: item[valueIs], text: item[labelIs] }).appendTo(select);
		});

		if (!selectValFound && table != 'lojas') {

			await buscarTabela(table, selectVal)
				.then((extraItem) => {
					extraItem && $('<option>', { value: extraItem[valueIs], text: extraItem[labelIs] }).appendTo(select);
				})
				.catch((error) => {
					Notify(`Error on fill select [${table}]: ${error.message}`, "danger");
				});
		}

		select.val(selectVal || initAt);

		setTimeout(function () {
			if (trigger)
				select.trigger("change");

			select.hasClass('select2') && select.select2();
		}, 100);
	})
		.catch((error) => {
			Notify(`Error on fill select [${table}]: ${error.message}`, "danger");
		});

	if (table == "cidades") {
		const form = $(select).closest("form")[0];
		buscarTabela("cidades", $("select[name='cidade']").val()?.toUpperCase())
			.then((cidade) => {
				$(form)
					.find("select[name='bairro']").children().each(function () {
						buscarTabela("bairros", $(this).val().toUpperCase())
							.then((bairro) => {
								if (bairro && cidade.id !== bairro.cidade)
									$(this).prop("disabled", true);
								else
									$(this).prop("disabled", false);
							})
							.catch((error) => {
								Notify(`Request failed: ${error.message}`, "danger");
							});
					});
			})
			.catch((error) => {
				Notify(`Request failed: ${error.message}`, "danger");
			});
	}
}

/**
 * Notify User
 * @param {string} message
 * @param {string} type
 */
function Notify(message, type, model = 0, options = false) {
	switch (model) {
		case 1:
			options = { timer: 8000, showConfirmButton: false, ...options };

			if (!options.title)
				Swal.fire({
					...options,
					title: type == "success" ? "Sucesso!" : "Atenção!",
					html: message,
					icon: type != "danger" ? type : "warning",
				});
			else
				Swal.fire({
					...options,
					title: options.title,
					html: message,
					icon: type != "danger" ? type : "warning",
				});
			break;

		default:
			options = options || {
				ele: "body",
				type: type != "debug" ? type : "info",
				align: "center",
				width: window.innerWidth > 720 ? "auto" : window.innerWidth * 0.9,
				stackup_spacing: 10,
				pause_on_mouseover: type == "debug",
				delay: type == "debug" ? 86400 : 5000,
			};

			$.bootstrapGrowl(message, options);
			break;
	}
}

function popUp(URL) {
	let dialog = URL.includes("api.whatsapp.com")
		? window.open(URL, "_blank")
		: window.open(
			URL,
			"IdeYou Print",
			`width=400,height=600,top=0,left=${$(window).width() - 500
			},location=no,menubar=no,resizeble=no,status=no,titlebar=no,toolbar=no`
		);

	window.addEventListener("focus", function () {
		dialog.close();
	});
	dialog.print();
}

/**
 * Check iF Mobile
 * @param {URL} URL
 */
function isMobile() {
	return "ontouchstart" in document.documentElement;
}

function initAudio(filename) {
	return isApp
		? new Audio(`sistema/assets/sounds/${filename}`)
		: new Audio(`assets/sounds/${filename}`);
}

/**
 * Check iF File Exists
 * @param {URL} URL
 */
function fileExists(url) {
	var http = new XMLHttpRequest();
	http.open("HEAD", url, false);
	http.send();
	return http.status != 404;
}

/**
 * Wait msec
 * @param {msecs} msec
 */
function sleep(msec) {
	return new Promise((resolve, reject) => {
		setTimeout(resolve, msec || 1000);
	});
}