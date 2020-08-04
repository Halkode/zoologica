<?php
class Padronizacao
{
    public static function padronizarLetrasMaiusculasEMinusculas($valor): string
    {
        return ucwords(strtolower($valor));
    }
}
