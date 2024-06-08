<?php
session_start();
if (!isset($_SESSION['usuario_validado']) || $_SESSION['usuario_validado'] == false) {
    header('Location: login.php');
    exit();
}

require('validadores/conectaBanco.php');

// Determinar o nome da tabela e o nome do campo com base no tipo de usuário
if ($_SESSION['ProprietarioLocador'] == 'Proprietario') {
    $tabela = 'proprietario';
    $campo_id = 'ProId';
    $campo_nome = 'ProNome';
    $campo_telefone = 'ProTelefone';
    $campo_email = 'ProEmail';
    $campo_senha = 'ProSenha';
} else {
    $tabela = 'ocupante';
    $campo_id = 'OcuId';
    $campo_nome = 'OcuNome';
    $campo_telefone = 'OcuTelefone';
    $campo_email = 'OcuEmail';
    $campo_senha = 'OcuSenha';
}

// Definir a mensagem de confirmação como vazia por padrão
$mensagem = '';

// Recuperar dados do usuário do banco de dados
$stmt = $conexao->prepare("SELECT * FROM $tabela WHERE $campo_id = :id");
$stmt->bindParam(':id', $_SESSION['UsuarioId']);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Processar o envio do formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Atualizar os dados no banco de dados
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conexao->prepare("UPDATE $tabela SET $campo_nome = :nome, $campo_telefone = :telefone, $campo_email = :email, $campo_senha = :senha WHERE $campo_id = :UsuarioId");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':UsuarioId', $_SESSION['UsuarioId']);
    $stmt->execute();

    // Verificar se a atualização foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        $mensagem = 'Alterações salvas com sucesso!';
        
        // Recarregar os dados do usuário após a atualização
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE $campo_id = :id");
        $stmt->bindParam(':id', $_SESSION['UsuarioId']);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $mensagem = 'Nenhuma alteração foi feita.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/DadosUsuario.css">
    <link rel="stylesheet" href="css/Style.css">
    <title>Dados Usuario</title>
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
                <li><a class="dropdown-item" href="proprietario/AreaProprietario.php">Sua Area</a></li>
                <li><a class="dropdown-item" href="Validadores/LogOff.php">Sair</a></li>
            </ul>
            <?php
            } else {
            ?>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="usuario/AreaUsuario.php">Sua Area</a></li>
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
    <div class="dados">
        <h1 class = "text-center mb-5">Informações Pessoais</h1>
        <?php if (!empty($mensagem)) : ?>
            <div class="alert alert-success" role="alert">
                <?= $mensagem ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $usuario[$campo_nome] ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="enableField('nome')">Editar</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= $usuario[$campo_telefone] ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="enableField('telefone')">Editar</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $usuario[$campo_email] ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="enableField('email')">Editar</button>
                </div>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="senha" name="senha" value="<?= $usuario[$campo_senha] ?>" readonly>
                    <button class="btn btn-outline-secondary" type="button" onclick="enableField('senha')">Editar</button>
                </div>
            </div>
            <div class="botao d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    function enableField(fieldName) {
        document.getElementById(fieldName).readOnly = false;
        document.getElementById(fieldName).focus();
    }
</script>
</body>
</html>
