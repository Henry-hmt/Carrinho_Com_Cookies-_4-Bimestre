<?php
session_start(); 
// email:admin@gmail e senha:123 ; para testes

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['senha'])) {
    require 'db.php'; 
    
    
    $email = $_POST['email'];
    $senha = md5($_POST['senha']); 

   $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
    $stmt->execute(['email' => $email, 'senha' => $senha]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($usuario) {
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];
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
    <title>Login - Loja Virtual</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Faça Login</h1>
        <a href="index.php">Voltar para a Loja</a>
    </header>

    <main>
        <h2>Login</h2>
        <?php if (isset($erro)) echo "<p style='color:red'>$erro</p>"; ?>

        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </main>
</body>
</html>
