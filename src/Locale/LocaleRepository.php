<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 27.04.2019
 * Time: 0:46
 */

namespace NumberToWords\Locale;


use Illuminate\Support\Collection;
use NumberToWords\Exceptions\NumberToWordsException;

class LocaleRepository
{
    /** @var Collection */
    private $localeWords;

    public function __construct(Collection $localeWords)
    {
        $this->localeWords = $localeWords;
    }

    /**
     * @return array
     * @throws NumberToWordsException
     */
    public function getTenWords(): array
    {
        return $this->getLocaleWords('ten');
    }

    /**
     * @return array
     * @throws NumberToWordsException
     */
    public function getHundredWords(): array
    {
        return $this->getLocaleWords('hundreds');
    }

    /**
     * @return array
     * @throws NumberToWordsException
     */
    public function getTeenWords(): array
    {
        return $this->getLocaleWords('teen');
    }

    /**
     * @return array
     * @throws NumberToWordsException
     */
    public function getTensWords(): array
    {
        return $this->getLocaleWords('tens');
    }

    /**
     * @return string
     * @throws NumberToWordsException
     */
    public function getMinusWord(): string
    {
        return $this->getLocaleWords('minus');
    }

    /**
     * @return array
     * @throws NumberToWordsException
     */
    public function getMega(): array
    {
        return $this->getLocaleWords('mega');
    }

    /**
     * @return string
     * @throws NumberToWordsException
     */
    public function getZeroWord(): string
    {
        return $this->getLocaleWords('zero');
    }

    /**
     * @param string $param
     * @return mixed
     * @throws NumberToWordsException
     */
    protected function getLocaleWords(string $param)
    {
        if (!$value = $this->localeWords->get($param)) {
            throw new NumberToWordsException(
                sprintf("The value of word(s) is not found for the parameter '%s'", $param)
            );
        }
        return $value;
    }
}