<?php
use DonatelloZa\RakePlus\RakePlus;

class Keyword
{
    public static function getKeywords($text){
        return RakePlus::create($text)->keywords();
    }
}