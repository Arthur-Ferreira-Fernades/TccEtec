<?php
session_start();
require('../validadores/EstaLogado.php');
require('../validadores/conectaBanco.php');


// Verificar se o usuário está logado
if (isset($_SESSION['usuario_validado']) && $_SESSION['usuario_validado'] == true) {
    // Recuperar o ID do usuário logado (você precisa ajustar isso de acordo com a sua aplicação)
    $UsuarioId = $_SESSION['UsuarioId'];

    // Consulta SQL com prepared statement para recuperar os aluguéis feitos pelo usuário, juntamente com os dados do espaço
    $sql = "SELECT a.AluId, e.EspNome, a.AluDataEntrada, a.AluDataSaida, a.AluQuantidadePessoas, a.AluHorarioCheckIn, a.AluValor, o.OcuNome
        FROM alugar AS a 
        INNER JOIN espacodados AS e ON a.EspId = e.EspId 
        INNER JOIN ocupante AS o ON a.OcuId = o.OcuId
        WHERE e.ProId = :UsuarioId";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':UsuarioId', $UsuarioId, PDO::PARAM_INT);
    $stmt->execute();
    
    // Verificar se há resultados
    if ($stmt->rowCount() > 0) {
        // Armazenar os resultados em $resultado
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Se não houver resultados, atribuir um array vazio a $resultado
        $resultado = [];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Style.css">
    <style>
        .conteudo {
            height: 100vh;
        }
    </style>
    <title>Alugueis Feitos</title>
    <style>
        .conteudo {
            padding: 20px;
            text-align: center;
        }
    </style>
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
                <li><a class="dropdown-item" href="AreaProprietario.php">Sua Área</a></li>
                <li><a class="dropdown-item" href="../Validadores/LogOff.php">Sair</a></li>
            </ul>
        </div>
    </header>
    <div class="conteudo">
        <h2 style="margin-bottom: 20px;">Alugueis já realizados:</h2>
        <div class="row">
            <?php
            if ($resultado == []) {
                echo '<h2>Ainda não alugaram seu(s) espaço(s)</h2>';
            }
            // Iterar sobre os resultados e exibir cada aluguel na lista
            foreach ($resultado as $aluguel) {
                $dataAtual = date('Y-m-d');
                    ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $aluguel['EspNome']; ?></h5>
                                <p class="card-text mb-1">Ocupante: <?php echo $aluguel['OcuNome']; ?></p>
                                <p class="card-text mb-1">Data de entrada: <?php echo date('d/m/Y', strtotime($aluguel['AluDataEntrada'])); ?></p>
                                <p class="card-text mb-1">Data de saída: <?php echo date('d/m/Y', strtotime($aluguel['AluDataSaida'])); ?></p>
                                <p class="card-text mb-1">Horário de check-in: <?php echo date('H:i', strtotime($aluguel['AluHorarioCheckIn'])); ?></p>
                                <p class="card-text mb-1">Quantidade de pessoas: <?php echo $aluguel['AluQuantidadePessoas']; ?></p>
                                <p class="card-text mb-1">Valor R$: <?php echo $aluguel['AluValor']; ?></p>
                            </div>
                        </div>
                    </div>
            <?php
            }
            ?>
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