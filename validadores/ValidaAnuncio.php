<?php
session_start();
require('../validadores/EstaLogado.php');
require('conectaBanco.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="ValidaAnuncio.css">
    <title>Anunciado</title>
</head>

<body>
    <div class="conteudo">
        <div class="container">
            <?php

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Diretório onde as imagens serão armazenadas
                $targetDir = "../img/";

                // Caminho do arquivo
                $targetFile = $targetDir . basename($_FILES["Imagem"]["name"]);

                // Verifica se o arquivo é uma imagem
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["Imagem"]["tmp_name"]);

                if ($check !== false) {
                    if (move_uploaded_file($_FILES["Imagem"]["tmp_name"], $targetFile)) {
                        // Dados do formulário
                        $EspNome = $_POST['EspacoNome'];
                        $EspEndereco = $_POST['EspacoEndereco'];
                        $EspDescricao = $_POST['EspacoDescricao'];
                        $EspPreco = $_POST['EspacoPreco'];
                        $EspCapacidade= $_POST['EspacoCapacidade'];
                        $EspImg = basename($_FILES["Imagem"]["name"]);
                        $ProId = $_SESSION['UsuarioId'];
                        $dataHoraAtual = date('Y-m-d H:i:s');
                        $DisponibilidadePadrao = 0;

                        if ($erro = error_get_last()) {
                            // Obtém a mensagem de erro
                            $MensagemErro = $erro['message'];

                            // Verifica se a mensagem de erro contém o texto desejado
                            if (strpos($MensagemErro, 'Undefined array key') !== false || strpos($MensagemErro, 'Integrity constraint violation') !== false) {
                                // Redireciona o usuário para a página de login
                                header("Location: ../login.php");
                                exit(); // Encerra o script para garantir que o redirecionamento funcione corretamente
                            }
                        } else {
                            $sql = "INSERT INTO EspacoDados (EspNome, EspEndereco, EspDescricao, EspImg, EspPreco, ProId, EspDataCadastro, EspCapacidade,EspDisponibilidade) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?,?)";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute([$EspNome, $EspEndereco, $EspDescricao, $EspImg, $EspPreco, $ProId, $dataHoraAtual,$EspCapacidade, $DisponibilidadePadrao]);

                            // Após inserir o anúncio e recuperar o EspacoId
                            $EspacoId = $conexao->lastInsertId();

                            // Insere um registro na tabela servamenidades com todos os serviços como falsos
                            $sql = "INSERT INTO servamenidades (SerWifi, Serarcondicionado, Serbebedouro, Sercomputadores, Sercozinha, EspId) VALUES (0, 0, 0, 0, 0,$EspacoId)";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute();

                            // Recupera o SerId gerado
                            $SerId = $conexao->lastInsertId();

                            // Associa o SerId com o EspacoId na tabela espacodados
                            $sql = "UPDATE espacodados SET SerId = ? WHERE EspId = ?";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute([$SerId, $EspacoId]);

                            echo "<div class='alert alert-success' role='alert'>Anuncio realizado enviado com sucesso.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Desculpe, houve um erro ao realizar seu Anuncio.</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning' role='alert'>O arquivo não é uma imagem.</div>";
                }
            }
            ?>
            <br>
            <a href="../index.php" class="btn btn-success">Voltar</a>
        </div>
    </div>
</body>

</html>
