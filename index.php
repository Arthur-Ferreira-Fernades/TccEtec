<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    
    <title>Login</title>
</head>
<body>
    <div class="conteudo">
        <div class="container">
            <img src="img/WorkWaveLogoSemFundo.png" alt="Logo da Empresa" width="200px" height="200px">
            <form action="ValidaLogin.php" method="post">
                <div class="campo">
                    <img src="img/user-logo.png" alt="Logo user" class="imagem">
                    <input type="text" name="login" placeholder="Login" class="inputTexto"><br><br>
                </div>
                <div class="campo">
                    <img src="img/password-logo.png" alt="Logo senha" class="imagem">
                    <input type="password" name="senha" placeholder="Senha" class="inputTexto"><br><br>
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
                <input type="radio" name="EmpresaLocador" value="Empresa" class = "radio">
                <label for="EmpresaLocador">Empresa</label>
                <input type="radio" name="EmpresaLocador" value="Locador" class = "radio">
                <label for="EmpresaLocador">Locador</label><br><br>
                <div class="botoes">
                    <input type="submit" value="Entrar" class="btn">
                    <a href="cadastrar.php" class="btnLink">Cadastrar</a>
                </div>
            </form>
            
            
        </div>
    </div>
    
</body>
</html>