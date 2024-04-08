<?php

$usuario_validado = false;

$usuarios_autenticados = array(
    array('id' => 1, 'login' => '123', 'senha' => '123', 'EmpresaLocador' => 'Locador')
);

foreach ($usuarios_autenticados as $usuario) {
    if ($usuario['login'] == $_POST['login'] && $usuario ['senha'] == $_POST['senha'] && $usuario['EmpresaLocador'] == $_POST['EmpresaLocador']) {
        $usuario_validado = true;
    }
}

if ($usuario_validado == true) {
    header('location: home.php');
} else {
    header('location:index.php?login=erro');
}

?>