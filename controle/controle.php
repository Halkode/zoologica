<?php
session_start();
include '../modelo/animal.class.php';
include '../dao/animaldao.class.php';
include "../util/padronizacao.class.php";
include "../util/validacao.class.php";

$erros = [];

if(!Validacao::validarNome($_POST['nome'])) {
    $erros[] = "Nome inválido!";
}

if(!Validacao::validarSexoAnimal($_POST['sexo'])) {
    $erros[] = "Sexo inválido!";
}

if(!Validacao::validarPesoAnimal($_POST['peso'])) {
    $erros[] = "Peso inválido!";
}

if(!Validacao::validarAno($_POST['anoNascimento'])) {
    $erros[] = "Ano inválido!";
}

if(!Validacao::validarEspecie($_POST['animal'])) {
    $erros[] = "Especie inválida";
}

if(count($erros) == 0) {

	$animal = new Animal;

	$animal->nome = Padronizacao::padronizarLetrasMaiusculasEMinusculas($_POST['nome']);
	$animal->peso = $_POST['peso'];
	$animal->anoNascimento = $_POST['anoNascimento'];
	$animal->especie = Padronizacao::padronizarLetrasMaiusculasEMinusculas($_POST['animal']);
	$animal->sexo = $_POST['sexo'];

	$animalDAO = new AnimalDAO;
	$animalDAO->cadastrarAnimal($animal);
	$_SESSION['mensagem'] = "Cadastro efetuado com sucesso";
	$_SESSION['animal'] = serialize($animal);
	header("location:../adm/buscar-animal.php");

} else {

	$_SESSION['post'] = serialize($_POST);
    $_SESSION['erros'] = serialize($erros);
    header("location:../adm/cadastro-animal.php");

}
