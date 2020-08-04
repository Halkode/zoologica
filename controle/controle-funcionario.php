<?php
session_start();
include '../modelo/funcionario.class.php';
include '../dao/funcionariodao.class.php';
include "../util/padronizacao.class.php";
include "../util/validacao.class.php";

$erros = [];

if(!Validacao::validarNome($_POST['nome'])) {
    $erros[] = "Nome inválido!";
}

if(!Validacao::validarAno($_POST['anoNascimento'])) {
    $erros[] = "Ano inválido!";
}

if(!Validacao::validarSexoFuncionario($_POST['sexo'])) {
    $erros[] = "Sexo inválido!";
}

if(!Validacao::validarCargo($_POST['cargo'])) {
    $erros[] = "Cargo inválido!";
}

if(!Validacao::validarEmail($_POST['email'])) {
    $erros[] = "Email inválido!";
}

if(count($erros) == 0) {

$funcionario = new Funcionario;

$funcionario->nome = Padronizacao::padronizarLetrasMaiusculaseMinusculas($_POST['nome']);
$funcionario->email = $_POST['email'];
$funcionario->anoNascimento = $_POST['anoNascimento'];
$funcionario->sexo = $_POST['sexo'];
$funcionario->cargo = Padronizacao::padronizarLetrasMaiusculaseMinusculas($_POST['cargo']);

$funcionarioDAO = new FuncionarioDAO ;
$funcionarioDAO ->cadastrarFuncionario($funcionario);
$_SESSION['mensagem'] = "Cadastro efetuado com sucesso";
$_SESSION['funcionario'] = serialize($funcionario);

header("location:../adm/buscar-funcionario.php");

} else {

	$_SESSION['post'] = serialize($_POST);
    $_SESSION['erros'] = serialize($erros);
    header("location:../adm/cadastro-funcionario.php");

}
