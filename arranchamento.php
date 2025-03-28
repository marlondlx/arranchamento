<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_id = $_SESSION['usuario_id'];
    $data = $_POST['data'];
    $cafe = isset($_POST['cafe']) ? 1 : 0;
    $almoco = isset($_POST['almoco']) ? 1 : 0;
    $jantar = isset($_POST['jantar']) ? 1 : 0;

    $sql = "INSERT INTO arranchamentos (usuario_id, data, cafe_da_manha, almoco, jantar) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$usuario_id, $data, $cafe, $almoco, $jantar])) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Erro ao registrar o arranchamento.";
    }
}
?>

<h2>Selecionar Arranchamento</h2>

<form method="POST">
    <label>Data:</label>
    <input type="date" name="data" required><br><br>

    <label><input type="checkbox" name="cafe"> Café da Manhã</label><br>
    <label><input type="checkbox" name="almoco"> Almoço</label><br>
    <label><input type="checkbox" name="jantar"> Jantar</label><br><br>

    <button type="submit">Salvar Arranchamento</button>
</form>

<br>
<a href="dashboard.php">Voltar</a>
