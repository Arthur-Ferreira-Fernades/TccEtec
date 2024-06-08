<?php
session_start();

$_SESSION['usuario_validado'] = false;
//tratamento de erro para conexao com banco//

try {
    $conexao = new PDO("mysql:host=localhost; dbname=workwave", "root", "");
    
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $erro) {
  
    echo "Erro na conexão:" . $erro->getMessage();
  }

  //pegar variaveis vindas do html//
  
    $Login = $_POST['login'];
    $senha = $_POST['senha'] ;
    $ProprietarioLocador = $_POST['ProprietarioLocador'];
    $_SESSION['ProprietarioLocador'] = $ProprietarioLocador;

//comando para ir até o banco e preparar para receber o comando abaixo que verifica o login e senha//
if ($senha != "" && $Login!= "" && $ProprietarioLocador != "" && $ProprietarioLocador == "Locatario") {
    $stmt = $conexao->prepare("SELECT OcuEmail, OcuSenha, OcuId FROM Ocupante where OcuEmail=? and OcuSenha=?");

    //informa de onde vira os valores para verificar no banco//
    $stmt->bindParam(1, $Login);
    $stmt->bindParam(2, $senha);

    //executa os comandos no banco//

    $stmt->execute();

    $Usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    //verifica se existe login//
    //se existir chama proxima tela//
    //senao exibe login nao existe//

    if($Usuario)
    {

    $UsuarioId = $Usuario['OcuId'];
    //comando para chamar outra tela//
    header("location: ../index.php");
    $_SESSION['usuario_validado'] = true;
    $_SESSION['UsuarioId'] = $UsuarioId;
    } else {
        header('location: ../login.php?login=erro');
    }

    //exibe mensagem caso na exista//
} else if($senha != "" && $Login!= "" && $ProprietarioLocador != "" && $ProprietarioLocador == "Proprietario"){
    $stmt = $conexao->prepare("SELECT ProEmail, ProSenha, ProId FROM Proprietario where ProEmail=? and ProSenha=?");

    //informa de onde vira os valores para verificar no banco//
    $stmt->bindParam(1, $Login);
    $stmt->bindParam(2, $senha);
    //executa os comandos no banco//

    $stmt->execute();

    //verifica se existe login//
    //se existir chama proxima tela//
    //senao exibe login nao existe//

    $Usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    if($Usuario)
    {
        $UsuarioId = $Usuario['ProId'];
        //comando para chamar outra tela//
        header("location: ../index.php");
        $_SESSION['usuario_validado'] = true;
        $_SESSION['UsuarioId'] = $UsuarioId;
    } else {
        header('location: ../login.php?login=erro');
    }

}else{
    header('location: ../login.php?login=erro');
}


?>