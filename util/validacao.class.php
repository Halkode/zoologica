<?php
class Validacao
{

    public static function validarNome($valor): bool
    {
        $expressao = "/^[A-zÁù ]{2,50}$/";
        return 	preg_match($expressao, $valor);
    }

    public static function validarSexoFuncionario($valor): bool
    {
        $expressao = "/^(Masculino|Feminino)$/";
        return preg_match($expressao, $valor);
    }

    public static function validarAno($valor): bool
    {
        $expressao = "/^[0-9]{4}$/";
        return  preg_match($expressao, $valor);
    }

      public static function validarSexoAnimal($valor): bool
    {
        $expressao = "/^(Macho|Femea)$/";
        return preg_match($expressao, $valor);
    }

    public static function validarEspecie($valor): bool
    {
        $expressao = "/^(Cachorro|Gato|Tartaruga|Peixe|Passáro)$/";
        return preg_match($expressao, $valor);
    }

    public static function validarCargo($valor): bool
    {
        $expressao = "/^(Faxineiro\(a\)|Atendente|Fiscal|Segurança|Medicina Veterinaria)$/";
        return preg_match($expressao, $valor);
    }

    public static function validarEmail($valor): bool
    {
        $expressao = "/^\w+([.-]?\w+)@\w+([.-]?\w+)(.\w{1,3})+$/";
        return preg_match($expressao, $valor);
    }

    public static function validarPesoAnimal($valor): bool
    {
        $expressao = "/^([0-9]{1,2}(,|.)[0-9]{1,2}|[0-9]{1,2})$/";
        return preg_match($expressao, $valor);
    }



}
