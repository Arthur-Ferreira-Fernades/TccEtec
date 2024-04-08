<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
</head>
<body>
    <div class="conteudo">
        <div class="container">
            <img src="img/WorkWaveLogoSemFundo.png" alt="Logo da Empresa" width="200px" height="200px">
            <form action="cadastrar.php" method="post">
                <div class="campo">
                    <label for="login">Login</label><br>
                    <input type="text" name="login" id="login" placeholder="Login" class="inputTexto"><br><br>
                </div>
                <div class="campo">
                    <label for="senha">Senha</label><br>
                    <input type="Password" name="Senha" id="Senha" placeholder="Senha" class="inputTexto"><br><br>
                </div>
                <div class="campo">
                    <label for="Email">Email</label><br>
                    <input type="text" name="Email" id="Email" placeholder="Email" class="inputTexto"><br><br>
                </div>
                <div class="campo">
                    <label for="Telefone">Telefone</label><br>
                    <input type="text" name="Telefone" id="Telefone" placeholder="Telefone" class="inputTexto"><br><br>
                </div>
                <input type="radio" name="EmpresaLocador" value="Empresa">
                <label for="EmpresaLocador">Empresa</label>
                <input type="radio" name="EmpresaLocador" value="Locador">
                <label for="EmpresaLocador">Locador</label><br><br>
                <div class="botoes">
                    <input type="submit" value="Cadastrar" class="btn">
                </div>
            </form>
        </div>
    </div>
</body>
</html>