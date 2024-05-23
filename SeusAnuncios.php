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
    <link rel="stylesheet" href="css/SeusAnuncios.css">
    <title>Seus Anuncios</title>
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
    <div class="conteudo conteudo-principal">
        <div class="postagem">
            <?php
                try {
                    $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
                    
                    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                } catch (PDOException $erro) {
                
                    echo "Erro na conexão:" . $erro->getMessage();
                }

                if (isset($_SESSION['ProId'])) {
                    // Prepara a consulta SQL com um parâmetro de substituição
                    $query = "SELECT EspId, EspNome, EspCapacidade, EspDisponibilidade, EspImg, EspPreco FROM EspacoDados WHERE ProId = :ProId";
                    $stmt = $conexao->prepare($query);
                    // Vincula o valor do ProId da sessão ao parâmetro da consulta
                    $stmt->bindValue(':ProId', $_SESSION['ProId']);
                    // Executa a consulta
                    $stmt->execute();
                    // Obtém os resultados
                    $anuncios = $stmt->fetchAll();
                } else {
                    // Caso o ProId não esteja definido na sessão, defina $anuncios como vazio ou trate de outra forma
                    $anuncios = [];
                }

            ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                <?php foreach ($anuncios as $anuncio): ?>
                    <div class="col mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="img/<?php echo htmlspecialchars($anuncio['EspImg']); ?>" class="card-img-top" alt="Imagem de <?php echo htmlspecialchars($anuncio['EspNome']); ?>" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($anuncio['EspNome']); ?></h5>
                                <p class="card-text">R$<?php echo number_format($anuncio['EspPreco'], 2, ',', '.'); ?> Diária</p>
                                <p class="card-text <?php echo $anuncio['EspDisponibilidade'] == 0 ? 'text-danger' : 'text-success'; ?>">
                                    <?php echo $anuncio['EspDisponibilidade'] == 0 ? 'Indisponível' : 'Disponível'; ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary me-5">Atualizar Anúncio</button>
                                    <form action="ExcluirAnuncio.php" method="POST">
                                        <input type="hidden" name="anuncio_id" value="<?php echo $anuncio['EspId']; ?>">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja excluir este anúncio?')">Excluir Anúncio</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>