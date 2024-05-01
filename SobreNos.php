<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/SobreNos.css">
    <title>Home</title>

    <style>
        
        .conteudo {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .conteudo .col-md-6 {
            width: 100%; 
            max-width: 500px;
            height: 400px; 
            overflow: hidden; 
            border: 1px solid #ccc; 
            padding: 20px; 
            margin-bottom: 20px; 
        }

        .conteudo .col-md-6 .d-flex {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .conteudo .col-md-6 img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px; 
            border-radius: 10px;
            overflow: hidden; 
        }

        @media (min-width: 992px) {
            .conteudo .col-md-6 {
                width: 50%; 
            }
        }
    </style>

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
                    <li><a class="dropdown-item" href="#">Sua Área</a></li>
                    <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
                </ul>
            </div>
            <?php
        };
        ?>

    </header>
    <div class="conteudo">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex">
                    <img src="img/SobreN1.png" alt="Mapa de alguns dos nossos espaços" width="200px" height="200px">
                    <p>
                        O principal propósito do WorkWave é criar uma plataforma intuitiva que permita uma busca por
                        espaços de coworking facilitando a interação entre empresas que oferecem esses espaços e potenciais locatários.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <img src="img/SobreN2.jpg" alt="Imagem 2" width="200px" height="200px">
                    <p>
                        Priorizamos a facilidade de acesso para os clientes possibilitando a eficiência na identificação do espaço
                        ideal alinhados com as necessidades individuais de cada usuário levando em conta sua especificidade e orçamento.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex">
                    <img src="img/SobreN3.jpg" alt="Imagem 3" width="200px" height="200px">
                    <p>
                        Consideramos não apenas o custo mas também a localização, estrutura disponível
                        e outros critérios relevantes para ambas as partes visando uma experiência otimizada.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <img src="img/SobreN4.jpg" alt="Imagem 4" width="200px" height="200px">
                    <p>
                        Junto de nossa equipe faremos o que for preciso para atender suas expectativas. Equipe:
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
