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
    <link rel="stylesheet" href="../css/AreaUsuario.css">
    <title>Area do Usuario</title>
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
                <li><a class="dropdown-item" href="AreaUsuario.php">Sua Área</a></li>
                <li><a class="dropdown-item" href="../Validadores/LogOff.php">Sair</a></li>
            </ul>
        </div>
    </header>
    <div class="conteudo">
        <div class="CardsLink">
            <a href="../DadosUsuario.php" class="link">
                <div class="cardLogin">
                    <img src="../img/login-de-usuario.png" alt="" width="150px">
                    <p>Aqui você pode alterar e revisar suas informações pessoais.</p>
                </div>
            </a>
        </div>
        <div class="CardsLink">
            <a href="AlugueisFeitos.php" class="link">
                <div class="cardLogin">
                    <img src="../img/aluguel-de-casa.png" alt="" width="150px">
                    <p>Aqui você pode conferir seus aluguéis feitos.</p>
                </div>
            </a>
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
                        <a class="btn" href="#">
                            <img src="../img/instagram.png" alt="" width="20" height="20">
                            <p>instagram</p>
                        </a>
                        <a class="btn" href="#">
                            <img src="../img/linkedin.png" alt="" width="20" height="20">
                            <p>linkedin</p>
                        </a>
                        <a class="btn" href="https://github.com/Guinds">
                            <img src="../img/github.png" alt="" width="20" height="20">
                            <p>github</p>
                        </a>
                    </div>
                </div>
                <div class="Social">
                    <div class="Media">
                        <a class="btn" href="#">
                            <img src="../img/instagram.png" alt="" width="20" height="20">
                            <p>instagram</p>
                        </a>
                        <a class="btn" href="#">
                            <img src="../img/linkedin.png" alt="" width="20" height="20">
                            <p>linkedin</p>
                        </a>
                        <a class="btn" href="#">
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