<?php 
    session_start();

    // Correção de segurança: adicionado o exit() para interromper a execução
    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('location: ../login.php');
        exit();
    }

    include "../conexao.php";
    
    $sql = "SELECT * FROM clientes";
    $resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes</title>
    <style>
        /* Configurações Globais */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            color: #333;
            padding: 40px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        /* Cabeçalho da Página */
        .header-painel {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
        }

        h1 {
            font-size: 1.8rem;
            color: #0f172a;
        }

        /* Botões */
        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: background 0.2s;
        }

        .btn-novo {
                     background-color: #930707;
            color: #fff;
        }

        .btn-novo:hover {
            background-color: #0369a1;
        }

        .btn-voltar {
            background-color: #64748b;
            color: #fff;
        }

        .btn-voltar:hover {
            background-color: #475569;
        }

        /* Tabela de Dados */
        .tabela-clientes {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .tabela-clientes th, 
        .tabela-clientes td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabela-clientes th {
            background-color: #930707;
            color: #fff;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
        }

        .tabela-clientes tr:hover {
            background-color: #f8fafc;
        }

        /* Links de Ação na Tabela */
        .acao {
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .btn-editar {
            color: #3b5576;
        }

        .btn-editar:hover {
            background-color: #e0f2fe;
        }

        .btn-excluir {
            color: #ef4444;
        }

        .btn-excluir:hover {
            background-color: #fee2e2;
        }

        /* Alertas */
        .alert-info {
            background-color: #f0fdf4;
            color: #166534;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #bbf7d0;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Topo com Título e Ações Principais -->
        <div class="header-painel">
            <h1>Clientes Cadastrados</h1>
            <div>
                <a href="/locadora_db" class="btn btn-voltar">⬅ Voltar</a>
                <a href="inserir.php" class="btn btn-novo">➕ Novo Cliente</a>
            </div>
        </div>

        <!-- Renderização dos Dados -->
        <?php if($resultado && $resultado->num_rows > 0): ?>
            <table class="tabela-clientes">
                <thead>
                    <tr>
                        <th>Nome do Cliente</th>
                        <th style="width: 200px; text-align: center;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resultado as $clientes): ?>
                        <tr>
                            <td><strong><?php echo htmlspecialchars($clientes['nome']); ?></strong></td>
                            <td style="text-align: center;">
                                <a href="atualizar.php?id=<?php echo $clientes['id']; ?>" class="acao btn-editar">Editar</a>
                                <span style="color: #cbd5e1;">|</span>
                                <a href="apagar.php?id=<?php echo $clientes['id']; ?>" class="acao btn-excluir">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert-info">
                Nenhum cliente cadastrado até o momento.
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
