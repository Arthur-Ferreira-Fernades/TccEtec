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
    <link rel="stylesheet" href="css/SobreNos.css">
    <title>Sobre Nós</title>
    
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
        <h1>Sobre Nós   </h1>
        <div class="sessao">
            <p>O principal propósito do WorkWave é criar uma plataforma intuitiva que permita uma busca por espaços de coworking, facilitando a interação entre empresas que oferecem esses espaços e potenciais locatários.</p>
            <img src="img/SobreN1.png" alt="Mapa de alguns dos nossos espaços" width="250px" height="250px" class = "Imagem">
        </div>
        <div class="sessao">
            
            <img src="img/SobreN2.jpg" alt="Imagem 2" width="250px" height="250px" class = "Imagem">
            <p>
                Priorizamos a facilidade de acesso para os clientes, possibilitando a eficiência na identificação do espaço
                ideal alinhado com as necessidades individuais de cada usuário, levando em conta sua especificidade e orçamento.
            </p>
        </div>
        <div class="sessao">
            
            <p>
                Não consideramos apenas o custo mas também a localização, estrutura disponível
                e outros critérios relevantes para ambas as partes visando uma experiência otimizada.
            </p>
            <img src="img/SobreN3.jpg" alt="Imagem 3" width="250px" height="250px" class = "Imagem">
        </div>
        <div class="sessao2">
            <p>
                Junto de nossa equipe faremos o que for preciso para atender suas expectativas. Equipe:
            </p>
        
            <div class="imagem">    
                <div class="Gui">
                    <img src="img/SobreN4.jpg" alt="Imagem 4" width="200px" height="200px" class = "imagem-redonda">
                    <p>Guilherme</p>
                </div>
                <div class="Art">
                    <img src="img/SobreNosArthur.jpeg" alt="" width="200px" height="200px" class = "imagem-redonda">
                    <p>Arthur</p>
                </div>
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
