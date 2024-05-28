<?php
session_start();

try {
    $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['dataEntrada']) && !empty($_POST['dataSaida'])) {
        // Criando objetos DateTime diretamente
        $data_entrada = new DateTime($_POST['dataEntrada']);
        $data_saida = new DateTime($_POST['dataSaida']);
        $id_ocupante = isset($_SESSION['UsuarioId']) ? $_SESSION['UsuarioId'] : null;
        $id_anuncio = $_SESSION['id_anuncio'];

        if ($id_ocupante === null) {
            // Se o id do ocupante não estiver definido na sessão, redirecione com mensagem de erro
            header("Location: AnuncioDetalhes.php?id=$id_anuncio&error=5");
            exit();
        }

        // Validar se a data de saída é posterior à data de entrada
        if ($data_saida <= $data_entrada) {
            header("Location: AnuncioDetalhes.php?id=$id_anuncio&error=4"); // Redireciona com mensagem de erro
            exit();
        }

        // Consulta para verificar se o espaço está disponível durante o período escolhido
        $query_verificar_disponibilidade = "SELECT * FROM alugar WHERE EspId = :id_anuncio AND ((AluDataEntrada <= :data_saida) AND (AluDataSaida >= :data_entrada))";
        $stmt_verificar_disponibilidade = $conexao->prepare($query_verificar_disponibilidade);
        $stmt_verificar_disponibilidade->bindParam(':id_anuncio', $id_anuncio, PDO::PARAM_INT);
        $stmt_verificar_disponibilidade->bindValue(':data_entrada', $data_entrada->format('Y-m-d'));
        $stmt_verificar_disponibilidade->bindValue(':data_saida', $data_saida->format('Y-m-d'));
        $stmt_verificar_disponibilidade->execute();

        // Verifica se há algum resultado da consulta
        if ($stmt_verificar_disponibilidade->rowCount() > 0) {
            $reserva = $stmt_verificar_disponibilidade->fetch(PDO::FETCH_ASSOC);
            $data_entrada_reserva = new DateTime($reserva['AluDataEntrada']);
            $data_saida_reserva = new DateTime($reserva['AluDataSaida']);
            header("Location: AnuncioDetalhes.php?id=$id_anuncio&error=3&data_ocupada_inicio={$reserva['AluDataEntrada']}&data_ocupada_fim={$reserva['AluDataSaida']}");
            exit();
        } else {
            // Espaço está disponível, continua com o processo de aluguel
            try {
                $query_inserir_aluguel = "INSERT INTO alugar (EspId, OcuId, AluDataEntrada, AluDataSaida) VALUES (:id_anuncio, :id_ocupante, :data_entrada, :data_saida)";
                $stmt_inserir_aluguel = $conexao->prepare($query_inserir_aluguel);
                $stmt_inserir_aluguel->bindParam(':id_anuncio', $id_anuncio, PDO::PARAM_INT);
                $stmt_inserir_aluguel->bindParam(':id_ocupante', $id_ocupante, PDO::PARAM_INT);
                $stmt_inserir_aluguel->bindValue(':data_entrada', $data_entrada->format('Y-m-d'));
                $stmt_inserir_aluguel->bindValue(':data_saida', $data_saida->format('Y-m-d'));
                $stmt_inserir_aluguel->execute();

                if ($stmt_inserir_aluguel->rowCount() > 0) {
                    // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de sucesso
                    header("Location: AnuncioDetalhes.php?id=$id_anuncio&aluguel=sucesso");
                    exit();
                } else {
                    // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de erro
                    header("Location: AnuncioDetalhes.php?id=$id_anuncio&error=1");
                    exit();
                }
            } catch (PDOException $erro) {
                echo "Erro na inserção de dados:" . $erro->getMessage();
            }
        }
    } else {
        // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de erro de dados ausentes
        header("Location: AnuncioDetalhes.php?id=$id_anuncio&error=2");
        exit();
    }
}
?>
