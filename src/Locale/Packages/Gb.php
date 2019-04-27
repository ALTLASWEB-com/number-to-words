<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 27.04.2019
 * Time: 20:52
 */

namespace NumberToWords\Locale\Packages;


use Illuminate\Support\Collection;
use NumberToWords\Locale\LocaleTransformer;

class Gb extends LocalePackageAbstract
{
    const LOCALE_WORDS = [
        'minus' => 'minus',
        'zero' => 'zero',
        'ten' => [
            ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
            ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
        ],
        'teen' => [
            'ten',
            'eleven',
            'twelve',
            'thirteen',
            'fourteen',
            'fifteen',
            'sixteen',
            'seventeen',
            'eighteen',
            'nineteen',
        ],
        'tens' => [
            2 => 'twenty',
            'thirty',
            'forty',
            'fifty',
            'sixty',
            'seventy',
            'eighty',
            'ninety',
        ],
        'hundreds' => [
            '',
            'hundred',
            'two hundred',
            'three hundred',
            'four hundred',
            'five hundred',
            'six hundred',
            'seven hundred',
            'eight hundred',
            'nine hundreds',
        ],
        'mega' => [
            [3 => LocaleTransformer::FEMALE],
            [3 => LocaleTransformer::MALE],
            ['thousand', 'thousand', 'thousand', LocaleTransformer::FEMALE],
            ['million', 'million', 'million', LocaleTransformer::MALE],
            ['billion', 'billion', 'billion', LocaleTransformer::MALE],
            ['trillion', 'trillion', 'trillion', LocaleTransformer::MALE],
            ['quadrillion', 'quadrillion', 'quadrillion', LocaleTransformer::MALE],
            ['sextillion', 'sextillons', 'sextillion', LocaleTransformer::MALE],
        ],
    ];

    public function getWords(): Collection
    {
        return new Collection(self::LOCALE_WORDS);
    }
}