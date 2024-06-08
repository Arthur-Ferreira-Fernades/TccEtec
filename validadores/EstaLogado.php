<?php
    if (!isset($_SESSION['UsuarioId'])) {
        header("Location: ../login.php");
        exit();
    }
?>