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
    <link rel="stylesheet" href="css/home.css">
    <title>Home</title>
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
    <div class="conteudo">
        <div class="barra-de-pesquisa">
            <div class="pesquisa">
                <img src="img/lupa.png" alt="lupa" width="40px" height="40px" class = "lupa-pesquisa">
                <input type="text" name="busca" placeholder = "Pesquisar">
                <button type="submit">Buscar</button>
            </div>
            
            <div class="filtro">
                <p>Filtros</p>

                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="img/filtro.png" alt="filtros" width="40px" height="40px">
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ...
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="postagens">

        <?php
            try {
                $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
                
                $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $erro) {
            
                echo "Erro na conexão:" . $erro->getMessage();
            }

            $query = "SELECT EspId, EspNome, EspCapacidade, EspDisponibilidade, EspImg, EspPreco FROM EspacoDados";
            $stmt = $conexao->query($query);
            $anuncios = $stmt->fetchAll();

        ?>
        <div class="row">
            <?php foreach ($anuncios as $anuncio): ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="img/<?php echo htmlspecialchars($anuncio['EspImg']); ?>" class="card-img-top" alt="Imagem de <?php echo htmlspecialchars($anuncio['EspNome']); ?>" height="200px">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($anuncio['EspNome']); ?></h5>
                            <p class="card-text">R$<?php echo number_format($anuncio['EspPreco'], 2, ',', '.'); ?> Diária</p>
                            <p class="card-text text-<?php echo $anuncio['EspDisponibilidade'] ? 'success' : 'danger'; ?>">
                                <?php echo $anuncio['EspDisponibilidade'] ? 'Disponível' : 'Indisponível'; ?>
                            </p>
                            <a href="#" class="btn btn-primary">Reserve já</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
                    <img src="img/WorkWave-removebg-preview (1).png" alt="" width="95px" height="95px">
                    <img src="img/WorkWave__2_-removebg-preview.png" alt="" width="100px" height="100px">
                </div>

                <div class="Social">
                    <div class="Media">
                    <a class="btn" href="#">
                        <img src="img/instagram.png" alt="" width="20" height="20">
                        <p>instagram</p>
                    </a>
                    <a class="btn" href="#">
                        <img src="img/linkedin.png" alt="" width="20" height="20">
                        <p>linkedin</p>
                    </a>
                    <a class="btn" href="#" >
                        <img src="img/github.png" alt="" width="20" height="20">
                        <p>github</p>
                    </a>
                    </div>
                </div>

                <div class="Social">
                    <div class="Media">
                    <a class="btn" href="#">
                        <img src="img/instagram.png" alt="" width="20" height="20">
                        <p>instagram</p>
                    </a>
                    <a class="btn" href="#">
                        <img src="img/linkedin.png" alt="" width="20" height="20">
                        <p>linkedin</p>
                    </a>
                    <a class="btn" href="#" >
                        <img src="img/github.png" alt="" width="20" height="20">
                        <p>github</p>
                    </a>
                    </div>
                </div>

                <div class="Social">
                    <div class="Media">
                    <a class="btn" href="#">
                        <img src="img/instagram.png" alt="" width="20" height="20">
                        <p>instagram</p>
                    </a>
                    <a class="btn" href="#">
                        <img src="img/linkedin.png" alt="" width="20" height="20">
                        <p>linkedin</p>
                    </a>
                    <a class="btn" href="#" >
                        <img src="img/github.png" alt="" width="20" height="20">
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