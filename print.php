<?php

/**
 * Print => Planejamento
 *
 * @package IdeYou
 * @author Isaque Costa
 * @copyright 2023
 **/

require_once("init.php");
require_once(BASEPATH . "lib/fpdf/fpdf.php");

$ESCOLA = "ESCOLA ESTADUAL JOÃO PAULO II";
$EMAIL = "Telefone: (31) 9 9510-8515         Email: escola.213314@eduacao.mg.gov.br";
$ENDERECO = 'Avenida dos Eucaliptos, 100 Revés do Belém - Bom Jesus do Galho/MG 35340-000';

$ANEXOS = [];
$descricao = Core::post('descricao') ?: [];
$link   	 = Core::post('link') ?: [];

foreach ($descricao as $i => $item) {
	$ANEXOS[] = (object) array('descricao' => $descricao[$i], 'link' => $link[$i]);
}

/*
 * construtor da classe, que permite que seja definido o formato da pagina
 * P=Retrato, mm =tipo de medida utilizada no casso milimetros,
 * tipo de folha = 210 x 297 mm
 */

for ($p = 1; $p <= 2; $p++) {

	$pdf = new FPDF();
	$pdf->SetXY(0, 0);
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetDisplayMode('real');
	$pdf->SetSubject('Planejamento de Aula');
	$pdf->SetAuthor('Isaque Costa - (31) 9 9071-2203');
	$pdf->SetCreator('IdeYou - Acelerando Ideias!');
	$pdf->SetTitle('Planejamento_' . utf8_decode(Core::post('turma')) . '_' . Core::post('periodo_i') . '_' . Core::post('periodo_f'));
	////////////////////////////////////////////////////////////////////////////////
	$pdf->AddPage('P');
	$pdf->SetTextColor(0, 0, 0);
	$pdf->Image(BASEPATH . 'assets/images/powered_opacity.jpg', 0, -25, 210, 210, 'JPG');

	$pdf->Cell(45, 25, utf8_decode(''), '', 0, 'C', false);
	$pdf->Image(BASEPATH . 'assets/images/EEJPII.jpg', 9, 5, 25, 0, 'JPG');

	$pdf->SetFont('ARIAL', 'B', 12);
	$pdf->Cell(165, 10, utf8_decode($ESCOLA), '', 2, 'C', false);

	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(165, 2, utf8_decode(''), '', 2, 'C', false);
	$pdf->Cell(165, 4, utf8_decode($ENDERECO), '', 2, 'C', false);
	$pdf->Cell(165, 4, utf8_decode($EMAIL), '', 2, 'C', false);
	$pdf->Ln(5);

	////////////////////////////////////////////////////////////////////////////////
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(23, 7, utf8_decode('Professor(a): '), 'TB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(50, 7, utf8_decode(Core::post('professor')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(15, 7, utf8_decode('Código: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(35, 7, utf8_decode(Core::post('codigo')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(20, 7, utf8_decode('Ano/Turma: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(0, 7, utf8_decode(Core::post('turma')), 'TB', 1, 'L', false);



	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(76, 7, utf8_decode('Área do Conhecimento/Componente Currícular: '), 'TB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(60, 7, utf8_decode(Core::post('componente_curricular')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(18, 7, utf8_decode('Bimestre: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(7, 7, utf8_decode(Core::post('bimestre')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(16, 7, utf8_decode('Período: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(33, 7, utf8_decode(Core::post('periodo_i') . ' à ' . Core::post('periodo_f')), 'TB', 1, 'L', false);

	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Unidade Temática: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('unidade_tematica')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Objeto de Conhecimento: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('objeto_de_conhecimento')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Habilidade: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('habilidade')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Competências Específicas: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('competencias_especificas')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Expectativa de Aprendizagem: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('expectativa_de_aprendizagem')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Espaço de Aula: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('espaco_de_aula')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Materiais Utilizados: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('materiais_utilizados')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Organização dos Alunos: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('organizacao_dos_alunos')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Metodologias/Estratégias de Ensino: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('metodologias_de_ensino')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Forma de Avaliação: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('forma_de_avaliacao')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Unidade Temática/Práticas de Linguagens: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('praticas_de_linguagem')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Habilidades: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('habilidades')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Metodologias / Estratégias de Ensino: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('estrategias_de_ensino')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Avaliações / Formas: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->MultiCell(0, 4.5, utf8_decode(Core::post('avaliacoes_formas')), '', 'J');

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);

	$pdf->Ln(1);
	$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////
	$pdf->Ln(1);
	$Y1 = $pdf->GetY();
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->MultiCell(45, 4, utf8_decode('Anexos: '), '', 'L');
	$Y2 = $pdf->GetY();

	$pdf->SetXY(45, $Y1);

	if ($Y2 > $pdf->GetY())
		$pdf->SetY($Y2);


	$pdf->SetFont('ARIAL', 'B', 9);
	foreach ($ANEXOS as $id => $item) {
		$pdf->SetX(50);
		$pdf->Image('https://chart.googleapis.com/chart?cht=qr&chs=250x250&chld=L|0&chl=' . urlencode($item->link), 50, $pdf->GetY(), 25, 25, 'PNG');
		$pdf->Image(BASEPATH . 'assets/images/qrcode_overlay.png', 50, $pdf->GetY(), 25, 25, 'PNG');
		$pdf->Cell(25, 25, utf8_decode(''), 0, 0, 'L');
		$pdf->SetX(78);
		$pdf->MultiCell(0, 25, utf8_decode('#' . sprintf('%02d', $id + 1) . ' - ' . $item->descricao), 0, 'L');
		$pdf->Ln(3);
	}

	$pdf->Ln(1);
}
/*
 * IMPRIMIR A SAIDA DO ARQUIVO
 * nome do arquivo
 * I: envia o arquivo diretamente para o browser,
 * Se o plug-in estiver instalado ele serao usado.
 * mais opcoes no final do artigo ou visite o manual fpdf.
 */
$download = Core::post('download') ? 'D' : 'I';
$pdf->Output($download, 'Planejamento_1ANO_A.pdf');
