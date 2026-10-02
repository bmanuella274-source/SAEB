<?php 
    session_start();

    if(!isset($_SESSION['email']) || empty($_SESSION['email'])){
        header('location: login.php');
        exit(); 
    }
    
    include "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f6f9;
            color: #333;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #5b0808;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 1px;
            color: #ffffff;
        }

        .menu-links {
            display: flex;
            flex-direction: column;
            gap: 10px;
            flex-grow: 1;
        }

        .btn-menu {
            display: block;
            color: #cbd5e1;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-menu:hover {
            background-color: #ffee00;
            color: #fff;
            padding-left: 20px;
        }

        .btn-logout {
            display: block;
            color: #ffffff;
            text-decoration: none;
            padding: 12px 15px;
            border-radius: 6px;
            text-align: center;
            background-color: #ffc400;
            transition: background 0.3s;
            font-weight: 600;
        }

        .btn-logout:hover {
            background-color: #ffee02;
            color: #fff;
        }

        .main-content {
            flex-grow: 1;
            padding: 40px;
        }

        .main-content h1 {
            font-size: 2rem;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .main-content p {
            color: #000000;
            font-size: 1rem;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                min-height: auto;
            }
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div>
            <h2>SISTEMA PHP</h2>
            <nav class="menu-links">
                <a href="clientes/listar.php" class="btn-menu">📂 Gerenciar Clientes</a>
                <a href="veiculo/listar.php" class="btn-menu">🚗 Gerenciar Veículos</a>
                <!-- NOVO BOTÃO: Rota para a tabela de locação -->
                <a href="locacao/listar.php" class="btn-menu">🔑 Gerenciar Locações</a>
            </nav>
        </div>
        
        <a href="logout.php" class="btn-logout">Sair do Sistema</a>
    </aside>

    <main class="main-content">
        <h1>Bem-vindo!</h1>
        <p>Utilize o menu lateral para navegar pelas opções do sistema.</p>
    </main>

</body>
</html>



