<?php
session_start();

if (isset($_GET['id'])) {
    $_SESSION['id_anuncio'] = $_GET['id'];
}

try {
    $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
    
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM EspacoDados WHERE EspId = :id_anuncio";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_anuncio', $_SESSION['id_anuncio'], PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $espaco = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $espaco['EspNome'];
        $capacidade = $espaco['EspCapacidade'];
        $disponibilidade = $espaco['EspDisponibilidade'];
        $preco = $espaco['EspPreco'];
        $endereco = $espaco['EspEndereco'];
        $caminho_imagem = $espaco['EspImg'];
        $descricao = $espaco['EspDescricao'];
    } else {
        echo "Espaço não encontrado.";
    }

} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['dataEntrada']) && !empty($_POST['dataSaida'])) {
        $data_entrada = new DateTime($_POST['dataEntrada']);
        $data_saida = new DateTime($_POST['dataSaida']);

        $query = "SELECT * FROM alugar WHERE EspId = :id_anuncio AND ((AluDataEntrada <= :data_saida) AND (AluDataSaida >= :data_entrada))";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_anuncio', $_SESSION['id_anuncio'], PDO::PARAM_INT);
        $stmt->bindParam(':data_entrada', $data_entrada->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->bindParam(':data_saida', $data_saida->format('Y-m-d'), PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);
            $data_entrada_reserva = new DateTime($reserva['AluDataEntrada']);
            $data_saida_reserva = new DateTime($reserva['AluDataSaida']);
        } else {
            $intervalo = $data_entrada->diff($data_saida);
            $numero_dias = $intervalo->days;

            $valor_total = $preco_diaria * $numero_dias;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="AnuncioDetalhes.css">
    <title>Detalhes do Anuncio</title>
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
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <?php
                    if (isset($_GET['aluguel'])) {
                        if ($_GET['aluguel'] === 'sucesso') {
                            echo "<div class='alert alert-success' role='alert'>Espaço alugado com sucesso!</div>";
                        } elseif ($_GET['aluguel'] === 'falha') {
                            echo "<div class='alert alert-danger' role='alert'>Erro ao alugar o espaço. Por favor, tente novamente.</div>";
                        }
                    }
                    if (isset($_GET['error']) && $_GET['error'] == 3) {
                        $data_ocupada_inicio = isset($_GET['data_ocupada_inicio']) ? DateTime::createFromFormat('Y-m-d', $_GET['data_ocupada_inicio'])->format('d/m/Y') : "N/A";
                        $data_ocupada_fim = isset($_GET['data_ocupada_fim']) ? DateTime::createFromFormat('Y-m-d', $_GET['data_ocupada_fim'])->format('d/m/Y') : "N/A";
                        echo "<div class='alert alert-danger' role='alert'>O espaço já está alugado para as datas de $data_ocupada_inicio até $data_ocupada_fim. Por favor, escolha outras datas.</div>";
                    }
                ?>
                
                <div class="anuncio">
                    <h1 class ="mb-4"><?php echo $nome; ?></h1>
                    <div class="detalhesAnuncio">
                        <img src="img/<?php echo $caminho_imagem; ?>" alt="Imagem do Espaço" height="400px">
                        <div class="detalhes">
                            <p class = " mt-5">Endereço: <?php echo $endereco; ?></p>
                            <p>Preço: R$<?php echo number_format($preco, 2, ',', '.'); ?> Diária</p>
                            <p>Capacidade: <?php echo $capacidade; ?></p>
                            <p><?php echo $descricao;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="formularioAluguel d-flex mt-5 justify-content-center p-4">
                    <form class="formCalculo" action="ValidaAluguel.php" method="post">
                            <p class="card-text mt-2 <?php echo $disponibilidade == 0 ? 'text-danger' : 'text-success'; ?>">
                                <?php echo $disponibilidade == 0 ? 'Indisponível' : 'Disponível'; ?>
                            </p>
                            <div class="mb-3">
                                <label for="dataEntrada" class="form-label">Data de entrada</label>
                                <input type="date" class="form-control" id="dataEntrada" name="dataEntrada" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="dataSaida" class="form-label">Data de saída</label>
                                <input type="date" class="form-control" id="dataSaida" name="dataSaida" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <h2>Valor total:</h2>
                            <p id="valorTotal">Escolha a data de entrada e saída</p>
                            <button type="submit" class="btn btn-primary">Alugar</button>
                        </form>
                </div>
            </div>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function calcularValorTotal() {
                var dataEntrada = new Date(document.getElementById('dataEntrada').value);
                var dataSaida = new Date(document.getElementById('dataSaida').value);
                
                if (!dataEntrada || !dataSaida || isNaN(dataEntrada) || isNaN(dataSaida)) {
                    document.getElementById('valorTotal').textContent = 'Escolha a data de entrada e saída';
                    return;
                }

                var umDia = 24 * 60 * 60 * 1000; 
                var diferencaDias = Math.round(Math.abs((dataEntrada - dataSaida) / umDia));

                var precoDiaria = <?php echo $preco; ?>;

                // Calcula o valor total da estadia
                var valorTotal = precoDiaria * diferencaDias;

                // Exibe o valor total na página
                document.getElementById('valorTotal').textContent = 'R$' + valorTotal.toFixed(2);
            }

            // Adiciona um ouvinte de evento de mudança aos campos de data
            document.getElementById('dataEntrada').addEventListener('change', function(){
                calcularValorTotal();
                validarDatas();
            });
            document.getElementById('dataSaida').addEventListener('change', function(){
                calcularValorTotal();
                validarDatas();
            });

            function validarDatas() {
                var dataEntrada = document.getElementById('dataEntrada').value;
                var dataSaida = document.getElementById('dataSaida').value;
                var botaoAlugar = document.querySelector('.btn.btn-primary');

                // Verifica se ambas as datas foram preenchidas
                if (dataEntrada !== '' && dataSaida !== '') {
                    botaoAlugar.removeAttribute('disabled'); // Habilita o botão "Alugar"
                } else {
                    botaoAlugar.setAttribute('disabled', 'disabled'); // Desabilita o botão "Alugar"
                }
            }

            // Chama a função de validação inicialmente para desabilitar o botão "Alugar" se os campos de data estiverem vazios
            validarDatas();
        });

        
        
    </script>
</body>
</html>
