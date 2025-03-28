<?php
session_start();
include 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID do arranchamento não fornecido!";
    exit();
}

$id = $_GET['id'];

// Buscar o arranchamento no banco de dados
$sql = "SELECT * FROM arranchamentos WHERE id = ? AND usuario_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id, $_SESSION['usuario_id']]);
$arranchamento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$arranchamento) {
    echo "Arranchamento não encontrado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cafe = isset($_POST['cafe']) ? 1 : 0;
    $almoco = isset($_POST['almoco']) ? 1 : 0;
    $jantar = isset($_POST['jantar']) ? 1 : 0;

    $sql = "UPDATE arranchamentos SET cafe_da_manha = ?, almoco = ?, jantar = ? WHERE id = ? AND usuario_id = ?";
    $stmt = $pdo->prepare($sql);
    
    if ($stmt->execute([$cafe, $almoco, $jantar, $id, $_SESSION['usuario_id']])) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Erro ao atualizar o arranchamento.";
    }
}
?>

<h2>Editar Arranchamento - <?php echo $arranchamento['data']; ?></h2>
<form method="POST">
    <label><input type="checkbox" name="cafe" <?php echo $arranchamento['cafe_da_manha'] ? 'checked' : ''; ?>> Café da Manhã</label><br>
    <label><input type="checkbox" name="almoco" <?php echo $arranchamento['almoco'] ? 'checked' : ''; ?>> Almoço</label><br>
    <label><input type="checkbox" name="jantar" <?php echo $arranchamento['jantar'] ? 'checked' : ''; ?>> Jantar</label><br>
    <button type="submit">Salvar</button>
</form>
<a href="dashboard.php">Cancelar</a>
