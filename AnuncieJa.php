<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/AnuncieJa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Anuncie Já</title>
</head>
<body>
    <header>
        <div class="logo">
            <img src="img/WorkWave-removebg-preview (1).png" alt="" width="95px" height="95px">
            <img src="img/WorkWave__2_-removebg-preview.png" alt="" width="100px" height="100px">
        </div>
            <a href="index.php" class="underline">HOME</a>
            <a href="SobreNos.php" class="underline">SOBRE NÓS</a>
            <a href="AnuncieJa.html" class="underline">ANUNCIE JÁ</a>
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
                            if($_SESSION['ProprietarioLocador'] == 'Proprietario') {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="proprietario/AreaProprietario.php">Sua Área</a></li>
                            <li><a class="dropdown-item" href="Validadores/LogOff.php">Sair</a></li>
                        </ul>
                        <?php
                            } else {
                        ?>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="AreaUsuario.php">Sua Área</a></li>
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
    <div class="container" id="container">
        <div class="form-container sign-in">
            <img src="img/WorkWaveLogoSemFundo.png" alt="Logo da Empresa" width="200px" height="200px" class = "Logo">
            <form action="validadores/ValidaAnuncio.php" method="post" enctype="multipart/form-data">
                <div class="campos">
                    <div class="campo">
                        <label for="EspacoNome" id = "TituloNome">Nome</label>
                        <input type="text" name="EspacoNome" id="Nome" placeholder="Nome do Espaço" class="inputTexto" required>
                    </div>
                    <div class="campo">
                        <label for="EspacoEndereco">Endereço</label><br>
                        <input type="Text" name="EspacoEndereco" id="EspacoEndereco" placeholder="Endereço" class="inputTexto" required >
                    </div>
                    <div class="campo">
                        <label for="EspacoDescricao">Descrição</label><br>
                        <textarea name="EspacoDescricao" rows="5" cols="33" placeholder="Faça uma breve descrição sobre seu espaço"></textarea>
                    </div>
                    <div class="campo">
                        <label for="EspacoPreco" id = "TituloPreco">Preço</label><br>
                        <input type="Number" name="EspacoPreco" id="Preco" placeholder="Preço" class="inputTexto" required min="0" value="0" step="any" >
                    </div>
                    <div class="campo">
                        <label for="EspacoCapacidade" id = "TituloCapacidade">Capacidade</label><br>
                        <input type="Number" name="EspacoCapacidade" id="Capacidade" placeholder="Capacidade" class="inputTexto" required min="0" value="0" step="any" >
                    </div>
                    <div class="campo">
                        <label for="Imagem">Imagem</label><br>
                        <input type="file" name="Imagem"  id="Imagem" required>
                    </div>
                </div>            
                <button type="submit" class = "botao">Anunciar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Anuncie seu Espaço</h1>
                    <p>Preencha os campos com os dados do seu espaço</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>