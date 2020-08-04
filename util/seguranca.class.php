<?php
class Seguranca
{
    public static function criptografar($valor): string
    {
        return md5("Projeto".$valor."PHP");
    }

}
