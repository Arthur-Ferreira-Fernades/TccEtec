<?php
    session_start();
    require('../validadores/conectaBanco.php');
    require('../validadores/EstaLogado.php');

    if (isset($_SESSION['UsuarioId'])) {
        $query = "SELECT EspacoDados.EspId, EspacoDados.EspNome, 
                ServAmenidades.SerId, ServAmenidades.SerWifi, ServAmenidades.SerArcondicionado, 
                ServAmenidades.SerBebedouro, ServAmenidades.SerCozinha, ServAmenidades.SerComputadores
                FROM EspacoDados
                LEFT JOIN ServAmenidades ON EspacoDados.EspId = ServAmenidades.EspId
                WHERE EspacoDados.ProId = :UsuarioId";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':UsuarioId', $_SESSION['UsuarioId']);
        $stmt->execute();
        $anuncios = $stmt->fetchAll();
    } else {
        // Redireciona para a página de login ou faça algo semelhante se o ID do proprietário não estiver definido na sessão
        header("Location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/Style.css">
    <title>Editar Anuncio</title>
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
    <div class="container mt-5 d-flex flex-column">
        <h2 class="mb-4 text-center">Atualizar Anúncio</h2>
        <form action="../validadores/ValidaAtualizacao.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="anuncio" class="form-label">Selecione o Anúncio:</label>
                <select class="form-select" name="anuncio" id="anuncio">
                    <?php foreach ($anuncios as $anuncio) : ?>
                        <option value="<?php echo $anuncio['EspId']; ?>"><?php echo $anuncio['EspNome']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="novo_nome" class="form-label">Novo Nome:</label>
                <input type="text" class="form-control" id="novo_nome" name="novo_nome">
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="novo_preco" class="form-label">Novo Preço:</label>
                    <input type="number" class="form-control" id="novo_preco" name="novo_preco" step="any">
                </div>
                <div class="mb-3">
                    <label for="nova_capacidade" class="form-label">Nova Capacidade:</label>
                    <input type="number" class="form-control" id="nova_capacidade" name="nova_capacidade">
                </div>
                <div class="mb-3">
                    <label for="nova_descricao" class="form-label">Nova Descrição:</label><br>
                    <textarea name="nova_descricao" rows="5" cols="60" placeholder="Atualize sua descrição"></textarea>
                </div>
                <div class="mb-3">
                    <label for="nova_imagem" class="form-label">Nova Imagem:</label>
                    <input type="file" class="form-control" id="nova_imagem" name="nova_imagem">
                </div>
                <label class="form-label">Disponibilidade:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="disponibilidade" id="disponivel" value="1">
                    <label class="form-check-label" for="disponivel">Disponível</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="disponibilidade" id="indisponivel" value="0">
                    <label class="form-check-label" for="indisponivel">Indisponível</label>
                </div>
            </div>
            <div class="mb-3" id="recursos-container">
                <!-- Aqui será inserido dinamicamente os recursos do anúncio selecionado -->
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Anúncio</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        // Crie um array JavaScript para armazenar os anúncios e seus recursos
        var anuncios = <?php echo json_encode($anuncios); ?>;

        // Função para atualizar os recursos exibidos com base no anúncio selecionado
        function atualizarRecursos() {
            var selectedAnuncioId = document.getElementById('anuncio').value;
            var recursosContainer = document.getElementById('recursos-container');
            recursosContainer.innerHTML = ''; // Limpa os recursos antigos

            // Encontra o anúncio correspondente ao ID selecionado
            var selectedAnuncio = anuncios.find(function(anuncio) {
                return anuncio['EspId'] == selectedAnuncioId;
            });

            // Se o anúncio for encontrado, exiba seus recursos
            if (selectedAnuncio) {
                recursosContainer.innerHTML += `
                <label class='form-label'>Recursos:</label>
                <div class='mb-3'>
                    <div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='recursos[]' id='wifi_${selectedAnuncio['EspId']}' value='SerWifi' ${selectedAnuncio['SerWifi'] == true ? 'checked' : ''}>
                        <label class='form-check-label' for='wifi_${selectedAnuncio['EspId']}'>Wifi</label>
                    </div>
                    <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='recursos[]' id='arcondicionado_${selectedAnuncio['EspId']}' value='SerArCondicionado' ${selectedAnuncio['SerArcondicionado'] == true ? 'checked' : ''}>
                        <label class='form-check-label' for='arcondicionado_${selectedAnuncio['EspId']}'>Ar Condicionado</label>
                    </div>
                    <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='recursos[]' id='bebedouro_${selectedAnuncio['EspId']}' value='SerBebedouro' ${selectedAnuncio['SerBebedouro'] == true ? 'checked' : ''}>
                        <label class='form-check-label' for='bebedouro_${selectedAnuncio['EspId']}'>Bebedouro</label>
                    </div>
                    <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='recursos[]' id='computadores_${selectedAnuncio['EspId']}' value='SerComputadores' ${selectedAnuncio['SerComputadores'] == true ? 'checked' : ''}>
                        <label class='form-check-label' for='computadores_${selectedAnuncio['EspId']}'>Computadores</label>
                    </div>
                    <div class='form-check'>
                    <input class='form-check-input' type='checkbox' name='recursos[]' id='cozinha_${selectedAnuncio['EspId']}' value='SerCozinha' ${selectedAnuncio['SerCozinha'] == true ? 'checked' : ''}>
                        <label class='form-check-label' for='cozinha_${selectedAnuncio['EspId']}'>Cozinha</label>
                    </div>
                </div>`;
            }
        }

        // Chame a função para exibir os recursos quando o campo de seleção do anúncio for alterado
        document.getElementById('anuncio').addEventListener('change', atualizarRecursos);

        // Chame a função uma vez para exibir os recursos do anúncio inicialmente selecionado
        atualizarRecursos();
    </script>
</body>

</html>