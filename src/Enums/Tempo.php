<?php

namespace Src\Enums;

enum Tempo:string{
    case LARGO = '1.2';
    case ADAGIO = '0.76';
    case ANDANTE = '0.5';
    case ALLEGRO = '0.36';
    case PRESTO = '0.25';

    public static function getTempo(string $string){
        return match($string){
            'LARGO' => Tempo::LARGO,
            'ADAGIO' => Tempo::ADAGIO,
            'ANDANTE' => Tempo::ANDANTE,
            'ALLEGRO' => Tempo::ALLEGRO,
            'PRESTO' => Tempo::PRESTO,
            default => throw new \InvalidArgumentException("Aquest tempo no està contemplat dins del programa. Tria un altre.")
            };
    }

    public static function showCases(){
        $cases = [];
        foreach(self::cases() as $case){
            array_push($cases, $case->name);
        }
        return $cases;
    }
}