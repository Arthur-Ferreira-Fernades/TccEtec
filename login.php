<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Login.css">
    <title>Document</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="ValidaLogin.php" method="post">
                <img src="img/WorkWaveLogoSemFundo.png" width = "200" class = "imagem">
                <input type="email" name="login" placeholder = "Email">
                <input type="password" name="senha" placeholder = "Senha">
                <?php
                    if(isset($_GET['login']) && $_GET['login'] == "erro"){        
                ?>
                        <div class = "error">
                            <p>Usuario ou senha Inválido(s)</p>
                        </div>
                <?php
                    }
                ?>
                <button type="submit" class = "botao">Entrar</button>
                <button type="button" class = "botao btn1"><a href="cadastrar.php">Cadastrar</a></button>
                <input type="radio" name="Opcao" value = "Proprietario" class = "radio_oculto" checked>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="ValidaLogin.php" method="post">
                <img src="img/WorkWaveLogoSemFundo.png" width = "180" class = "imagem">
                <input type="email" name="login" placeholder = "Email">
                <input type="password" name="senha" placeholder = "Senha">
                <?php
                    if(isset($_GET['login']) && $_GET['login'] == "erro"){        
                ?>
                        <div class = "error">
                            <p>Usuario ou senha Inválido(s)</p>
                        </div>
                <?php
                    }
                ?>
                <button type="submit" class = "botao">Entrar</button>
                <button type="button" class = "botao btn1"><a href="cadastrar.php">Cadastrar</a></button>
                <input type="radio" name="Opcao" value = "Locatario" class = "radio_oculto" checked>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Faça Login como Proprietario</h1>
                    <p>ou Entre como Locatario</p>
                    <button class="hidden" id = "Voltar">Locatario</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Faça Login como Locatario</h1>
                    <p>Ou Entre como Proprietario</p>
                    <button class="hidden" id = "Empresa">Proprietario</button>
                </div>
            </div>
        </div>
    </div>
    <script src = "js/script.js"></script>
</body>
</html>