<?php
class Funcionario
{

  private $idFuncionario;
  private $nome;
  private $email;
  private $anoNascimento;
  private $sexo;
  private $cargo;
  

  public function __construct()
  {
  }

  public function __destruct()
  {
  }

  public function __get($atributo)
  {
    return $this->$atributo;
  }

  public function __set($atributo, $valor)
  {
    $this->$atributo = $valor;
  }

  public function __toString()
  {
    return nl2br("Código: $this->idFuncionario
                  Nome: $this->nome
                  Email: $this->email
                  Ano de Nasciamento: $this->anoNascimento
                  Sexo: $this->sexo
                  Cargo: $this->cargo");
  }
}

