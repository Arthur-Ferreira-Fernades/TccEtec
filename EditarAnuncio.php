<?php
    session_start();

    if(isset($_SESSION['ProId'])) {
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Prepara a consulta SQL para selecionar apenas os nomes dos anúncios do proprietário atual
            $query = "SELECT EspId, EspNome FROM EspacoDados WHERE ProId = :ProId";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':ProId', $_SESSION['ProId']);
            $stmt->execute();
            $anuncios = $stmt->fetchAll();
        } catch (PDOException $erro) {
            echo "Erro na conexão:" . $erro->getMessage();
        }
    } else {
        // Redireciona para a página de login ou faça algo semelhante se o ID do proprietário não estiver definido na sessão
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <title>Editar Anuncio</title>
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
        <h2 class="mb-4">Atualizar Anúncio</h2>
        <form action="ValidaAtualizacao.php" method="POST">
            <div class="mb-3">
                <label for="anuncio" class="form-label">Selecione o Anúncio:</label>
                <select class="form-select" name="anuncio" id="anuncio">
                    <?php foreach ($anuncios as $anuncio): ?>
                        <option value="<?php echo $anuncio['EspId']; ?>"><?php echo $anuncio['EspNome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="novo_nome" class="form-label">Novo Nome:</label>
                <input type="text" class="form-control" id="novo_nome" name="novo_nome">
            </div>
            <div class="mb-3">
            <div class="mb-3">
                <label for="novo_preco" class="form-label">Novo Preço:</label>
                <input type="number" class="form-control" id="novo_preco" name="novo_preco">
            </div>
            <div class="mb-3">
                <label for="nova_capacidade" class="form-label">Nova Capacidade:</label>
                <input type="number" class="form-control" id="nova_capacidade" name="nova_capacidade">
            </div>
                <label class="form-label">Disponibilidade:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="disponibilidade" id="disponivel" value="1">
                        <label class="form-check-label" for="disponivel">Disponível</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="disponibilidade" id="indisponivel" value="0">
                        <label class="form-check-label" for="indisponivel">Indisponível</label>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Anúncio</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>