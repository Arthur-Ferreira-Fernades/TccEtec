<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        try {
            $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
            
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $erro) {
            echo "Erro na conexão:" . $erro->getMessage();
        }
        
        //valores do html e colocados em variaveis do php//
        $Nome = $_POST['Nome'];
        $Senha= $_POST['Senha'];
        $Email = $_POST['Email'];
        $Telefone = $_POST['Telefone'];
        $ProprietarioLocador = $_POST['ProprietarioLocador'];

        //tratamento de erro caso nao encontre a tabela//
        if ($Nome != "" && $Senha != "" && $Email!= "" && $Telefone != "" && $ProprietarioLocador != "" && $ProprietarioLocador == "Locatario") {
            try{

                  //Insert Into - comandos do SQL //
                  //variavel $stmt com a conexao prepara o comando insert para o banco //
                  // values com ponto de interrogação se referem a quantidade de item a serem inseridos no banco//
                $stmt = $conexao->prepare("INSERT INTO Ocupante (OcuNome, OcuSenha , OcuEmail, OcuTelefone) VALUES (?, ?, ?, ?)");
                
                //valores passados por parametros//
                $stmt->bindParam(1, $Nome);
                $stmt->bindParam(2, $Senha);
                $stmt->bindParam(3, $Email);
                $stmt->bindParam(4, $Telefone);
                
                //executa o comando no banco //
                $stmt->execute();
              
                //se executa comando e inseriu corretamente contagem de linhas será maior que 0 - com isso cadastrado //
                //senao executou e nao retornou nenhuma linha - algum erro no código//
                    if ($stmt->rowCount() > 0) {
                
                    //verifica campos se está tudo ok sem  nulo //
                      echo "Dados cadastrados com sucesso!";
                      $id = null;
                      $Nome = null;
                      $Email = null;
                      $Telefone = null;
                
                      //senao exibe erro ao cadastrar//
                  } else {
                      echo "Erro ao tentar efetivar cadastro";
                  }
                
                
                //ira exibir o tipo de erro//
            }catch (PDOException $erro) {
                
                echo "Erro: " . $erro->getMessage();
                
            }
                
          } else if ($Nome != "" && $Senha != "" && $Email!= "" && $Telefone != "" && $ProprietarioLocador != "" && $ProprietarioLocador == "Proprietario") {
            try{

                //Insert Into - comandos do SQL //
                //variavel $stmt com a conexao prepara o comando insert para o banco //
                // values com ponto de interrogação se referem a quantidade de item a serem inseridos no banco//
              $stmt = $conexao->prepare("INSERT INTO Proprietario (ProNome, ProSenha , ProEmail, ProTelefone) VALUES (?, ?, ?, ?)");
              
              //valores passados por parametros//
              $stmt->bindParam(1, $Nome);
              $stmt->bindParam(2, $Senha);
              $stmt->bindParam(3, $Email);
              $stmt->bindParam(4, $Telefone);
              
              //executa o comando no banco //
              $stmt->execute();
            
              //se executa comando e inseriu corretamente contagem de linhas será maior que 0 - com isso cadastrado //
              //senao executou e nao retornou nenhuma linha - algum erro no código//
                if ($stmt->rowCount() > 0) {
              
                  //verifica campos se está tudo ok sem  nulo //
                    echo "Dados cadastrados com sucesso!";
                    $id = null;
                    $Nome = null;
                    $Email = null;
                    $Telefone = null;
              
                    //senao exibe erro ao cadastrar//
                } else {
                    echo "Erro ao tentar efetivar cadastro";
                }
              
              //ira exibir o tipo de erro//
              }catch (PDOException $erro) {
              
              echo "Erro: " . $erro->getMessage();
              
              }
          } else {
            echo "Cadastrar dados validos";
          }

        ?>
        <a href="login.php">Voltar</a>
</body>
</html>