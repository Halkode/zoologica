<?php
require "conexaobanco.class.php";
class FuncionarioDAO
{ //DAO - Data Access Object - Acesso aos dados do objeto

    private $conexao = null;

    public function __construct()
    {
        $this->conexao = ConexaoBanco::getInstance();
    }

    public function __destruct()
    {
    }

    public function cadastrarFuncionario($funcionario)
    {
        try { //PDO - sql injection

            $statement = $this->conexao->prepare("insert into funcionario(idFuncionario,nome,email,anoNascimento,sexo,cargo)values(null,?,?,?,?,?)");

            $statement->bindValue(1, $funcionario->nome);
            $statement->bindValue(2, $funcionario->email);
            $statement->bindValue(3, $funcionario->anoNascimento);
            $statement->bindValue(4, $funcionario->sexo);
            $statement->bindValue(5, $funcionario->cargo);
            

            $statement->execute();

        } catch(PDOException $error) {
            echo "Erro ao cadastrar Funcionário!".$error;
        }
    }

    public function buscarFuncionario()
    {
        try {
            $statement = $this->conexao->query("select * from funcionario");
            $array = $statement->fetchAll(PDO::FETCH_CLASS, "Funcionario");
            return $array;
        } catch(PDOException $error) {
            echo "Não foi encontrado nenhum funcionário!".$error;
        }
    }

    public function demitirFuncionario($idFuncionario)
    {
        try {
            $statement = $this->conexao->prepare("delete from funcionario where idfuncionario = ?");

            $statement->bindValue(1, $idFuncionario);

            $statement->execute();

        } catch(PDOException $error) {
            echo "Ocorreu um erro em demitir este funcionário!".$error;
        }
    }

    public function filtrarFuncionario($filtro, $pesquisa)
    {
        try {

            $query =  "";
            switch($filtro) {
             case "codigo": $query = "where idFuncionario = ".$pesquisa;
             break;
             case "nome":  $query = "where nome like '%{$pesquisa}%'";
             break;
             case "email":  $query = "where peso like '%{$pesquisa}%'";
             break;
             case "anoNascimento":  $query = "where anoNascimento like '%{$pesquisa}%'";
             break;
             case "cargo":  $query = "where especie like '%{$pesquisa}%'";
             break;
             case "sexo":  $query = "where sexo like '%{$pesquisa}%'";
             break;
             case "todos": $query = "";
             break;
             case "default": $query = "";
             break;
            }

            $statement = $this->conexao->query("select * from funcionario {$query}");
            $array = $statement->fetchAll(PDO::FETCH_CLASS, "Funcionario");
            return $array;

        } catch(PDOException $error) {
            echo "Não achamos nem com lupa!".$error;
        }
    }

    public function alterarFuncionario($funcionario)
    {
        try {
            $statement = $this->conexao->prepare("update funcionario set nome = ?, email = ?, anoNascimento = ?, sexo = ?, cargo = ? where idFuncionario = ?");

            $statement->bindValue(1, $funcionario->nome);
            $statement->bindValue(2, $funcionario->email);
            $statement->bindValue(3, $funcionario->anoNascimento);
            $statement->bindValue(4, $funcionario->sexo);
            $statement->bindValue(5, $funcionario->cargo);
            $statement->bindValue(6, $funcionario->idFuncionario);

            $statement->execute();

        } catch(PDOException $error) {
            echo "Erro ao alterar!".$error;
        }
    }
}
