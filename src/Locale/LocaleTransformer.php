<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 26.04.2019
 * Time: 23:14
 */

namespace NumberToWords\Locale;

use NumberToWords\Exceptions\NumberToWordsException;
use Throwable;

/**
 * Class LocaleTransformer
 * @package Eautopay2\Classes\Helpers\Transformers\Number\Locale
 * By kwn/number-to-words
 */
class LocaleTransformer
{
    const MALE   = 0;
    const FEMALE = 1;
    const NEUTER = 2;

    /** @var LocaleRepository */
    private $localeRepository;

    public function __construct(LocaleRepository $localeRepository)
    {
        $this->localeRepository = $localeRepository;
    }

    /**
     * @param int $n
     * @param string $f1
     * @param string $f2
     * @param string $f5
     * @return string
     * @throws NumberToWordsException
     */
    public function morph(int $n, string $f1, string $f2, string $f5): string
    {
        try {
            $n = abs($n) % 100;
            if ($n > 10 && $n < 20) {
                return $f5;
            }
            $n %= 10;
            if ($n > 1 && $n < 5) {
                return $f2;
            }
            if ($n == 1) {
                return $f1;
            }
        } catch (Throwable $e) {
            throw new NumberToWordsException($e);
        }
        return $f5;
    }

    /**
     * @param int $number
     * @return string
     * @throws NumberToWordsException
     */
    public function toWords(int $number): string
    {
        try {
            $ten = $this->localeRepository->getTenWords();
            $tens = $this->localeRepository->getTensWords();
            $teens = $this->localeRepository->getTeenWords();
            $hundred = $this->localeRepository->getHundredWords();
            $mega = $this->localeRepository->getMega();

            if ($number == 0) {
                return $this->localeRepository->getZeroWord();
            }

            $out = [];

            if ($number < 0) {
                $out[] = $this->localeRepository->getMinusWord();
                $number *= -1;
            }

            $megaSize = count($mega);
            $signs = $megaSize * 3;

            // $signs equal quantity of zeros of the biggest number in self::$mega
            // + 3 additional sign (point and two zero)
            list ($unit, $subunit) = explode('.', sprintf("%{$signs}.2F", (float)$number));

            foreach (str_split($unit, 3) as $megaKey => $value) {
                if (!(int)$value) {
                    continue;
                }

                $megaKey = $megaSize - $megaKey - 1;
                $gender = $mega[$megaKey][3];
                list ($i1, $i2, $i3) = array_map('intval', str_split($value));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx

                if ($i2 > 1) { # 20-99
                    $out[] = sprintf('%s %s', $tens[$i2], $ten[$gender][$i3]);
                } else { # 10-19 | 1-9
                    $out[] = ($i2 > 0) ? $teens[$i3] : $ten[$gender][$i3];
                }

                if ($megaKey > 1) {
                    $out[] = $this->morph((int)$value, $mega[$megaKey][0], $mega[$megaKey][1], $mega[$megaKey][2]);
                }
            }
        } catch (Throwable $e) {
            throw new NumberToWordsException($e);
        }
        return trim(preg_replace('/\s+/', ' ', implode(' ', $out)));
    }
}