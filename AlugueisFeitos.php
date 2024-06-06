<?php
session_start();

try {
    $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}

// Verificar se o usuário está logado
if (isset($_SESSION['usuario_validado']) && $_SESSION['usuario_validado'] == true) {
    // Recuperar o ID do usuário logado (você precisa ajustar isso de acordo com a sua aplicação)
    $UsuarioId = $_SESSION['UsuarioId'];

    // Consulta SQL com prepared statement para recuperar os aluguéis feitos pelo usuário, juntamente com os dados do espaço
    $sql = "SELECT a.AluId, e.EspNome, a.AluDataEntrada, a.AluDataSaida 
            FROM alugar AS a 
            INNER JOIN espacodados AS e ON a.EspId = e.EspId 
            WHERE a.OcuId = :UsuarioId";
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
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
                        <li><a class="dropdown-item" href="AreaProprietario.php">Sua Area</a></li>
                        <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="AreaUsuario.php">Sua Area</a></li>
                        <li><a class="dropdown-item" href="LogOff.php">Sair</a></li>
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
        <h2 style="margin-bottom: 20px;">Seus aluguéis:</h2>
        <div class="row">
            <?php
            if ($resultado == []) {
                echo '<h2>Você ainda não realizou nenhum aluguel</h2>';
            }
            // Iterar sobre os resultados e exibir cada aluguel na lista
            foreach ($resultado as $aluguel) {
                $dataAtual = date('Y-m-d');
                    ?>
                    <div class="col-md-6">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $aluguel['EspNome']; ?></h5>
                                <p class="card-text">Data de entrada: <?php echo date('d/m/Y', strtotime($aluguel['AluDataEntrada'])); ?></p>
                                <p class="card-text">Data de saída: <?php echo date('d/m/Y', strtotime($aluguel['AluDataSaida'])); ?></p>

                                <?php
                                // Verificar se a data de entrada é menor ou igual à data atual
                                if ($aluguel['AluDataEntrada'] > $dataAtual) {
                                    ?>
                                    <form action="CancelarAluguel.php" method="POST" onsubmit="return confirm('Tem certeza de que deseja cancelar este aluguel?');">
                                        <input type="hidden" name="alu_id" value="<?php echo $aluguel['AluId']; ?>">
                                        <button type="submit" class="btn btn-danger">Cancelar Aluguel</button>
                                    </form>
                                <?php
                                } else {
                                    // Se a data de entrada for igual ou maior à data atual, desabilite o botão
                                    ?>
                                    <button type="button" class="btn btn-danger" disabled>Cancelar Aluguel</button>
                                <?php
                                }
                                ?>
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
                        <a class="btn" href="#">
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
                        <a class="btn" href="#">
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
                        <a class="btn" href="#">
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

<?php
} else {
    // Se o usuário não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit(); // Certifique-se de sair após redirecionar
}
?>

