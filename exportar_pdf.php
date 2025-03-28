<?php
session_start();
include 'db.php';
require(__DIR__ . '/fpdf/fpdf.php');


// Verifica se as datas foram enviadas
$data_inicio = isset($_GET['data_inicio']) ? $_GET['data_inicio'] : date('Y-m-d', strtotime('-7 days'));
$data_fim = isset($_GET['data_fim']) ? $_GET['data_fim'] : date('Y-m-d');

// Consulta SQL para buscar os arranchamentos no período
$sql = "SELECT a.data, u.nome, a.cafe_da_manha, a.almoco, a.jantar
        FROM arranchamentos a
        JOIN usuarios u ON a.usuario_id = u.id
        WHERE a.data BETWEEN ? AND ?
        ORDER BY a.data, u.nome";

$stmt = $pdo->prepare($sql);
$stmt->execute([$data_inicio, $data_fim]);
$arranchamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Criando um novo PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(190, 10, 'Relatorio de Arranchamento', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, "Periodo: " . date("d/m/Y", strtotime($data_inicio)) . " - " . date("d/m/Y", strtotime($data_fim)), 0, 1, 'C');
$pdf->Ln(5);

// Criando cabeçalho da tabela
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 10, 'Data', 1, 0, 'C');
$pdf->Cell(60, 10, 'Nome', 1, 0, 'C');
$pdf->Cell(30, 10, 'Cafe', 1, 0, 'C');
$pdf->Cell(30, 10, 'Almoco', 1, 0, 'C');
$pdf->Cell(30, 10, 'Jantar', 1, 1, 'C');

// Preenchendo a tabela com os dados
$pdf->SetFont('Arial', '', 10);
foreach ($arranchamentos as $arranchamento) {
    $pdf->Cell(35, 10, date("d/m/Y", strtotime($arranchamento['data'])), 1, 0, 'C');
    $pdf->Cell(60, 10, utf8_decode($arranchamento['nome']), 1, 0, 'C');
    $pdf->Cell(30, 10, $arranchamento['cafe_da_manha'] ? '✔' : '❌', 1, 0, 'C');
    $pdf->Cell(30, 10, $arranchamento['almoco'] ? '✔' : '❌', 1, 0, 'C');
    $pdf->Cell(30, 10, $arranchamento['jantar'] ? '✔' : '❌', 1, 1, 'C');
}

// Saída do PDF
$pdf->Output('D', 'relatorio_arranchamento.pdf');
?>
