<?php
session_start();
include 'db.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Definição de período padrão (últimos 7 dias)
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
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Arranchamento</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 5px; }
        .btn-export { background-color: #008CBA; }
    </style>
</head>
<body>

<h2>Relatório de Arranchamento</h2>

<form method="GET">
    <label for="data_inicio">Data Início:</label>
    <input type="date" name="data_inicio" value="<?php echo $data_inicio; ?>" required>
    
    <label for="data_fim">Data Fim:</label>
    <input type="date" name="data_fim" value="<?php echo $data_fim; ?>" required>

    <button type="submit">Filtrar</button>
</form>

<table>
    <tr>
        <th>Data</th>
        <th>Nome</th>
        <th>Café da Manhã</th>
        <th>Almoço</th>
        <th>Jantar</th>
    </tr>
    <?php if (count($arranchamentos) > 0): ?>
        <?php foreach ($arranchamentos as $arranchamento): ?>
            <tr>
                <td><?php echo date("d/m/Y", strtotime($arranchamento['data'])); ?></td>
                <td><?php echo $arranchamento['nome']; ?></td>
                <td><?php echo $arranchamento['cafe_da_manha'] ? '✔' : '❌'; ?></td>
                <td><?php echo $arranchamento['almoco'] ? '✔' : '❌'; ?></td>
                <td><?php echo $arranchamento['jantar'] ? '✔' : '❌'; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Nenhum registro encontrado.</td>
        </tr>
    <?php endif; ?>
</table>

<br>
<a href="dashboard.php" class="btn">Voltar</a>
<a href="exportar_pdf.php?data_inicio=<?php echo $data_inicio; ?>&data_fim=<?php echo $data_fim; ?>" class="btn btn-export">Exportar para PDF</a>

</body>
</html>
