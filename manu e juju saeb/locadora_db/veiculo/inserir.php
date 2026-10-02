<?php

session_start();

if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";

if (isset($_POST['marca'])) {

    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $valor_diaria = $_POST['valor_diaria'];
    $status = $_POST['status'];

    $sql = "INSERT INTO veiculo (marca, modelo, valor_diaria, status) VALUES ('$marca', '$modelo', '$valor_diaria', '$status')";

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
    <title>Adicionar Veículo</title>
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
            max-width: 400px;
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

        input[type="text"],
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
    
    <h1>Adicionar Veículo</h1>

    <form method="post">
        <div class="form-group">
            <label for="marca">Marca do Veículo</label>
            <input type="text" name="marca" id="marca" placeholder="Ex: Fiat, Chevrolet" required>
        </div>

        <div class="form-group">
            <label for="modelo">Modelo do Veículo</label>
            <input type="text" name="modelo" id="modelo" placeholder="Ex: Uno, Onix" required>
        </div>

        <div class="form-group">
            <label for="valor_diaria">Valor da Diária (R$)</label>
            <input type="number" step="0.01" name="valor_diaria" id="valor_diaria" placeholder="0.00" required>
        </div>

        <div class="form-group">
            <label for="status">Status do Veículo</label>
            <select name="status" id="status" required>
                <option value="Disponivel">Disponível</option>
                <option value="Alugado">Alugado</option>
            </select>
        </div>

        <button type="submit">Cadastrar Veículo</button>
    </form>
</div>

</body>
</html>
