<?php

session_start();

if(!$_SESSION['email']){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";

// Pega o ID do cliente que veio pela URL (ex: editar.php?id=5)
$id = $_GET['id'];

// BUSCA OS DADOS ATUAIS DO CLIENTE PARA EXIBIR NO FORMULÁRIO
$sql_busca = "SELECT * FROM clientes WHERE id = '$id'";
$resultado_busca = $conn->query($sql_busca);
$cliente = $resultado_busca->fetch_assoc();

if (isset($_POST['email'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // CORREÇÃO: Adicionado o WHERE para atualizar apenas este cliente específico
    $sql = "UPDATE clientes SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'";

    $resultado = $conn->query($sql);

    header('location: listar.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <style>
        /* Estilos Gerais / Reset básico */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
        }

        /* Container do Formulário */
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }

        /* Grupos de campos do formulário */
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
            color: #555;
        }

        /* Inputs de texto, email e senha */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        /* Efeito de foco azul nos campos */
        input:focus {
            border-color: #3498db;
            outline: none;
        }

        /* Botão de Salvar Alterações (Azul para diferenciar do cadastro) */
        button {
            width: 100%;
            padding: 12px;
           background-color: #5b0808;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #ffe100;
        }

        /* Link de Voltar */
        .btn-voltar {
            display: inline-block;
            margin-bottom: 15px;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }

        .btn-voltar:hover {
            color: #34495e;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="listar.php" class="btn-voltar">← Cancelar e voltar</a>
    
    <h1>Editar Cliente</h1>

    <form method="post">
        <div class="form-group">
            <label for="nome">Nome Completo</label>
            <input type="text" name="nome" id="nome" placeholder="Nome do cliente" value="<?php echo htmlspecialchars($cliente['nome'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="exemplo@gmail.com" value="<?php echo htmlspecialchars($cliente['email'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="senha">Nova Senha</label>
            <input type="password" name="senha" id="senha" placeholder="Digite a nova senha ou atual" value="<?php echo htmlspecialchars($cliente['senha'] ?? ''); ?>" required>
        </div>

        <button type="submit">Salvar Alterações</button>
    </form>
</div>

</body>
</html>
