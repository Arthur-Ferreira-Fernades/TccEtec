<?php
    session_start();
    require('../validadores/EstaLogado.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Style.css">
    <link rel="stylesheet" href="../css/SeusAnuncios.css">
    <title>Seus Anuncios</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/WorkWave-removebg-preview (1).png" alt="" width="95px" height="95px">
            <img src="../img/WorkWave__2_-removebg-preview.png" alt="" width="100px" height="100px">
        </div>
        <a href="../index.php" class="underline">HOME</a>
        <a href="../SobreNos.php" class="underline">SOBRE NÓS</a>
        <a href="../AnuncieJa.php" class="underline">ANUNCIE JÁ</a>
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../img/user-logo.png" alt="">
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="AreaProprietario.php">Sua Área</a></li>
                <li><a class="dropdown-item" href="../Validadores/LogOff.php">Sair</a></li>
            </ul>
        </div>
    </header>
    <div class="conteudo">
        <h1>Seus Anuncios</h1>
        <div class="postagens row">
            <?php
                require('../validadores/conectaBanco.php');

                if (isset($_SESSION['UsuarioId'])) {
                    $query = "SELECT EspId, EspNome, EspCapacidade, EspDisponibilidade, EspImg, EspPreco, EspCongelado FROM EspacoDados WHERE ProId = :UsuarioId";
                    $stmt = $conexao->prepare($query);
                    $stmt->bindValue(':UsuarioId', $_SESSION['UsuarioId']);
                    $stmt->execute();
                    $anuncios = $stmt->fetchAll();
                } else {
                    $anuncios = [];
                }

                if ($anuncios == []) {
                    echo '<h2>Você ainda não tem anuncios</h2>';
                }

                $numeroDeAnuncios = count($anuncios);
                $classePostagens = $numeroDeAnuncios < 4 ? "postagens flex-wrap" : "postagens";
            ?>
            <div class="<?php echo $classePostagens; ?>">
            <?php 
                    $contador = 0; // Inicializa o contador
                    foreach ($anuncios as $anuncio) :
                        if ($contador % 4 == 0) { // Adiciona uma nova linha a cada 4 anúncios
                            echo '<div class="row g-3 mt-2 mb-4">';
                        }
                    ?>
                
                    <div class="col">
                        <div class="card ms-1" style="width: 18rem;">
                            <img src="../img/<?php echo htmlspecialchars($anuncio['EspImg']); ?>" class="card-img-top" alt="Imagem de <?php echo htmlspecialchars($anuncio['EspNome']); ?>" height="200px">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($anuncio['EspNome']); ?></h5>
                                <p class="card-text">R$<?php echo number_format($anuncio['EspPreco'], 2, ',', '.'); ?> Diária</p>
                                <p class="card-text <?php echo $anuncio['EspDisponibilidade'] == 0 ? 'text-danger' : 'text-success'; ?>">
                                    <?php echo $anuncio['EspDisponibilidade'] == 0 ? 'Indisponível' : 'Disponível'; ?>
                                </p>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                        <form action="EditarAnuncio.php" method = "POST" class = "me-2">
                                            <input type="hidden" name="anuncio_id" value="<?php echo $anuncio['EspId']; ?>">
                                            <button type="submit" class = "btn btn-primary">Atualizar Anuncio</button>
                                        </form>    
                                    <?php if ($anuncio['EspCongelado'] == 1): ?>
                                        <form action="../validadores/DescongelarAnuncio.php" method="POST">
                                            <input type="hidden" name="anuncio_id" value="<?php echo $anuncio['EspId']; ?>">
                                            <button type="submit" class="btn btn-success">Descongelar Anúncio</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="../validadores/CongelarAnuncio.php" method="POST">
                                            <input type="hidden" name="anuncio_id" value="<?php echo $anuncio['EspId']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja congelar este anúncio?')">Congelar Anúncio</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php 
                    $contador++; // Incrementa o contador
                    if ($contador % 4 == 0 || $contador == count($anuncios)) { // Fecha a linha a cada 4 anúncios ou no último anúncio
                        echo '</div>';
                    }
                    endforeach;?>
            </div>
        </div>
    </div>
    <footer class="rodape" id="contato">
        <div class="contato">
            <p>Contatos</p>
        </div>
        <div class="Borda">
            <div class="rodape-div">
                <div class="logo-2">
                    <img src="../img/WorkWave-removebg-preview (1).png" alt="" width="95px" height="95px">
                    <img src="../img/WorkWave__2_-removebg-preview.png" alt="" width="100px" height="100px">
                </div>
                <div class="Social">
                    <div class="Media">
                        <p>Arthur Ferreira</p>
                        <a class="btn" href="https://instagram.com/kingarthur_55/">
                            <img src="../img/instagram.png" alt="" width="20" height="20">
                            <p>instagram</p>
                        </a>
                        <a class="btn" href="https://www.linkedin.com/in/arthur-ferreira-02921a249/">
                            <img src="../img/linkedin.png" alt="" width="20" height="20">
                            <p>linkedin</p>
                        </a>
                        <a class="btn" href="https://github.com/Arthur-Ferreira-Fernades">
                            <img src="../img/github.png" alt="" width="20" height="20">
                            <p>github</p>
                        </a>
                    </div>
                </div>
                <div class="Social">
                    <div class="Media">
                        <p>Guilherme Nunes</p>
                        <a class="btn" href="https://instagram.com/guinds17/">
                            <img src="../img/instagram.png" alt="" width="20" height="20">
                            <p>instagram</p>
                        </a>
                        <a class="btn" href="https://www.linkedin.com/in/guilherme-nunes-b425672bb/">
                            <img src="../img/linkedin.png" alt="" width="20" height="20">
                            <p>linkedin</p>
                        </a>
                        <a class="btn" href="https://github.com/Guinds">
                            <img src="../img/github.png" alt="" width="20" height="20">
                            <p>github</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="data">
            <p>Criado em 09/05/2024</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
