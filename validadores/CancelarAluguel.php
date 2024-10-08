<?php
session_start();
require('../validadores/EstaLogado.php');
require('conectaBanco.php');

// Verificar se o usuário está logado
if (isset($_SESSION['usuario_validado']) && $_SESSION['usuario_validado'] == true) {
    // Verificar se o método de requisição é POST e se o parâmetro alu_id foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['alu_id'])) {
        // Recuperar o ID do aluguel a ser cancelado
        $alu_id = $_POST['alu_id'];
            $sql = "DELETE FROM alugar WHERE AluId = :alu_id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':alu_id', $alu_id, PDO::PARAM_INT);
            $stmt->execute();

            header("Location: ../usuario/AlugueisFeitos.php");
            exit();
    } else {
        // Se não foi enviado o parâmetro alu_id, redirecionar para a página de aluguéis
        header("Location: ../AlugueisFeitos.php");
        exit(); // Certifique-se de sair após redirecionar
    }
} else {
    // Se o usuário não estiver logado, redirecionar para a página de login
    header("Location: ../login.php");
    exit(); // Certifique-se de sair após redirecionar
}
?>