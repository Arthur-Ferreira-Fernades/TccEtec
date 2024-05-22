<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Anunciado</title>
</head>
<body>
    <div class="conteudo">
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
                            $ProId = $_SESSION['ProId'];
                            $dataHoraAtual = date('Y-m-d H:i:s');
                
                            // Insere os dados no banco de dados
                            $sql = "INSERT INTO EspacoDados (EspNome, EspEndereco, EspDescricao, EspImg, EspPreco, ProId, EspDataCadastro, EspCapacidade) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                            $stmt = $conexao->prepare($sql);
                            $stmt->execute([$EspNome, $EspEndereco, $EspDescricao, $EspImg, $EspPreco, $ProId, $dataHoraAtual,$EspCapacidade ]);
                
                            echo "Anuncio realizado enviado com sucesso.";
                        } else {
                            echo "Desculpe, houve um erro ao realizar seu Anuncio.";
                        }
                    } else {
                        echo "O arquivo não é uma imagem.";
                    }
                }
        ?>
        <a href="index.php">
            <button>Voltar</button>
        </a>
    </div>
</body>
</html>