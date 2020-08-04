<?php
/**
 * author: Rafael Pires
 * version: 1.0.0
 *
 */
class Usuario {

  private $idUsuario;
  private $login;
  private $senha;
  private $tipo;

  public function __construct(){}
  public function __destruct(){}

  public function __get($atributo){return $this->$atributo;}
  public function __set($atributo, $valor){$this->$atributo = $valor;}

  public function __toString(){
    return nl2br("login: $this->login senha: $this->senha tipo: $this->tipo");
  }
}
