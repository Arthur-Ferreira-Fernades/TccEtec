<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['anuncio_id'])) {
        $anuncio_id = $_POST['anuncio_id'];

        // Execute a atualização para congelar o anúncio
        try {
            $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $query = "UPDATE EspacoDados SET EspCongelado = TRUE WHERE EspId = :anuncio_id";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':anuncio_id', $anuncio_id);
            $stmt->execute();

            // Redirecione de volta para a página de anúncios após o congelamento
            header("Location: ../proprietario/AreaProprietario.php");
            exit();
        } catch (PDOException $erro) {
            echo "Erro na conexão:" . $erro->getMessage();
        }
    } else {
        // Se o ID do anúncio não estiver presente no formulário, exiba uma mensagem de erro ou redirecione para uma página de erro
        echo "Erro: ID do anúncio ausente.";
    }
} else {
    // Se a solicitação não for do tipo POST, exiba uma mensagem de erro ou redirecione para uma página de erro
    echo "Erro: A solicitação deve ser do tipo POST.";
}
?>