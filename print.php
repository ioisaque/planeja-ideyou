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

class PlanejamentoPDF extends FPDF
{
	function Header()
	{
		$this->Image(BASEPATH . 'assets/images/background_logo.png', 31.5, 114, 147, 0, 'PNG');
	}
}

$ESCOLA = "ESCOLA ESTADUAL JOÃO PAULO II";
$EMAIL = "Telefone: (31) 9 9510-8515         Email: escola.213314@eduacao.mg.gov.br";
$ENDERECO = 'Avenida dos Eucaliptos, 100 Revés do Belém - Bom Jesus do Galho/MG 35340-000';
$PLANEJA = 'Planejamento_' . CLEANUP(Core::post('turma')) . '_' . DATA(Core::post('periodo_i')) . '_' . DATA(Core::post('periodo_f'));

$ANEXOS = [];
$descricao = Core::post('descricao') ?: [];
$link   	 = Core::post('link') ?: [];

foreach ($descricao as $i => $item) {
	if (!empty($descricao[$i]) && !empty($link[$i]))
		$ANEXOS[] = (object) array('descricao' => $descricao[$i], 'link' => $link[$i]);
}

/*
 * construtor da classe, que permite que seja definido o formato da pagina
 * P=Retrato, mm =tipo de medida utilizada no casso milimetros,
 * tipo de folha = 210 x 297 mm
 */

$pdf = new PlanejamentoPDF();
	$pdf->SetXY(0, 0);
	$pdf->SetMargins(0, 0, 0);
	$pdf->SetAutoPageBreak(true);
	$pdf->SetDisplayMode('real');
	$pdf->SetSubject('Planejamento de Aula');
	$pdf->SetAuthor('Isaque Costa - (31) 9 9071-2203');
	$pdf->SetCreator('IdeYou - Acelerando Ideias!');
	$pdf->SetTitle($PLANEJA);
	////////////////////////////////////////////////////////////////////////////////
	$pdf->AddPage('P');
	$pdf->SetTextColor(0, 0, 0);

	$pdf->Cell(45, 25, CLEANUP(''), '', 0, 'C', false);
	$pdf->Image(BASEPATH . 'assets/images/EEJPII.jpg', 9, 5, 25, 0, 'JPG');

	$pdf->SetFont('ARIAL', 'B', 12);
	$pdf->Cell(165, 10, CLEANUP($ESCOLA), '', 2, 'C', false);

	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(165, 2, CLEANUP(''), '', 2, 'C', false);
	$pdf->Cell(165, 4, CLEANUP($ENDERECO), '', 2, 'C', false);
	$pdf->Cell(165, 4, CLEANUP($EMAIL), '', 2, 'C', false);
	$pdf->Ln(5);

	////////////////////////////////////////////////////////////////////////////////
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(23, 7, CLEANUP('Professor(a): '), 'TB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(50, 7, CLEANUP(Core::post('professor')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(15, 7, CLEANUP('Código: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(35, 7, CLEANUP(Core::post('codigo')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(20, 7, CLEANUP('Ano/Turma: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(0, 7, CLEANUP(Core::post('turma')), 'TB', 1, 'L', false);



	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(76, 7, CLEANUP('Área do Conhecimento/Componente Currícular: '), 'TB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(60, 7, CLEANUP(Core::post('componente_curricular')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(18, 7, CLEANUP('Bimestre: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(7, 7, CLEANUP(Core::post('bimestre')), 'TRB', 0, 'L', false);
	$pdf->SetFont('ARIAL', 'B', 9);
	$pdf->Cell(16, 7, CLEANUP('Período: '), 'TLB', 0, 'L', false);
	$pdf->SetFont('ARIAL', '', 9);
	$pdf->Cell(33, 7, CLEANUP(DATA(Core::post('periodo_i')) . ' à ' . DATA(Core::post('periodo_f'))), 'TB', 1, 'L', false);

	//////////////////////////////////////////////////////////////////////////////
	if (Core::post('unidade_tematica') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Unidade Temática: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('unidade_tematica')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('objeto_de_conhecimento') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Objeto de Conhecimento: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('objeto_de_conhecimento')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('habilidade') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Habilidade: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('habilidade')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
    if (Core::post('jornada') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Jornada de Consolidação da Habilidade: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('jornada')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('competencias_especificas') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Competências Específicas: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('competencias_especificas')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('expectativa_de_aprendizagem') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Expectativa de Aprendizagem: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('expectativa_de_aprendizagem')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('espaco_de_aula') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Espaço de Aula: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('espaco_de_aula')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('materiais_utilizados') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Materiais Utilizados: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('materiais_utilizados')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('organizacao_dos_alunos') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Organização dos Alunos: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('organizacao_dos_alunos')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('metodologias_de_ensino') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Metodologias/Estratégias de Ensino: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('metodologias_de_ensino')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (Core::post('forma_de_avaliacao') != '') :
		//////////////////////////////////////////////////////////////////////////////
		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Forma de Avaliação: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);
		$pdf->SetFont('ARIAL', '', 9);
		$pdf->MultiCell(0, 4.5, CLEANUP(Core::post('forma_de_avaliacao')), '', 'J');

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->Ln(1);
		$pdf->Line(0, $pdf->GetY(), 210, $pdf->GetY());
	//////////////////////////////////////////////////////////////////////////////
	endif;
	if (sizeof($ANEXOS)) :
		//////////////////////////////////////////////////////////////////////////////

		$pdf->Ln(1);
		$Y1 = $pdf->GetY();
		$pdf->SetFont('ARIAL', 'B', 9);
		$pdf->MultiCell(45, 4, CLEANUP('Anexos: '), '', 'L');
		$Y2 = $pdf->GetY();

		$pdf->SetXY(45, $Y1);

		if ($Y2 > $pdf->GetY())
			$pdf->SetY($Y2);

		$pdf->SetFont('ARIAL', 'B', 9);
		foreach ($ANEXOS as $id => $item) {
			$rowH = 28;
			if ($pdf->GetY() + $rowH > 270)
				$pdf->AddPage('P');

			$y = $pdf->GetY();
			$pdf->Image('https://cdn.isaque.it/qrcode/?txt=' . urlencode($item->link), 50, $y, 25, 25, 'PNG');
			$pdf->SetXY(78, $y + 9);
			$pdf->MultiCell(0, 5, CLEANUP('#' . sprintf('%02d', $id + 1) . ' - ' . $item->descricao), 0, 'L');
			$pdf->SetY($y + $rowH);
		}

		$pdf->Ln(1);
	//////////////////////////////////////////////////////////////////////////////
	endif;
	//////////////////////////////////////////////////////////////////////////////
/*
 * IMPRIMIR A SAIDA DO ARQUIVO
 * nome do arquivo
 * I: envia o arquivo diretamente para o browser,
 * Se o plug-in estiver instalado ele serao usado.
 * mais opcoes no final do artigo ou visite o manual fpdf.
 */
$download = Core::post('download') ? 'D' : 'I';
$pdf->Output($download, $PLANEJA . '.pdf');
