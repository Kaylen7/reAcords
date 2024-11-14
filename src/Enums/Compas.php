<?php

namespace Src\Enums;

enum Compas:string{
    case DOSQUATRE = '2/4';
    case TRESQUATRE = '3/4';
    case QUATREQUATRE = '4/4';
    case SISVUIT = '6/8';
    case DOTZEVUIT = '12/8';
    case CINCSET = '5/7';
    case SETVUIT = '7/8';

    public static function fromValue(string $string){
        foreach(self::cases() as $case){
            if($case->value === $string){
                return $case;
            }
        }
        throw new \InvalidArgumentException("No és possible fer servir aquest compàs");
    }

    public static function showCases(): array{
        $cases = [];
        foreach(self::cases() as $case){
            array_push($cases, $case->value);
        }
        return $cases;
    }
}