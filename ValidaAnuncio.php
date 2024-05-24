<?php
    session_start();
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
                try {
                        $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
                        
                        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $erro) {
                        echo "Erro na conexão:" . $erro->getMessage();
                    }

                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        // Diretório onde as imagens serão armazenadas
                        $targetDir = "img/";
                        
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

                                if ($erro = error_get_last()) {
                                    // Obtém a mensagem de erro
                                    $MensagemErro = $erro['message'];
                                    
                                    // Verifica se a mensagem de erro contém o texto desejado
                                    if (strpos($MensagemErro, 'Undefined array key') !== false || strpos($MensagemErro, 'Integrity constraint violation') !== false) {
                                        // Redireciona o usuário para a página de login
                                        header("Location: login.php");
                                        exit(); // Encerra o script para garantir que o redirecionamento funcione corretamente
                                    }
                                } else {
                                    $sql = "INSERT INTO EspacoDados (EspNome, EspEndereco, EspDescricao, EspImg, EspPreco, ProId, EspDataCadastro, EspCapacidade) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                                    $stmt = $conexao->prepare($sql);
                                    $stmt->execute([$EspNome, $EspEndereco, $EspDescricao, $EspImg, $EspPreco, $ProId, $dataHoraAtual,$EspCapacidade ]);
                        
                                    $EspacoId = $conexao->lastInsertId();

                                    // Insere os valores dos checkboxes na tabela servamenidades
                                    if(isset($_POST['recursos']) && is_array($_POST['recursos'])) {
                                        foreach($_POST['recursos'] as $recurso) {
                                            // Insere o recurso na tabela servamenidades e recupera o ID gerado
                                            $sql = "INSERT INTO servamenidades ($recurso) VALUES (1)"; // ou 0, dependendo se está marcado ou não
                                            $stmt = $conexao->prepare($sql);
                                            $stmt->execute();
                                            $SerId = $conexao->lastInsertId();
                                            
                                            // Associa o SerId com o EspacoId na tabela espacodados
                                            $sql = "UPDATE espacodados SET SerId = ? WHERE EspacoId = ?";
                                            $stmt = $conexao->prepare($sql);
                                            $stmt->execute([$SerId, $EspacoId]);
                                        }
                                    }
                                    
                                    echo "Anuncio realizado enviado com sucesso.";
                                }
                                
                            } else {
                                echo "Desculpe, houve um erro ao realizar seu Anuncio.";
                            }
                        } else {
                            echo "O arquivo não é uma imagem.";
                        }
                    }
            ?>
            <br>
            <a href="index.php">
                <button type="button" class="btn btn-success">Voltar</button>
            </a>
        </div>
    </div>
</body>
</html>