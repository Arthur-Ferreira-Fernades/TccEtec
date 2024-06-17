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
                if ($_SESSION['ProprietarioLocador'] == 'Proprietario') {
                ?>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="proprietario/AreaProprietario.php">Sua Área</a></li>
                        <li><a class="dropdown-item" href="Validadores/LogOff.php">Sair</a></li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="usuario/AreaUsuario.php">Sua Área</a></li>
                        <li><a class="dropdown-item" href="Validadores/LogOff.php">Sair</a></li>
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
                <img src="img/lupa.png" alt="lupa" width="25px" height="25px" class="lupa-pesquisa">
                <form method="GET" action="">
                    <input type="text" name="filtroName" placeholder="Pesquisar">
                    <button type="submit">Buscar</button>
                </form>
            </div>
            <div class="filtro">
                <p>Filtros</p>
                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="img/filtro.png" alt="filtros" width="40px" height="40px">
                </button>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form id="filtroForm" method="GET" action="">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Filtros</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="filtroCapacidade" class="form-label">Capacidade</label>
                                        <input type="number" class="form-control" id="filtroCapacidade" name="filtroCapacidade" min="1" value="1">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filtroPrecoMax" class="form-label">Preço Máximo (Diária)</label>
                                        <input type="number" class="form-control" id="filtroPrecoMax" name="filtroPrecoMax">
                                    </div>
                                    <div class="mb-3">
                                        <label for="filtroDisponibilidade" class="form-label d-flex flex-column align-items-center">
                                            <label>Mostrar todos os anúncios</label>
                                            <div class="form-check form-switch mt-1">
                                                <input class="form-check-input" type="checkbox" value="all" id="filtroDisponibilidade" name="filtroDisponibilidade">
                                            </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="servicos" class="form-label">Serviços</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="wifi" name="servicos[]" value="SerWifi">
                                            <label class="form-check-label" for="wifi">Wi-Fi</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="arcondicionado" name="servicos[]" value="Serarcondicionado">
                                            <label class="form-check-label" for="arcondicionado">Ar Condicionado</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="bebedouro" name="servicos[]" value="Serbebedouro">
                                            <label class="form-check-label" for="bebedouro">Bebedouro</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="computadores" name="servicos[]" value="Sercomputadores">
                                            <label class="form-check-label" for="computadores">Computadores</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="cozinha" name="servicos[]" value="Sercozinha">
                                            <label class="form-check-label" for="cozinha">Cozinha</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
                                    <button type="reset" class="btn btn-danger" onclick="resetFiltros()">Redefinir Filtros</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="postagens row">
            <?php
            require('validadores/conectaBanco.php');

            $filtroName = isset($_GET['filtroName']) ? $_GET['filtroName'] : '';
            $filtroCapacidade = isset($_GET['filtroCapacidade']) ? $_GET['filtroCapacidade'] : '';
            $filtroDisponibilidade = isset($_GET['filtroDisponibilidade']) ? $_GET['filtroDisponibilidade'] : '';
            $filtroPrecoMax = isset($_GET['filtroPrecoMax']) ? $_GET['filtroPrecoMax'] : '';

            $query = "SELECT e.EspId, e.EspNome, e.EspCapacidade, e.EspDisponibilidade, e.EspImg, e.EspPreco 
            FROM EspacoDados e 
            INNER JOIN servamenidades s ON e.EspId = s.EspId 
            WHERE 1=1 AND e.EspCongelado = 0";

            if ($filtroName != '') {
                $query .= " AND e.EspNome LIKE :filtroName";
            }
            if ($filtroCapacidade != '') {
                $query .= " AND e.EspCapacidade >= :filtroCapacidade";
            }
            if (!empty($_GET['servicos'])) {
                $servicos = $_GET['servicos'];
                foreach ($servicos as $servico) {
                    $query .= " AND s." . $servico . " = 1";
                }
            }
            // Modificando a consulta para exibir apenas os anúncios disponíveis ou todos, dependendo da seleção do usuário
            if ($filtroDisponibilidade == 'all') {
                // Se 'Mostrar todos os anúncios' estiver selecionado, não adicionar nenhuma condição de disponibilidade
            } else {
                // Se 'Mostrar todos os anúncios' não estiver selecionado, adicionar condição para mostrar apenas anúncios disponíveis
                $query .= " AND e.EspDisponibilidade = 1"; // Apenas anúncios disponíveis
            }

            if ($filtroPrecoMax != '') {
                $query .= " AND e.EspPreco <= :filtroPrecoMax";
            }

            $stmt = $conexao->prepare($query);

            if ($filtroName != '') {
                $stmt->bindValue(':filtroName', '%' . $filtroName . '%');
            }
            if ($filtroCapacidade != '') {
                $stmt->bindValue(':filtroCapacidade', $filtroCapacidade, PDO::PARAM_INT);
            }
            if ($filtroPrecoMax != '') {
                $stmt->bindValue(':filtroPrecoMax', $filtroPrecoMax, PDO::PARAM_INT);
            }

            $stmt->execute();
            $anuncios = $stmt->fetchAll();

            $numeroDeAnuncios = count($anuncios);
            $classePostagens = $numeroDeAnuncios < 4 ? "postagens flex-wrap" : "postagens";
            ?>

            <div class="<?php echo $classePostagens; ?>">
                <?php
                if ($numeroDeAnuncios == 0) {
                    echo '<div style="height: 34vh;"';
                    echo '<h2>Nenhum espaço com essas especificações encontrado</h2>';
                    echo '</div>';
                }
                $contador = 0; // Inicializa o contador
                foreach ($anuncios as $anuncio) :
                    if ($contador % 4 == 0) { // Adiciona uma nova linha a cada 4 anúncios
                        echo '<div class="row g-3 mt-2">';
                    }
                ?>
                    <div class="col">
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
                                <button type="submit" class="btn btn-primary me-5">
                                    <a href="AnuncioDetalhes.php?id=<?php echo $anuncio['EspId']; ?>" class="text-white">Alugar</a>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                    $contador++; // Incrementa o contador
                    if ($contador % 4 == 0 || $contador == count($anuncios)) { // Fecha a linha a cada 4 anúncios ou no último anúncio
                        echo '</div>';
                    }
                endforeach;
                ?>
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
                        <p>Arthur Ferreira</p>
                        <a class="btn" href="https://instagram.com/kingarthur_55/">
                            <img src="img/instagram.png" alt="" width="20" height="20">
                            <p>instagram</p>
                        </a>
                        <a class="btn" href="https://www.linkedin.com/in/arthur-ferreira-02921a249/">
                            <img src="img/linkedin.png" alt="" width="20" height="20">
                            <p>linkedin</p>
                        </a>
                        <a class="btn" href="https://github.com/Arthur-Ferreira-Fernades">
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
                        <a class="btn" href="#">
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
                        <a class="btn" href="#">
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
    <script>
        function resetFiltros() {
            window.location.href = window.location.pathname;
        }
    </script>
</body>

</html>