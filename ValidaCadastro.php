<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/validaCadastro.css">
  <title>Cadastro</title>
</head>

<body>
  <div class="container" id="container">
    <div class="form-container sign-in">
      <?php
      try {
        $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");

        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch (PDOException $erro) {
        echo "Erro na conexão:" . $erro->getMessage();
      }

      //valores do html e colocados em variaveis do php//
      $Nome = $_POST['Nome'];
      $Senha = $_POST['Senha'];
      $Email = $_POST['Email'];
      $Telefone = $_POST['Telefone'];
      $ProprietarioLocador = $_POST['ProprietarioLocador'];

      if ($Nome != "" && $Senha != "" && $Email!= "" && $Telefone != "" && $ProprietarioLocador != "") {
        try{
          
            if ($ProprietarioLocador == "Locatario") {
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM Ocupante WHERE OcuEmail = ?");
            } else {
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM Proprietario WHERE ProEmail = ?");
            }
            $stmt->execute([$Email]);
            $rowCount = $stmt->fetchColumn();

            if ($rowCount > 0) {
                echo "Erro: Este e-mail já está cadastrado.";
            } else {
                // Insere os dados no banco de dados
                if ($ProprietarioLocador == "Locatario") {
                    $stmt = $conexao->prepare("INSERT INTO Ocupante (OcuNome, OcuSenha , OcuEmail, OcuTelefone) VALUES (?, ?, ?, ?)");
                } else {
                    $stmt = $conexao->prepare("INSERT INTO Proprietario (ProNome, ProSenha , ProEmail, ProTelefone) VALUES (?, ?, ?, ?)");
                }
                $stmt->execute([$Nome, $Senha, $Email, $Telefone]);
                
                if ($stmt->rowCount() > 0) {
                    echo "Dados cadastrados com sucesso!";
                } else {
                    echo "Erro ao tentar efetivar cadastro";
                }
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
      ?>
      <button>
        <a href="login.php">Voltar</a>
      </button>
    </div>
  </div>
  </div>
  </div>

</body>

</html>