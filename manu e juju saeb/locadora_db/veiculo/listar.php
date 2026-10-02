<?php 

session_start();

// Verifica a sessão de forma segura
if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";
    
$sql = "SELECT * FROM veiculo";
$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Veículos</title>
    <style>
        /* Configurações básicas e limpas */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            padding: 20px;
            color: #333;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 20px auto;
        }

        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            color: #2c3e50;
        }

        .btn-novo {
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-novo:hover {
            background-color: #27ae60;
        }

        .btn-voltar {
            color: #7f8c8d;
            text-decoration: none;
        }

        .btn-voltar:hover {
            text-decoration: underline;
        }

        /* Estrutura da Tabela */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #555;
        }

        /* Links de Ações */
        .acao-editar {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }

        .acao-editar:hover {
            text-decoration: underline;
        }

        .acao-excluir {
            color: #e74c3c;
            text-decoration: none;
            font-weight: bold;
        }

        .acao-excluir:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-actions">
        <h1>Veículos</h1>
        <div>
            <a href="../index.php" class="btn-voltar" style="margin-right: 15px;">← Voltar</a>
            <a href="inserir.php" class="btn-novo">+ Novo Veículo</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Veículo</th>
                <th style="width: 150px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($resultado && $resultado->num_rows > 0): ?>
                <?php foreach($resultado as $veiculo): ?>
                    <tr>
                        <!-- Ajustado para bater com as colunas do banco de dados (ex: 'marca' e 'modelo' ou apenas 'nome') -->
                        <td>
                            <?php 
                            if (isset($veiculo['marca']) && isset($veiculo['modelo'])) {
                                echo htmlspecialchars($veiculo['marca'] . " " . $veiculo['modelo']);
                            } else {
                                echo htmlspecialchars($veiculo['nome'] ?? 'Sem nome'); 
                            }
                            ?>
                        </td>
                        <td>
                            <a href="atualizar.php?id=<?php echo $veiculo['id']; ?>" class="acao-editar">Editar</a>
                            <span style="color: #ddd;">|</span>
                            <a href="apagar.php?id=<?php echo $veiculo['id']; ?>" class="acao-excluir" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" style="text-align: center; color: #7f8c8d; padding: 20px;">Nenhum veículo encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
