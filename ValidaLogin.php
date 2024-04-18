<?php

$usuario_validado = false;

$usuarios_autenticados = array(
    array('id' => 1, 'login' => '123@123', 'senha' => '123', 'Opcao' => 'Locatario')
);

foreach ($usuarios_autenticados as $usuario) {
    if ($usuario['login'] == $_POST['login'] && $usuario ['senha'] == $_POST['senha'] && $usuario['Opcao'] == $_POST['Opcao']) {
        $usuario_validado = true;
    }
}

if ($usuario_validado == true) {
    header('location: home.php');
} else {
    header('location:login.php?login=erro');
}

?>