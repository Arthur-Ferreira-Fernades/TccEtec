<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Cadastro.css">
    <title>Document</title>
</head>
<body>
    <div class="container" id="container">
        <div class="form-container sign-in">
            <img src="img/WorkWaveLogoSemFundo.png" alt="Logo da Empresa" width="200px" height="200px">
            <form action="ValidaCadastro" method="post">
                <div class="campo">
                    <label for="login">Login</label>
                    <input type="text" name="login" id="login" placeholder="Login" class="inputTexto">
                </div>
                <div class="campo">
                    <label for="senha">Senha</label><br>
                    <input type="Password" name="Senha" id="Senha" placeholder="Senha" class="inputTexto">
                </div>
                <div class="campo">
                    <label for="Email">Email</label><br>
                    <input type="text" name="Email" id="Email" placeholder="Email" class="inputTexto">
                </div>
                <div class="campo">
                    <label for="Telefone">Telefone</label><br>
                    <input type="text" name="Telefone" id="Telefone" placeholder="Telefone" class="inputTexto">
                </div>
                <div class="campo">
                    <input type="radio" name="EmpresaLocador" value="Empresa">
                    <label for="EmpresaLocador">Empresa</label>
                    <input type="radio" name="EmpresaLocador" value="Locador">
                    <label for="EmpresaLocador">Locador</label>
                </div>            
                <button type="submit" class = "botao">Cadastrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Faça seu cadastro</h1>
                    <p>Preencha os campos com seus dados</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>