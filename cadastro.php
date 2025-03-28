<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $identidade_militar = $_POST['identidade_militar'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, identidade_militar, email, senha) 
            VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nome, $identidade_militar, $email, $senha]);

    echo 'Cadastro realizado com sucesso!';
}
?>

<form method="POST">
    Nome: <input type="text" name="nome" required><br>
    Identidade Militar: <input type="text" name="identidade_militar" required><br>
    Email: <input type="email" name="email" required><br>
    Senha: <input type="password" name="senha" required><br>
    <button type="submit">Cadastrar</button>
</form>
