<?php

require_once "conexao.php";
require_once "funcoes.php";

$dados = json_decode(file_get_contents('php://input'), true);

$email = $dados['email'] ?? false;
$senha = $dados['senha'] ?? false;
$lembrar = $dados['lembrar'];

$retorno = [];
if (!empty($email) && !empty($senha)) {
    
    $logado = logar($conn, $email, $senha, $lembrar);

    $ultima_tentativa = getUltimoAcesso($conn, $email);

    if (!empty($ultima_tentativa)) {
        $data_ultima = strtotime($ultima_tentativa['data_hora']);
        $data_atual = strtotime(date("Y-m-d H:i:s"));
        $minutos = floor(($data_atual - $data_ultima) / 60);

        if ($ultima_tentativa['tentativas'] > TENTATIVAS_LOGIN_FAIL) {
            $retorno = [
                'status' => 'danger',
                'msg' => 'Seu login está bloqueado. Tente novamente em '
                    . (MINUTOS_LIMITE_LOGIN - $minutos) . " minutos."
            ];
            $logado = false;
            sair();
        } else {
            if ($logado == true) {        
                $retorno = [
                    'status' => 'success',
                    'msg' => 'Bem vindo ' . $_SESSION['usuario']['nome'] . '!'
                ];
            } else {
                $retorno = [
                    'status' => 'warning',
                    'msg' => "E-mail e/ou senha inválidos!"
                ];
            }
        }
    } else {
        $retorno = [
            'status' => 'success',
            'msg' => 'Bem vindo ' . $_SESSION['usuario']['nome'] . '!'
        ];
    }
} else {
    $retorno = [
        'status' => 'danger',
        'msg' => "Informe e-mail e senha para acessar!"
    ];
}

header("Content-type: application/json");
echo json_encode($retorno);