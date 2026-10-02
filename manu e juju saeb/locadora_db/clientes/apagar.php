<?php 

 session_start();

    if(!$_SESSION['email']){
        header('location: ../login.php');
    }

    include "../conexao.php";

    $id = $_GET['id'];

    $sql = "DELETE FROM clientes WHERE id = $id";

    $resultado = $conn->query($sql);

    header('Location: listar.php')

?>