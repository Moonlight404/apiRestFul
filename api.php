<?php
//Dependências
require './Classes/Usuario.php';

use Classes\Usuario;

/* API RESTFul em PHP puro */
//Informa para o cliente que será retornado JSON
header('Content-type: application/json');

//Captura os parâmetros
$param = filter_input_array(INPUT_GET, FILTER_DEFAULT);

//Captura o método de requisição
$method = $_SERVER ['REQUEST_METHOD'];

//Captura os dados enviados no body
$body = file_get_contents('php://input');

//Function message
function publicMessage($status, $message){
    $json = array(
        "sucess" => $status,
        "message" => $message
    );
    return json_encode($json);
}

if ($method == "GET") {
    if (isset($param ['codusu'])) {
        //Retorno 1 usuário
    } else {
        $usu = new Usuario();
        $resultado = $usu->listar();
        $usuarios = [];
        foreach ($resultado as $usuario) {
            unset($usuario[0]);
            unset($usuario[1]);
            unset($usuario[2]);
            unset($usuario[3]);
            unset($usuario[4]);
            unset($usuario['senha']);
            $usuarios [] = $usuario;
        }
        echo json_encode($usuarios);
    }   
} else if ($method == "POST") {
    $usuario = json_decode($body);
    $usu = new Usuario();    
    $sucesso = $usu->inserir($usuario->nome, $usuario->email, $usuario->login, $usuario->senha);
    if($sucesso){
        echo publicMessage(true, "O usuário foi cadastrado com sucesso!");
    } else{
        echo publicMessage(false, "O usuário não foi cadastrado com sucesso!");
    }
} else if ($method == "PUT") {
    $usuario = json_decode($body);
    $usu = new Usuario();
    $sucesso = $usu->update($usuario->codigo, $usuario->nome, $usuario->email, $usuario->login);
    if($sucesso){
        echo publicMessage(true, "O usuário foi atualizado com sucesso!");
    } else{
        echo publicMessage(false, "O usuário não foi atualizado com sucesso!");
    }
} else if ($method == "DELETE") {
    if(isset($param['codigo'])){
        $usu = new Usuario();
        $sucesso = $usu->delete($param['codigo']);
        if($sucesso){
            echo publicMessage(true, "O usuário foi deletado com sucesso!");
        } else{
            echo publicMessage(false, "O usuário não foi deletado com sucesso!");
        }
    }
}
?>