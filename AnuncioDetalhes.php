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
            $intervalo = $data_entrada->diff($data_saida);
            $numero_dias = $intervalo->days;
    
            // Calcula o valor total da estadia
            $valor_total = $preco_diaria * $numero_dias;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
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
                <div class="anuncio">
                    <h1 class ="mb-4"><?php echo $nome; ?></h1>
                    <div class="detalhesAnuncio">
                        <img src="img/<?php echo $caminho_imagem; ?>" alt="Imagem do Espaço" height="400px">
                        <div class="detalhes">
                            <p class = " mt-5">Endereço: <?php echo $endereco; ?></p>
                            <p>Preço: R$<?php echo number_format($preco, 2, ',', '.'); ?> Diária</p>
                            <p>Capacidade: <?php echo $capacidade; ?></p>
                            <p>Descrição: <?php echo $descricao;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-4">
                <div class="formularioAluguel d-flex mt-5 justify-content-center p-4">
                    <form class="formCalculo">
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
            // Função para calcular o valor total com base nas datas selecionadas
            function calcularValorTotal() {
                var dataEntrada = new Date(document.getElementById('dataEntrada').value);
                var dataSaida = new Date(document.getElementById('dataSaida').value);
                
                // Verifica se ambas as datas foram selecionadas
                if (!dataEntrada || !dataSaida || isNaN(dataEntrada) || isNaN(dataSaida)) {
                    document.getElementById('valorTotal').textContent = 'Escolha a data de entrada e saída'; // Define a mensagem padrão se uma das datas estiver em falta
                    return;
                }

                // Calcula o número de dias entre a entrada e a saída
                var umDia = 24 * 60 * 60 * 1000; // horas*minutos*segundos*milisegundos
                var diferencaDias = Math.round(Math.abs((dataEntrada - dataSaida) / umDia));

                // Obtém o valor da diária do espaço (substitua 100 pelo preço da diária obtido do banco de dados)
                var precoDiaria = <?php echo $preco; ?>;

                // Calcula o valor total da estadia
                var valorTotal = precoDiaria * diferencaDias;

                // Exibe o valor total na página
                document.getElementById('valorTotal').textContent = 'R$' + valorTotal.toFixed(2);
            }

            // Adiciona um ouvinte de evento de mudança aos campos de data
            document.getElementById('dataEntrada').addEventListener('change', calcularValorTotal);
            document.getElementById('dataSaida').addEventListener('change', calcularValorTotal);
        });
    </script>
</body>
</html>
