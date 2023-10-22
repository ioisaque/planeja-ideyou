const MaskTelefones = function (val) {
	return val.replace(/\D/g, "").length === 11 ? "(00) 0 0000-0000" : "(00) 9 0000-0000";
},
	telOptions = {
		onKeyPress: function (val, e, field, options) {
			field.mask(MaskTelefones.apply({}, arguments), options);
		},
	};

const MaskCPF_CNPJ = function (val) {
	return val.replace(/\D/g, "").length > 11 ? "00.000.000/0000-00" : "000.000.000-009";
},
	CCOptions = {
		onKeyPress: function (val, e, field, options) {
			field.mask(MaskCPF_CNPJ.apply({}, arguments), options);
		},
	};

$(function () {
	// $("input[name='cod_barras']").attr("inputmode", "numeric");
	// if($("input[name='cod_barras']").length > 0){
	// 	$("input[name='cod_barras']").mask('=| 9 999999 999999 |=');
	// }
	if ($("input[name='placa']").length > 0) {
		$("input[name='placa']").mask("AAA-9999");
	}

	$("input[name='renavam']").attr("inputmode", "numeric");
	if ($("input[name='renavam']").length > 0) {
		$("input[name='renavam']").mask("999999999999999");
	}

	$("input[name='numero']").attr("inputmode", "numeric");
	if ($("input[name='numero']").length > 0) {
		$("input[name='numero']").mask("999999");
	}

	$("input[name='data']").attr("inputmode", "numeric");
	if ($("input[name='data']").length > 0) {
		$("input[name='data']").mask("99/99/9999");
	}

	$("input[name='data_i']").attr("inputmode", "numeric");
	if ($("input[name='data_i']").length > 0) {
		$("input[name='data_i']").mask("99/99/9999");
	}

	$("input[name='data_e']").attr("inputmode", "numeric");
	if ($("input[name='data_e']").length > 0) {
		$("input[name='data_e']").mask("99/99/9999");
	}

	$("input[name='data_nasc']").attr("inputmode", "numeric");
	if ($("input[name='data_nasc']").length > 0) {
		$("input[name='data_nasc']").mask("99/99/9999");
	}

	$("input[name='hora']").attr("inputmode", "numeric");
	if ($("input[name='hora']").length > 0) {
		$("input[name='hora']").mask("99:99");
	}

	$("input[name='telefone']").attr("inputmode", "numeric");
	if ($("input[name='telefone']").length > 0) {
		$("input[name='telefone']").mask(MaskTelefones, telOptions);
	}

	$("input[name='celular']").attr("inputmode", "numeric");
	if ($("input[name='celular']").length > 0) {
		$("input[name='celular']").mask(MaskTelefones, telOptions);
	}

	$("input[name='cep']").attr("inputmode", "numeric");
	if ($("input[name='cep']").length > 0) {
		$("input[name='cep']").mask("99999-999");
	}

	$("input[name='cpf_cnpj']").attr("inputmode", "numeric");
	if ($("input[name='cpf_cnpj']").length > 0) {
		$("input[name='cpf_cnpj']").mask(MaskCPF_CNPJ, CCOptions);
	}

	$("input[name='rg']").attr("inputmode", "numeric");
	if ($("input[name='rg']").length > 0) {
		$("input[name='rg']").mask("99.999.999");
	}

	$("input[name='cpf']").attr("inputmode", "numeric");
	if ($("input[name='cpf']").length > 0) {
		$("input[name='cpf']").mask("999.999.999-99");
	}

	$("input[name='ie']").attr("inputmode", "numeric");
	if ($("input[name='ie']").length > 0) {
		$("input[name='ie']").mask("999999999.99-99");
	}

	$("input[name='cnpj']").attr("inputmode", "numeric");
	if ($("input[name='cnpj']").length > 0) {
		$("input[name='cnpj']").mask("99.999.999/9999-99");
	}

	$("input[name='numero_cartao']").attr("inputmode", "numeric");
	if ($("input[name='numero_cartao']").length > 0) {
		$("input[name='numero_cartao']").mask("9999****9999");
	}

	$(".BRL").attr("inputmode", "numeric");
	if ($(".BRL").length > 0) {
		$(".BRL").maskMoney({
			symbol: "R$ ",
			thousands: ".",
			decimal: ",",
			symbolStay: true,
			allowNegative: true,
		});
	}

	$(".decimal").attr("inputmode", "numeric");
	if ($(".decimal").length > 0) {
		$(".decimal").maskMoney({
			thousands: ".",
			decimal: ",",
			symbolStay: false,
			allowNegative: true,
		});
	}

	$(".BRL_P").attr("inputmode", "numeric");
	if ($(".BRL_P").length > 0) {
		$(".BRL_P").maskMoney({
			symbol: "R$ ",
			thousands: ".",
			decimal: ",",
			precision: 3,
			symbolStay: true,
			allowNegative: true,
		});
	}

	$(".decimalp").attr("inputmode", "numeric");
	if ($(".decimalp").length > 0) {
		$(".decimalp").maskMoney({
			thousands: ".",
			decimal: ",",
			precision: 3,
			symbolStay: false,
			allowNegative: true,
		});
	}

	$(document).on("keyup paste change", "input.caps", function () {
		this.value = this.value.toUpperCase();
	});

	$(document).on("keyup paste change", "textarea.caps", function () {
		this.value = this.value.toUpperCase();
	});
});
