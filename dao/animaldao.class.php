<?php
require "conexaobanco.class.php";
class AnimalDAO
{ //DAO - Data Access Object - Acesso aos dados do objeto

    private $conexao = null;

    public function __construct()
    {
        $this->conexao = ConexaoBanco::getInstance();
    }

    public function __destruct()
    {
    }

    public function cadastrarAnimal($animal)
    {
        try {

            $statement = $this->conexao->prepare("insert into animal(idAnimal,nome,peso,anoNascimento,especie,sexo)values(null,?,?,?,?,?)");

            $statement->bindValue(1, $animal->nome);
            $statement->bindValue(2, $animal->peso);
            $statement->bindValue(3, $animal->anoNascimento);
            $statement->bindValue(4, $animal->especie);
            $statement->bindValue(5, $animal->sexo);


            $statement->execute();

        } catch(PDOException $error) {
            echo "Erro ao cadastrar o Animal!".$error;
        }
    }

    public function buscarAnimais()
    {
        try {
            $statement = $this->conexao->query("select * from animal");
            $array = $statement->fetchAll(PDO::FETCH_CLASS, "Animal");
            return $array;
        } catch(PDOException $error) {
            echo "A aguia não achou o Animal!".$error;
        }
    }

    public function deletarAnimal($idAnimal)
    {
        try {
            $statement = $this->conexao->prepare("delete from animal where idanimal = ?");

            $statement->bindValue(1, $idAnimal);

            $statement->execute();

        } catch(PDOException $error) {
            echo "Ocorreu um erro em excluir este animal!".$error;
        }
    }

    public function filtrarAnimal($filtro, $pesquisa)
    {
        try {

            $query =  "";
            switch($filtro) {
             case "codigo": $query = "where idAnimal like '%{$pesquisa}%'";
             break;
             case "nome":  $query = "where nome like '%{$pesquisa}%'";
             break;
             case "peso":  $query = "where peso like '%{$pesquisa}%'";
             break;
             case "anoNascimento":  $query = "where anoNascimento like '%{$pesquisa}%'";
             break;
             case "especie":  $query = "where especie like '%{$pesquisa}%'";
             break;
             case "sexo":  $query = "where sexo like '%{$pesquisa}%'";
             break;
             case "todos": $query = "";
             break;
             case "default": $query = "";
             break;
            }

            $statement = $this->conexao->query("select * from animal {$query}");
            $array = $statement->fetchAll(PDO::FETCH_CLASS, "Animal");
            return $array;

        } catch(PDOException $error) {
            echo "A aguia não achou este animal!".$error;
        }
    }

    public function alterarAnimal($animal)
    {
        try {
            $statement = $this->conexao->prepare("update animal set nome = ?, peso = ?, anoNascimento = ?, especie = ?, sexo = ? where idAnimal = ?");

            $statement->bindValue(1, $animal->nome);
            $statement->bindValue(2, $animal->peso);
            $statement->bindValue(3, $animal->anoNascimento);
            $statement->bindValue(4, $animal->especie);
            $statement->bindValue(5, $animal->sexo);
            $statement->bindValue(6, $animal->idAnimal);

            $statement->execute();

        } catch(PDOException $error) {
            echo "Erro ao alterar!".$error;
        }
    }
}
