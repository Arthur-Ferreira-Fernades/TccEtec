<?php
session_start();
require('../validadores/EstaLogado.php');
require('conectaBanco.php');

$id_anuncio = $_SESSION['id_anuncio'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SESSION['usuario_validado'] == true && $_SESSION['ProprietarioLocador'] == 'Proprietario' ) {
        $id_ocupante = isset($_SESSION['UsuarioId']) ? $_SESSION['UsuarioId'] : null;

        $data_entrada = DateTime::createFromFormat('d/m/Y', $_POST['dataEntrada']);
        $data_saida = DateTime::createFromFormat('d/m/Y', $_POST['dataSaida']);

        $query_verificar_disponibilidade = "SELECT * FROM alugar WHERE EspId = :id_anuncio AND ((AluDataEntrada <= :data_saida) AND (AluDataSaida >= :data_entrada))";
        $stmt_verificar_disponibilidade = $conexao->prepare($query_verificar_disponibilidade);
        $stmt_verificar_disponibilidade->bindParam(':id_anuncio', $id_anuncio, PDO::PARAM_INT);
        $stmt_verificar_disponibilidade->bindValue(':data_entrada', $data_entrada->format('Y-m-d'));
        $stmt_verificar_disponibilidade->bindValue(':data_saida', $data_saida->format('Y-m-d'));
        $stmt_verificar_disponibilidade->execute();
       
        header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=6");
        exit();
    } else {
        if (!empty($_POST['dataEntrada']) && !empty($_POST['dataSaida'])) {
            
            // Criando objetos DateTime diretamente
            if (isset($_POST['dataEntrada']) && isset($_POST['dataSaida'])) {
                // Tenta criar objetos DateTime a partir das strings fornecidas, assumindo que estão no formato 'd/m/Y'
                $data_entrada = DateTime::createFromFormat('d/m/Y', $_POST['dataEntrada']);
                $data_saida = DateTime::createFromFormat('d/m/Y', $_POST['dataSaida']);
                $horario_checkin = $_POST['CheckIn'];
                $num_ocupantes = $_POST['QuantidadePessoas'];
                $intervalo = $data_entrada->diff($data_saida);
                $numero_dias = $intervalo->days;
                $valorTotal = $_SESSION['preco'] * $numero_dias;
            
                // Verifica se as datas foram criadas com sucesso
                if ($data_entrada === false || $data_saida === false) {
                    // Se não foi possível criar os objetos DateTime, redirecione com mensagem de erro
                    header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=7");
                    exit();
                }
            } else {
                // Se as datas não foram fornecidas, redirecione com mensagem de erro
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=8");
                exit();
            }
            
            // Agora, vamos verificar se as datas foram criadas corretamente
            if ($data_entrada === false || $data_saida === false) {
                // Se não foi possível criar os objetos DateTime, redirecione com mensagem de erro
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=7");
                exit();
            }
            
            $query_verificar_capacidade = "SELECT EspCapacidade FROM espacodados WHERE Espid = :id_anuncio";
            $stmt_verificar_capacidade = $conexao->prepare($query_verificar_capacidade);
            $stmt_verificar_capacidade->bindParam(':id_anuncio', $id_anuncio, PDO::PARAM_INT);
            $stmt_verificar_capacidade->execute();
             
            if ($stmt_verificar_capacidade->rowCount() > 0) {
                $capacidade = $stmt_verificar_capacidade->fetch(PDO::FETCH_ASSOC)['EspCapacidade'];
                if ($num_ocupantes > $capacidade) {
                    header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=9"); // Número de ocupantes excede a capacidade
                    exit();
                }
            } else {
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=10"); // Erro ao obter capacidade do espaço
                exit();
            }

            $id_ocupante = isset($_SESSION['UsuarioId']) ? $_SESSION['UsuarioId'] : null;
            $id_anuncio = $_SESSION['id_anuncio'];
    
            if ($id_ocupante === null) {
                // Se o id do ocupante não estiver definido na sessão, redirecione com mensagem de erro
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=5");
                exit();
            }
    
            // Validar se a data de saída é posterior à data de entrada
            if ($data_saida <= $data_entrada) {
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=4"); // Redireciona com mensagem de erro
                exit();
            }

            if (empty($horario_checkin)) {
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=11"); // Redireciona com mensagem de erro
                exit();
            }

            if (empty($num_ocupantes)) {
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=12"); // Redireciona com mensagem de erro
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
                header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=3&data_ocupada_inicio={$reserva['AluDataEntrada']}&data_ocupada_fim={$reserva['AluDataSaida']}");
                exit();
            } else {
                // Espaço está disponível, continua com o processo de aluguel
                try {
                    $query_inserir_aluguel = "INSERT INTO alugar (EspId, OcuId, AluDataEntrada, AluDataSaida,  AluHorarioCheckIn, AluQuantidadePessoas, AluValor) VALUES (:id_anuncio, :id_ocupante, :data_entrada, :data_saida, :horario_checkin, :num_ocupantes, :valorTotal)";
                    $stmt_inserir_aluguel = $conexao->prepare($query_inserir_aluguel);
                    $stmt_inserir_aluguel->bindParam(':id_anuncio', $id_anuncio, PDO::PARAM_INT);
                    $stmt_inserir_aluguel->bindParam(':id_ocupante', $id_ocupante, PDO::PARAM_INT);
                    $stmt_inserir_aluguel->bindValue(':data_entrada', $data_entrada->format('Y-m-d'));
                    $stmt_inserir_aluguel->bindValue(':data_saida', $data_saida->format('Y-m-d'));
                    $stmt_inserir_aluguel->bindValue(':horario_checkin', $horario_checkin);
                    $stmt_inserir_aluguel->bindValue(':num_ocupantes', $num_ocupantes,PDO::PARAM_INT);
                    $stmt_inserir_aluguel->bindParam(':valorTotal', $valorTotal, PDO::PARAM_STR);
                    $stmt_inserir_aluguel->execute();
    
                    if ($stmt_inserir_aluguel->rowCount() > 0) {
                        // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de sucesso
                        header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&aluguel=sucesso");
                        exit();
                    } else {
                        // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de erro
                        header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=1");
                        exit();
                    }
                } catch (PDOException $erro) {
                    echo "Erro na inserção de dados:" . $erro->getMessage();
                }
            }
        } else {
            // Redireciona o usuário de volta à página de detalhes do anúncio com a mensagem de erro de dados ausentes
            header("Location: ../AnuncioDetalhes.php?id=$id_anuncio&error=2");
            exit();
        }
    }
    
}
?>