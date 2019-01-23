<?php

require_once "conexao.php";
require_once "funcoes.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_COOKIE['lembrar'])) {
    logar($conn, null, null, null, $_COOKIE['lembrar']);
}

if (empty($_SESSION['usuario'])) {
    header("location: login.php");
}