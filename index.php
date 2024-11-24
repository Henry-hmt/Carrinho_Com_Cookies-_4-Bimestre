<?php
session_start(); 

$produtos = [
    ['id' => 1, 'nome' => 'Lamborghini Countach Quattrovalvole 1988', 'preco' => 5900000.00],
    ['id' => 2, 'nome' => 'Dodge Charger', 'preco' => 300000.00],
    ['id' => 3, 'nome' => '1970 Ford Mustang Tributo Boss', 'preco' => 551646.00]
];

$usuario_logado = isset($_SESSION['usuario_id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
    require 'db.php'; 

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $stmt->execute(['email' => $email, 'senha' => $senha]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['email'];
        header("Location: index.php"); 
        exit;
    } else {
        $erro = "E-mail ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="header-container">
            <h1>Old Cars</h1>
            <div class="auth-links">
                <?php if ($usuario_logado): ?>
                    <p>Bem-vindo <?= $_SESSION['usuario_nome'] ?></p>
                    <a href="logout.php"> Sair</a>
                <?php else: ?>
                    <a href="login.php" class="login-link">Faça login aqui</a>
                <?php endif; ?>
            </div>
        </div>
        <a href="ver_carrinho.php">Ver Carrinho</a>
    </header>
    
    <main>
        <h2>Produtos</h2>
        
        <?php foreach ($produtos as $produto): ?>
            <div class="produto">
                <h3><?= $produto['nome'] ?></h3>
                <p>Preço: R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                <img src="imgs/P<?= $produto['id'] ?>.jpg">
                <form method="POST" action="carrinho.php">
                    <input type="hidden" name="produto_id" value="<?= $produto['id'] ?>">
                    <button type="submit">Adicionar ao Carrinho</button>
                </form>
            </div>
        <?php endforeach; ?>
       
    </main>
</body>
</html>
