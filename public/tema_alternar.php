<?php
    session_start();

    if (!isset($_SESSION['tema'])) {
        $_SESSION['tema'] = 'claro';
    }

    if ($_SESSION['tema'] == 'claro') {
        $_SESSION['tema'] = 'escuro';
    } else {
        $_SESSION['tema'] = 'claro';
    }

    $redirect = $_SERVER['HTTP_REFERER'] ?? '../public/index.php';
    header("Location: $redirect");
    exit;
?>