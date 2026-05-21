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
			if (!$(`[name="descricao[]"]`).eq(index).length)
				addAnexo(planejamento.descricao[index], planejamento.link[index]);
			else {
				$(`[name="descricao[]"]`).eq(index).val(planejamento.descricao[index]);
				$(`[name="link[]"]`).eq(index).val(planejamento.link[index]);
			}
		});
	}
}

function copiarPlanejamento(uuid) {
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
			if (!$(`[name="descricao[]"]`).eq(index).length)
				addAnexo(planejamento.descricao[index], planejamento.link[index]);
			else {
				$(`[name="descricao[]"]`).eq(index).val(planejamento.descricao[index]);
				$(`[name="link[]"]`).eq(index).val(planejamento.link[index]);
			}
		});

		$(`[name="id"]`).val('');
	}
}

function listarPlanejamentos() {
	$("#planejamentos").html('');
	const LISTA = JSON.parse(localStorage?.planejamentos || "[]");

	LISTA.sort((a, b) => new Date(b.criado_em) - new Date(a.criado_em));

	LISTA.forEach(planejamento => {
		$("#planejamentos").append(`<a href="#${planejamento.id}" onclick="visualizarPlanejamento('${planejamento.id}')" class="d-inline-block mb-1 text-primary"><i class="mdi id_font12x mdi-file-pdf-box"></i> ${planejamento.professor}, ${planejamento.turma} - ${moment(planejamento.criado_em).format("DD/MM/YY")} às ${moment(planejamento.criado_em).format("HH:mm")}</a> <a href="#copy-${planejamento.id}" onclick="copiarPlanejamento('${planejamento.id}')" class="d-inline-block mb-1 text-secondary"><i class="mdi id_font12x mdi-content-copy"></i></a><br>`);
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
