function visualizarPlanejamento(uuid) {
	const planejamentos = JSON.parse(localStorage.getItem('planejamentos')) || [];
	const planejamento = planejamentos.find(obj => obj.id === uuid);

	if (!planejamento)
		return;

	$("#anexos").html("");

	if (planejamento.bimestre && !planejamento.periodo) {
		const map = {
			'1º': '1º BIMESTRE',
			'2º': '2º BIMESTRE',
			'3º': '3º BIMESTRE',
			'4º': '4º BIMESTRE',
		};
		planejamento.periodo = map[planejamento.bimestre] || planejamento.bimestre;
	}

	for (const key in planejamento) {
		if (!planejamento.hasOwnProperty(key))
			continue;

		if (key === 'descricao' || key === 'link' || key === 'formData' || key === 'criado_em')
			continue;

		const $field = $(`[name="${key}"]`);
		if (!$field.length)
			continue;

		$field.val(planejamento[key]);

		if (key === 'periodo_i' || key === 'periodo_f')
			$field.datepicker('update', planejamento[key]);
	}

	const descricoes = Array.isArray(planejamento.descricao) ? planejamento.descricao : [];
	const links = Array.isArray(planejamento.link) ? planejamento.link : [];

	if (!links.length) {
		addAnexo();
	} else {
		links.forEach((link, index) => {
			addAnexo(descricoes[index] || '', link || '');
		});
	}
}

function copiarPlanejamento(uuid) {
	visualizarPlanejamento(uuid);
	$('input[name="id"]').val('');
}

function listarPlanejamentos() {
	$("#planejamentos").html('');
	const LISTA = JSON.parse(localStorage?.planejamentos || "[]");

	LISTA.sort((a, b) => new Date(b.criado_em) - new Date(a.criado_em));

	LISTA.forEach(planejamento => {
		$("#planejamentos").append(`<a href="#${planejamento.id}" class="d-inline-block mb-1 text-primary"><i class="mdi id_font12x mdi-file-pdf-box"></i> ${planejamento.professor}, ${planejamento.turma} - ${moment(planejamento.criado_em).format("DD/MM/YY")} às ${moment(planejamento.criado_em).format("HH:mm")}</a> <a href="#copy-${planejamento.id}" class="d-inline-block mb-1 text-secondary"><i class="mdi id_font14x mdi-content-copy"></i></a><br>`);
	});
}

function salvarPlanejamentoLocal($form) {
	const descricaoValues = [];
	const linkValues = [];

	$form.find('input[name="descricao[]"]').each(function () {
		descricaoValues.push($(this).val());
	});

	$form.find('input[name="link[]"]').each(function () {
		linkValues.push($(this).val());
	});

	const planejamento = $form.serializeArray().reduce(function (a, x) {
		a[x.name] = x.value;
		return a;
	}, {});
	planejamento.descricao = descricaoValues;
	planejamento.link = linkValues;
	planejamento.criado_em = new Date().toISOString();
	planejamento.formData = encodeURI($form.serialize());

	let LISTA = JSON.parse(localStorage.planejamentos || "[]");

	if (!planejamento.id) {
		planejamento.id = typeof crypto.randomUUID === "function"
			? crypto.randomUUID()
			: "id-" + Date.now();
		$form.find('input[name="id"]').val(planejamento.id);
		LISTA.push(planejamento);
	} else {
		LISTA = LISTA.map((item) => (item.id === planejamento.id ? planejamento : item));
	}

	localStorage.planejamentos = JSON.stringify(LISTA);
	listarPlanejamentos();
}

function abrirPlanejamentoPorHash() {
	const hash = window.location.hash.replace(/^#/, "");

	if (!hash)
		return;

	if (hash.indexOf("copy-") === 0) {
		copiarPlanejamento(hash.slice(5));
		return;
	}

	const LISTA = JSON.parse(localStorage.getItem("planejamentos") || "[]");

	if (LISTA.some((p) => p.id === hash))
		visualizarPlanejamento(hash);
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
