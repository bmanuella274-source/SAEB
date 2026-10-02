<?php 

session_start();

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";
    
// Busca os dados da tabela de locacao
$sql = "SELECT * FROM locacao";
$resultado = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Locações</title>
    <style>
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

        .btn-novo {
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-voltar {
            color: #7f8c8d;
            text-decoration: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
        }

        .acao-editar {
            color: #3498db;
            text-decoration: none;
        }

        .acao-excluir {
            color: #e74c3c;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-actions">
        <h1>Locações</h1>
        <div>
            <a href="../index.php" class="btn-voltar" style="margin-right: 15px;">← Voltar</a>
            <a href="inserir.php" class="btn-novo">+ Nova Locação</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID Locação</th>
                <!-- Adicione ou ajuste as colunas conforme os campos da sua tabela (ex: cliente, veiculo, data) -->
                <th>Informações</th> 
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if($resultado && $resultado->num_rows > 0): ?>
                <?php foreach($resultado as $locacao): ?>
                    <tr>
                        <td>#<?php echo $locacao['id_locacao']; ?></td>
                        <td>
                            <?php 
                            // Exemplo genérico: exibe o que estiver gravado na coluna (mude para as suas colunas reais)
                            echo htmlspecialchars($locacao['data_locacao'] ?? 'Registro de Locação'); 
                            ?>
                        </td>
                        <td>
                            <a href="atualizar.php?id=<?php echo $locacao['id_locacao']; ?>" class="acao-editar">Editar</a>
                            |
                            <a href="apagar.php?id=<?php echo $locacao['id_locacao']; ?>" class="acao-excluir" onclick="return confirm('Excluir locação?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="text-align: center; color: #7f8c8d;">Nenhuma locação encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
