<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 27.04.2019
 * Time: 1:33
 */

namespace NumberToWords\Locale\Packages;

use Illuminate\Support\Collection;
use NumberToWords\Locale\LocaleTransformer;

class Ru extends LocalePackageAbstract
{
    const LOCALE_WORDS = [
        'minus' => 'минус',
        'zero' => 'ноль',
        'ten' => [
            ['', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
            ['', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'],
        ],
        'teen' => [
            'десять',
            'одиннадцать',
            'двенадцать',
            'тринадцать',
            'четырнадцать',
            'пятнадцать',
            'шестнадцать',
            'семнадцать',
            'восемнадцать',
            'девятнадцать',
        ],
        'tens' => [
            2 => 'двадцать',
            'тридцать',
            'сорок',
            'пятьдесят',
            'шестьдесят',
            'семьдесят',
            'восемьдесят',
            'девяносто',
        ],
        'hundreds' => [
            '',
            'сто',
            'двести',
            'триста',
            'четыреста',
            'пятьсот',
            'шестьсот',
            'семьсот',
            'восемьсот',
            'девятьсот',
        ],
        'mega' => [
            [3 => LocaleTransformer::FEMALE],
            [3 => LocaleTransformer::MALE],
            ['тысяча', 'тысячи', 'тысяч', LocaleTransformer::FEMALE],
            ['миллион', 'миллиона', 'миллионов', LocaleTransformer::MALE],
            ['миллиард', 'милиарда', 'миллиардов', LocaleTransformer::MALE],
            ['триллион', 'триллионы', 'триллионов', LocaleTransformer::MALE],
            ['квадриллион', 'квадриллиона', 'квадриллионов', LocaleTransformer::MALE],
            ['секстиллион', 'секстильоны', 'секстиллионов', LocaleTransformer::MALE],
        ]
    ];

    public function getWords(): Collection
    {
        return new Collection(self::LOCALE_WORDS);
    }
}