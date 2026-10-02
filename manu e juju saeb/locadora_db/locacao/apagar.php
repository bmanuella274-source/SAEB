<?php 

session_start();

if(!$_SESSION['email']){
    header('location: ../login.php');
    exit();
}

include "../conexao.php";

$id = $_GET['id'];

$sql = "DELETE FROM locacao WHERE id = $id";

$resultado = $conn->query($sql);

header('Location: listar.php');
exit();

?>
