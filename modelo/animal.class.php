<?php
class Animal
{

  private $idAnimal; 
  private $nome;
  private $peso;
  private $anoNascimento;
  private $especie;
  private $sexo;

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
    return nl2br("Código: $this->idAnimal
                  Nome: $this->nome
                  Peso: $this->peso
                  Ano de Nasciamento: $this->anoNascimento
                  Especie: $this->especie
                  Sexo: $this->sexo");
  }
}

