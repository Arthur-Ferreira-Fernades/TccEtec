<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="validadores/ValidaLogin.php" method="post">
                <img src="img/WorkWaveLogoSemFundo.png" width = "200" class = "imagem">
                <input type="email" name="login" placeholder = "Email">
                <div class="input-group" id="grupo">
                    <input type="password" name="senha" id="senha1" placeholder="Senha" class="form-control">
                    <div class="input-group-append" id="verSenha">
                        <span class="input-group-text show-password-btn" data-target="senha1">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <?php
                    session_start();
                    $usuario_validado = false;
                    if(isset($_GET['login']) && $_GET['login'] == "erro"){        
                ?>
                        <div class = "error">
                            <p>Usuario ou senha Inválido(s)</p>
                        </div>
                <?php
                    }
                ?>
                <button type="submit" class = "botao" id="tamanhoBotao">Entrar</button>
                <button type="button" class = "botao btn1" id="tamanhoBotao"><a href="Cadastro.html">Cadastrar</a></button>
                <input type="radio" name="ProprietarioLocador" value = "Proprietario" class = "radio_oculto" checked>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="validadores/ValidaLogin.php" method="post">
                <img src="img/WorkWaveLogoSemFundo.png" width = "180" class = "imagem">
                <input type="email" name="login" placeholder = "Email">
                <div class="input-group" id="grupo">
                    <input type="password" name="senha" id="senha2" placeholder="Senha" class="form-control">
                    <div class="input-group-append" id="verSenha">
                        <span class="input-group-text show-password-btn" data-target="senha2">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                </div>
                <?php
                    if(isset($_GET['login']) && $_GET['login'] == "erro"){        
                ?>
                        <div class = "error">
                            <p>Usuario ou senha Inválido(s)</p>
                        </div>
                <?php
                    }
                ?>
                <button type="submit" class = "botao" id="tamanhoBotao">Entrar</button>
                <button type="button" class = "botao btn1" id="tamanhoBotao"><a href="Cadastro.html">Cadastrar</a></button>
                <input type="radio" name="ProprietarioLocador" value = "Locatario" class = "radio_oculto" checked>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src = "js/script.js"></script>
    <script>
        $(document).ready(function(){
            $('.show-password-btn').click(function(){
                var targetId = $(this).data('target');
                var senhaField = $('#' + targetId);
                var senhaFieldType = senhaField.attr('type');
                if(senhaFieldType == 'password') {
                    senhaField.attr('type', 'text');
                    $(this).find('i').removeClass('bi-eye-slash').addClass('bi-eye');
                } else {
                    senhaField.attr('type', 'password');
                    $(this).find('i').removeClass('bi-eye').addClass('bi-eye-slash');
                }
            });
        });
    </script>
</body>
</html>