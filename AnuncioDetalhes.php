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

        $query = "SELECT EspacoDados.*, servAmenidades.* FROM EspacoDados 
        LEFT JOIN servAmenidades ON EspacoDados.SerId = servAmenidades.SerId
        WHERE EspacoDados.EspId = :id_anuncio";
        $stmt_servicos = $conexao->prepare($query); // Use uma nova variável $stmt_servicos
        $stmt_servicos->bindParam(':id_anuncio', $_SESSION['id_anuncio'], PDO::PARAM_INT);
        $stmt_servicos->execute();

        if ($stmt_servicos->rowCount() > 0) {
            $servicosEAmenidades = array();
            while ($row = $stmt_servicos->fetch(PDO::FETCH_ASSOC)) {
                $servicosEAmenidades[] = $row;
            }
        } else {
            echo "Nenhum serviço ou amenidade encontrado para este espaço.";
        }

        $query_reservas = "SELECT AluDataEntrada, AluDataSaida FROM alugar WHERE EspId = :id_anuncio";
        $stmt_reservas = $conexao->prepare($query_reservas);
        $stmt_reservas->bindParam(':id_anuncio', $_SESSION['id_anuncio'], PDO::PARAM_INT);
        $stmt_reservas->execute();
        $reservas = $stmt_reservas->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "Espaço não encontrado.";
    }
} catch (PDOException $erro) {
    echo "Erro na conexão:" . $erro->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['dataEntrada']) && !empty($_POST['dataSaida'])) {
        $data_entrada = DateTime::createFromFormat('d/m/Y', $_POST['dataEntrada'])->format('d-m-Y');
        $data_saida = DateTime::createFromFormat('d/m/Y', $_POST['dataSaida'])->format('d-m-Y');

        // Consulta para verificar se o espaço está disponível durante o período escolhido
        $query = "SELECT * FROM alugar WHERE EspId = :id_anuncio AND ((AluDataEntrada <= :data_saida) AND (AluDataSaida >= :data_entrada))";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_anuncio', $_SESSION['id_anuncio'], PDO::PARAM_INT);
        $stmt->bindParam(':data_entrada', $data_entrada, PDO::PARAM_STR);
        $stmt->bindParam(':data_saida', $data_saida, PDO::PARAM_STR);
        $stmt->execute();

        // Verifica se há algum resultado da consulta
        if ($stmt->rowCount() > 0) {
            // Espaço não está disponível
            $reserva = $stmt->fetch(PDO::FETCH_ASSOC);
            $data_entrada_reserva = new DateTime($reserva['AluDataEntrada']);
            $data_saida_reserva = new DateTime($reserva['AluDataSaida']);
        } else {
            // Espaço está disponível, continua com o processo de aluguel
            $intervalo = $data_entrada->diff($data_saida);
            $numero_dias = $intervalo->days;

            // Calcula o valor total da estadia
            $valor_total = $preco_diaria * $numero_dias;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/AnuncioDetalhes.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                if (isset($_GET['error']) && $_GET['error'] == 6) {
                    echo "<div class='alert alert-danger' role='alert'>Entre com a sua conta de locador, por favor.</div>";
                }

                if (isset($_GET['error']) && $_GET['error'] == 5) {
                    echo "<div class='alert alert-danger' role='alert'>Entre com a sua conta de locador, por favor.</div>";
                }
                ?>

                <div class="anuncio">
                    <h1 class="mb-4"><?php echo $nome; ?></h1>
                    <div class="detalhesAnuncio">
                        <img src="img/<?php echo $caminho_imagem; ?>" alt="Imagem do Espaço" height="400px">
                        <div class="detalhes">
                            <p class=" mt-5">Endereço: <?php echo $endereco; ?></p>
                            <p>Preço: R$<?php echo number_format($preco, 2, ',', '.'); ?> Diária</p>
                            <p>Capacidade: <?php echo $capacidade; ?></p>
                            <p><?php echo $descricao; ?></p>
                            <?php
                            $nomesServicos = array(
                                'SerWifi' => 'Wi-Fi',
                                'SerArcondicionado' => 'Ar Condicionado',
                                'SerBebedouro' => 'Bebedouro',
                                'SerComputadores' => 'Computadores',
                                'SerCozinha' => 'Cozinha'
                            );
                            ?>
                            <?php foreach ($servicosEAmenidades as $item) : ?>
                                <?php foreach ($nomesServicos as $coluna => $nomeServico) : ?>
                                    <li>
                                        <?php echo $nomeServico; ?>
                                        <?php if ($item[$coluna] == 1) : ?>
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                        <?php else : ?>
                                            <i class="bi bi-x-circle-fill text-danger"></i>
                                        <?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
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
                            <label for="dataEntrada" class="form-label">Data de Entrada:</label>
                            <input type="text" class="form-control" id="dataEntrada" name="dataEntrada">
                        </div>
                        <div class="mb-3">
                            <label for="dataSaida" class="form-label">Data de Saída:</label>
                            <input type="text" class="form-control" id="dataSaida" name="dataSaida">
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
        $("#dataEntrada").datepicker({
            dateFormat: 'dd/mm/yy', // Formato da data
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"], // Dias da semana abreviados
            monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"], // Meses
            monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"], // Meses abreviados
            firstDay: 0, // Primeiro dia da semana (0 = Domingo, 1 = Segunda, etc.)
            minDate: 0, // Data mínima (hoje)
            beforeShowDay: marcaDiasIndisponiveis, // Função para marcar os dias indisponíveis
            onSelect: function(selectedDate) {
                // Quando uma data é selecionada, atualiza a data mínima da saída para o próximo dia
                var date = $(this).datepicker('getDate');
                date.setDate(date.getDate() + 1);
                $("#dataSaida").datepicker("option", "minDate", date);
                validarDatas();
            }
        });

        $("#dataSaida").datepicker({
            dateFormat: 'dd/mm/yy', // Formato da data
            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"], // Dias da semana abreviados
            monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"], // Meses
            monthNamesShort: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"], // Meses abreviados
            firstDay: 0, // Primeiro dia da semana (0 = Domingo, 1 = Segunda, etc.)
            minDate: 1, // Data mínima é o próximo dia após a entrada
            beforeShowDay: marcaDiasIndisponiveis, // Função para marcar os dias indisponíveis
            onSelect: function(selectedDate) {
                validarDatas();
            }
        });

        var reservas = <?php echo json_encode($reservas); ?>;

        function marcaDiasIndisponiveis(date) {
    var dateString = $.datepicker.formatDate('yy-mm-dd', date);
    var dataEntrada = $("#dataEntrada").datepicker('getDate');
    var dataSaida = $("#dataSaida").datepicker('getDate');

    // Verifica se a data está dentro do intervalo de alguma reserva
    for (var i = 0; i < reservas.length; i++) {
        var reservaEntrada = new Date(reservas[i].AluDataEntrada);
        var reservaSaida = new Date(reservas[i].AluDataSaida);

        if (date >= reservaEntrada && date <= reservaSaida) {
            return [false, "unavailable", "Indisponível"]; // Marca o dia como indisponível
        }
    }

    // Desabilita os dias após o último dia de reserva
    if (dataSaida !== null && date.getTime() > dataSaida.getTime()) {
        return [false, "unavailable", "Indisponível"]; // Marca o dia como indisponível
    }

    // Desabilita o dia anterior ao da data de entrada
    if (dataEntrada !== null && date.getTime() < dataEntrada.getTime()) {
        return [false, "unavailable", "Indisponível"]; // Marca o dia como indisponível
    }

    // Desabilita o dia seguinte ao da data de saída
    if (dataSaida !== null && date.getTime() === dataSaida.getTime() + 86400000) {
        return [false, "unavailable", "Indisponível"]; // Marca o dia como indisponível
    }

    return [true, "", "Disponível"]; // Deixa o dia disponível
}

        function validarDatas() {
            var dataEntrada = $("#dataEntrada").datepicker('getDate');
            var dataSaida = $("#dataSaida").datepicker('getDate');
            var botaoAlugar = $('.btn.btn-primary');

            var disponivel = true;
            for (var i = 0; i < reservas.length; i++) {
                var reservaEntrada = new Date(reservas[i].AluDataEntrada);
                var reservaSaida = new Date(reservas[i].AluDataSaida);

                if (dataSaida >= reservaEntrada && dataSaida < reservaSaida) {
                    disponivel = false;
                    break;
                }
            }

            if (dataEntrada !== null && dataSaida !== null && disponivel && <?php echo $disponibilidade; ?> == 1) {
                botaoAlugar.removeAttr('disabled');
            } else {
                botaoAlugar.attr('disabled', 'disabled');
            }
        }

        $("#dataEntrada").on('change', function() {
            validarDatas();
        });

        $("#dataSaida").on('change', function() {
            validarDatas();
        });

        // Chamada inicial para validar as datas ao carregar a página
        validarDatas();
    });
</script>

</body>

</html>