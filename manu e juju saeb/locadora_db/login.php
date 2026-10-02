<?php
    include "conexao.php";

    $erro = ""; // Variável para armazenar a mensagem de erro de forma elegante

    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $sql = "SELECT * FROM clientes WHERE email = '$email' AND senha = '$senha'";
        $resultado = $conn->query($sql)->fetch_assoc();

        if($resultado){
            session_start();
            $_SESSION['email'] = $resultado['email'];
            $_SESSION['nome'] = $resultado['nome'];
            $_SESSION['id'] = $resultado['id'];
            header('location: index.php');
            exit();
        } else {
            $erro = "E-mail ou senha incorretos.";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Estilos básicos para centralizar na tela */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Caixa do formulário */
        .login-card {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }

        /* Inputs de texto e senha */
        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Garante que o padding não passe do tamanho máximo */
            font-size: 14px;
        }

        input:focus {
            border-color: #007BFF;
            outline: none;
        }

        /* Botão Entrar */
        button {
            width: 100%;
            padding: 12px;
            background-color: #5b0808;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
                       background-color: #ffe100;
        }

        /* Mensagem de Erro */
        .erro {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>LOGIN</h1>

        <!-- Mostra o erro aqui dentro do design caso ele exista -->
        <?php if(!empty($erro)): ?>
            <div class="erro"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="email" name="email" placeholder="Informe seu email" required>
            <input type="password" name="senha" placeholder="Informe sua senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>

</body>
</html>
