<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <a href="#" class="underline">ANUNCIE JÁ</a>
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
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Sua Area</a></li>
                            <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
                        </ul>
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

            <div class="card" style="width: 18rem;">
                <img src="img/Espaco1.webp" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua limoreiro 150</h5>
                    <p class="card-text">R$100.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco2.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua macieira 300</h5>
                    <p class="card-text">R$50.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco3.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua laranjeira 600</h5>
                    <p class="card-text">R$296.00 Diária</p>
                    <p class="card-text text-danger">Não disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco4.webp" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua mangueira 1200</h5>
                    <p class="card-text">R$157.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>

            <div class="card" style="width: 18rem;">
                <img src="img/Espaco5.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua limoreiro 150</h5>
                    <p class="card-text">R$100.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco6.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua macieira 300</h5>
                    <p class="card-text">R$50.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco7.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua laranjeira 600</h5>
                    <p class="card-text">R$296.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="img/Espaco8.jpg" class="card-img-top" alt="..." height="200px">
                <div class="card-body">
                    <h5 class="card-title">Rua mangueira 1200</h5>
                    <p class="card-text">R$157.00 Diária</p>
                    <p class="card-text text-success">Disponivel</p>
                    <a href="#" class="btn btn-primary">Reserve já</a>
                </div>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>