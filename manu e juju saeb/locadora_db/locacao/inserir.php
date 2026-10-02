<?php

session_start();

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";

// Busca os clientes e veículos cadastrados para listar nos campos de seleção (<select>)
$clientes = $conn->query("SELECT id, nome FROM clientes");
$veiculos = $conn->query("SELECT id, marca, modelo FROM veiculo WHERE status = 'Disponivel'");

if (isset($_POST['id_cliente'])) {

    $id_cliente = $_POST['id_cliente'];
    $id_veiculo = $_POST['id_veiculo'];
    $data_retirada = $_POST['data_retirada'];
    $data_devolucao = $_POST['data_devolucao'];
    $valor_total = $_POST['valor_total'];

    // Insere os dados na tabela de locações
    $sql = "INSERT INTO locacao (id_cliente, id_veiculo, data_retirada, data_devolucao, valor_total) 
            VALUES ('$id_cliente', '$id_veiculo', '$data_retirada', '$data_devolucao', '$valor_total')";

    $resultado = $conn->query($sql);

    // Opcional: Atualiza o status do veículo para 'Alugado' após a locação ser cadastrada
    $conn->query("UPDATE veiculo SET status = 'Alugado' WHERE id = '$id_veiculo'");

    header('location: listar.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Locação</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #333;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
            color: #555;
        }

        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            background-color: #fff;
        }

        input:focus, select:focus {
            border-color: #2ecc71;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #27ae60;
        }

        .btn-voltar {
            display: inline-block;
            margin-bottom: 15px;
            color: #7f8c8d;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-voltar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <a href="listar.php" class="btn-voltar">← Cancelar e voltar</a>
    
    <h1>Nova Locação</h1>

    <form method="post">
        <!-- Seleção de Clientes -->
        <div class="form-group">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente" required>
                <option value="">Selecione o cliente...</option>
                <?php while($c = $clientes->fetch_assoc()): ?>
                    <option value="<?php echo $c['id']; ?>">
                        <?php echo htmlspecialchars($c['nome']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Seleção de Veículos (Lista apenas os com status 'Disponivel') -->
        <div class="form-group">
            <label for="id_veiculo">Veículo Disponível</label>
            <select name="id_veiculo" id="id_veiculo" required>
                <option value="">Selecione o veículo...</option>
                <?php while($v = $veiculos->fetch_assoc()): ?>
                    <option value="<?php echo $v['id']; ?>">
                        <?php echo htmlspecialchars($v['marca'] . " " . $v['modelo']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Data de Retirada -->
        <div class="form-group">
            <label for="data_retirada">Data de Retirada</label>
            <input type="date" name="data_retirada" id="data_retirada" required>
        </div>

        <!-- Data de Devolução -->
        <div class="form-group">
            <label for="data_devolucao">Data de Devolução</label>
            <input type="date" name="data_devolucao" id="data_devolucao" required>
        </div>

        <!-- Valor Total -->
        <div class="form-group">
            <label for="valor_total">Valor Total (R$)</label>
            <input type="number" step="0.01" name="valor_total" id="valor_total" placeholder="0.00" required>
        </div>

        <button type="submit">Confirmar Locação</button>
    </form>
</div>

</body>
</html>
