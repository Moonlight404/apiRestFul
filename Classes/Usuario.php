<?php

namespace Classes;

require 'Conexao.php';
use Classes\Conexao;

class Usuario {
    
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::getConexao();
    }
    
    public function listar() {
        $sql = "select * from usuario;";       
        $q = $this->conexao->prepare($sql);
        $q->execute();
        return $q;
    }

    public function delete($id){
        $sql = "delete from usuario where codigo = :id;";
        $q = $this->conexao->prepare($sql);
        $q->bindParam(':id', $id);
        $q->execute();
        return true;
    }

    public function update($id, $nome, $email, $login){
        $sql = "UPDATE usuario SET nome= :nome, email= :email,login= :login WHERE codigo= :id";
        $q = $this->conexao->prepare($sql);
        $q->bindParam(':nome', $nome);
        $q->bindParam(':email', $email);
        $q->bindParam(':login', $login);
        $q->bindParam(':id', $id);
        $q->execute();
        return true;
    }
    
    public function inserir($nome, $email, $login, $senha) {
        $sql = "insert into usuario (nome, email, login, senha) values (?, ?, ?, ?);";
        $q = $this->conexao->prepare($sql);
        $senha = md5($senha);
        $q->bindParam(1, $nome);
        $q->bindParam(2, $email);
        $q->bindParam(3, $login);
        $q->bindParam(4, $senha);
        $q->execute();
        return true;
    }
    
}

?>