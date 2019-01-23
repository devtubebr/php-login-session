<?php

require_once "conexao.php";
require_once "funcoes.php";

$email = $_POST['email'] ?? false;
$senha = $_POST['senha'] ?? false;
$lembrar = isset($_POST['lembrar']) ? true : false;

if (!empty($email) && !empty($senha)) {
    
    $logado = logar($conn, $email, $senha, $lembrar);

    if ($logado == true) {        
        header("location: /dashboard.php");
    } else {
        flashMsg('warning', "E-mail e/ou senha inválidos!");
        header("location: /login.php");
    }

} else {
    flashMsg('danger', "Informe e-mail e senha para acessar!");
    header("location: /login.php");
}