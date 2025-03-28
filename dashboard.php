<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];

// Buscar arranchamentos do usuário
$sql = "SELECT * FROM arranchamentos WHERE usuario_id = ? ORDER BY data ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id]);
$arranchamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 5px; }
        .btn-edit { background-color: #4CAF50; }
        .btn-delete { background-color: #f44336; }
    </style>
</head>
<body>

<h2>Bem-vindo, <?php echo $_SESSION['usuario_email']; ?>!</h2>
<h3>Seus Arranchamentos</h3>

<a href="arranchamento.php" class="btn btn-edit">Novo Arranchamento</a>

<table>
    <tr>
        <th>Data</th>
        <th>Café da Manhã</th>
        <th>Almoço</th>
        <th>Jantar</th>
        <th>Ações</th>
    </tr>
    <?php if (count($arranchamentos) > 0): ?>
        <?php foreach ($arranchamentos as $arranchamento): ?>
            <tr>
                <td><?php echo date("d/m/Y", strtotime($arranchamento['data'])); ?></td>
                <td><?php echo $arranchamento['cafe_da_manha'] ? '✔' : '❌'; ?></td>
                <td><?php echo $arranchamento['almoco'] ? '✔' : '❌'; ?></td>
                <td><?php echo $arranchamento['jantar'] ? '✔' : '❌'; ?></td>
                <td>
                    <a href="editar_arranchamento.php?id=<?php echo $arranchamento['id']; ?>" class="btn btn-edit">Editar</a>
                    <a href="excluir_arranchamento.php?id=<?php echo $arranchamento['id']; ?>" class="btn btn-delete" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Nenhum arranchamento registrado.</td>
        </tr>
    <?php endif; ?>
</table>

<br>
<a href="logout.php" class="btn btn-delete">Sair</a>

</body>
</html>
