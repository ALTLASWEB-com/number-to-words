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

class By extends LocalePackageAbstract
{
    const LOCALE_WORDS = [
        'minus' => 'мінус',
        'zero' => 'нуль',
        'ten' => [
            ['', 'адзін', 'два', 'тры', 'чатыры', 'пяць', 'шэсць', 'сем', 'восем', 'дзевяць'],
            ['', 'адна', 'дзве', 'тры', 'чатыры', 'пяць', 'шэсць', 'сем', 'восем', 'дзевяць'],
        ],
        'teen' => [
            'дзесяць',
            'адзінаццаць',
            'дванаццаць',
            'трынаццаць',
            'чатырнаццаць',
            'пятнаццаць',
            'шаснаццаць',
            'семнаццаць',
            'васемнаццаць',
            'дзевятнаццаць',
        ],
        'tens' => [
            2 => 'дваццаць',
            'трыццаць',
            'сорак',
            'пяцьдзесят',
            'шэсцьдзесят',
            'семдзесят',
            'восемдзесят',
            'дзевяноста',
        ],
        'hundreds' => [
            '',
            'сто',
            'дзвесце',
            'трыста',
            'чатырыста',
            'пяцьсот',
            'шэсцьсот',
            'семсот',
            'восемсот',
            'дзевяцьсот',
        ],
        'mega' => [
            [3 => LocaleTransformer::FEMALE],
            [3 => LocaleTransformer::MALE],
            [ 'тысяча', 'тысячы', 'тысяч', LocaleTransformer::FEMALE],
            [ 'мільён', 'мільёна', 'мільёнаў', LocaleTransformer::MALE],
            [ 'мільярд', 'мільярды', 'мільярдаў', LocaleTransformer::MALE],
            [ 'трыльён', 'трыльёны', 'трыльёнаў', LocaleTransformer::MALE],
            [ 'квадрыльён', 'квадрыльёна', 'квадрыльёнаў', LocaleTransformer::MALE],
            [ 'секстиллион', 'секстильоны', 'секстиллионов', LocaleTransformer::MALE],
        ]
    ];

    public function getWords(): Collection
    {
        return new Collection(self::LOCALE_WORDS);
    }
}