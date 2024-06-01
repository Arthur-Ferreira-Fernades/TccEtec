<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <title>Anuncio Atualizado</title>
</head>
<body>
<header>
        <div class="logo">
            <img src="img/WorkWave-removebg-preview (1).png" alt="" width="95px" height="95px">
            <img src="img/WorkWave__2_-removebg-preview.png" alt="" width="100px" height="100px">
        </div>
            <a href="index.php" class="underline">HOME</a>
            <a href="SobreNos.php" class="underline">SOBRE NÓS</a>
            <a href="AnuncieJa.php" class="underline">ANUNCIE JÁ</a>
            <?php
                if (!isset($_SESSION['usuario_validado']) || $_SESSION['usuario_validado'] == false) {
            ?>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/user-logo.png" alt="">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="login.php">Fazer Login</a></li>
                        </ul>
                    </div>
            <?php
                } else {
            ?>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/user-logo.png" alt="">
                        </a>
                        <?php
                            if($_SESSION['ProprietarioLocador'] == 'Proprietario') {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="AreaProprietario.php">Sua Area</a></li>
                            <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
                        </ul>
                        <?php
                            } else {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="AreaUsuario.php">Sua Area</a></li>
                            <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
                        </ul>
                        <?php
                            };
                        ?>
                    </div>
            <?php
                };
            ?>
    </header>

    <div class="container mt-5">
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o campo de ID do anúncio está presente no formulário
    if (isset($_POST['anuncio'])) {
        // Obtenha o ID do anúncio do formulário
        $anuncio_id = $_POST['anuncio'];

        // Variável para armazenar as mensagens de atualização
        $mensagem = "";

        // Conexão com o banco de dados
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Atualize os campos do anúncio apenas se eles estiverem presentes no formulário
            if (isset($_POST['novo_nome']) && !empty($_POST['novo_nome'])){
                $novo_nome = $_POST['novo_nome'];
                $query = "UPDATE EspacoDados SET EspNome = :novo_nome WHERE EspId = :anuncio_id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':novo_nome', $novo_nome);
                $stmt->bindParam(':anuncio_id', $anuncio_id);
                $stmt->execute();
                $mensagem .= "<div class='alert alert-success' role='alert'>Nome atualizado com sucesso.</div>";
            }

            if (isset($_POST['novo_preco']) && !empty($_POST['novo_preco'])) {
                $novo_preco = $_POST['novo_preco'];
                $query = "UPDATE EspacoDados SET EspPreco = :novo_preco WHERE EspId = :anuncio_id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':novo_preco', $novo_preco);
                $stmt->bindParam(':anuncio_id', $anuncio_id);
                $stmt->execute();
                $mensagem .= "<div class='alert alert-success' role='alert'>Preço atualizado com sucesso.</div>";
            }

            if (isset($_POST['nova_capacidade']) && !empty($_POST['nova_capacidade'])) {
                $nova_capacidade = $_POST['nova_capacidade'];
                $query = "UPDATE EspacoDados SET EspCapacidade = :nova_capacidade WHERE EspId = :anuncio_id";
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':nova_capacidade', $nova_capacidade);
                $stmt->bindParam(':anuncio_id', $anuncio_id);
                $stmt->execute();
                $mensagem .= "<div class='alert alert-success' role='alert'>Capacidade atualizada com sucesso.</div>";
            }

            if (isset($_POST['disponibilidade']) && ($_POST['disponibilidade'] == '0' || $_POST['disponibilidade'] == '1')) {
                $nova_disponibilidade = $_POST['disponibilidade'];
                $query_check = "SELECT * FROM EspacoDados WHERE EspId = :anuncio_id";
                $stmt_check = $conexao->prepare($query_check);
                $stmt_check->bindParam(':anuncio_id', $anuncio_id, PDO::PARAM_INT);
                $stmt_check->execute();
            
                if ($stmt_check->rowCount() > 0) {
                    $query = "UPDATE EspacoDados SET EspDisponibilidade = :nova_disponibilidade WHERE EspId = :anuncio_id";
                } else {
                    $query = "INSERT INTO EspacoDados (EspId, EspDisponibilidade) VALUES (:anuncio_id, :nova_disponibilidade) WHERE EspId = :anuncio_id";
                }
            
                $stmt = $conexao->prepare($query);
                $stmt->bindParam(':nova_disponibilidade', $nova_disponibilidade, PDO::PARAM_INT);
                $stmt->bindParam(':anuncio_id', $anuncio_id, PDO::PARAM_INT);
                $stmt->execute();
                $mensagem = "<div class='alert alert-success' role='alert'>Disponibilidade atualizada com sucesso.</div>";
            }

            // Atualize as colunas correspondentes na tabela Servamenidades
            $queryUpdateFalse = "UPDATE Servamenidades SET `SerWifi` = false, `SerArcondicionado` = false, `SerBebedouro` = false, `SerComputadores` = false, `SerCozinha` = false WHERE EspId = :anuncio_id";
            $stmtUpdateFalse = $conexao->prepare($queryUpdateFalse);
            $stmtUpdateFalse->bindParam(':anuncio_id', $anuncio_id);
            $stmtUpdateFalse->execute();

            if (isset($_POST['recursos']) && is_array($_POST['recursos']) && !empty($_POST['recursos'])) {
                foreach ($_POST['recursos'] as $recurso) {
                    // Verifica se o checkbox correspondente está marcado
                    $valor_servico = true;
            
                    // Atualizar a coluna correspondente na tabela Servamenidades
                    $queryUpdate = "UPDATE Servamenidades SET `$recurso` = :valor_servico WHERE EspId = :anuncio_id";
                    $stmtUpdate = $conexao->prepare($queryUpdate);
                    $stmtUpdate->bindParam(':valor_servico', $valor_servico, PDO::PARAM_BOOL); // Atribuir um valor booleano
                    $stmtUpdate->bindParam(':anuncio_id', $anuncio_id);
                    $stmtUpdate->execute();
                    $mensagem .= "<div class='alert alert-success' role='alert'>$recurso atualizado com sucesso.</div>";
                }
            }
            
        }  catch (PDOException $erro) {
            $mensagem = "<div class='alert alert-danger' role='alert'>Erro na conexão: " . $erro->getMessage() . "</div>";
        }
    } else {
        // Se o campo de ID do anúncio estiver ausente, exiba uma mensagem de erro ou redirecione para uma página de erro
        $mensagem = "<div class='alert alert-danger' role='alert'>Erro: ID do anúncio ausente.</div>";
    }
} else {
    // Se a solicitação não for do tipo POST, exiba uma mensagem de erro ou redirecione para uma página de erro
    $mensagem = "<div class='alert alert-danger' role='alert'>Erro: A solicitação deve ser do tipo POST.</div>";
}

// Exibir a mensagem de atualização
echo $mensagem;
?>
<a href="SeusAnuncios.php" class="btn btn-primary">Voltar para seus Anúncios</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

