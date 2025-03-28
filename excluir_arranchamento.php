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

$sql = "DELETE FROM arranchamentos WHERE id = ? AND usuario_id = ?";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([$id, $_SESSION['usuario_id']])) {
    header("Location: dashboard.php");
    exit();
} else {
    echo "Erro ao excluir o arranchamento.";
}
?>
