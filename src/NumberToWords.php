<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 26.04.2019
 * Time: 23:06
 */

namespace NumberToWords;

use NumberToWords\Exceptions\NumberToWordsException;
use NumberToWords\Locale\Packages\LocalePackageAbstract;
use NumberToWords\Locale\LocaleRepository;
use NumberToWords\Locale\LocaleTransformer;
use Illuminate\Support\Collection;

class NumberToWords
{
    /** @var string */
    private $locale;

    /** @var Collection */
    private $localeWords;

    public function __construct(string $locale = null)
    {
        $this->locale = $locale;
        $this->localeWords = new Collection();
    }

    /**
     * @param $number
     * @return string
     * @throws NumberToWordsException
     */
    public function transform($number): string
    {
        if (!$this->locale && $this->localeWords->isEmpty()) {
            throw new NumberToWordsException('Specify a preset locale or specify a locale words set!');
        }

        if ($this->locale) {
            if (!$localeWords = $this->getFromLocalePackage()) {
                throw new NumberToWordsException(
                    sprintf("The configuration of words for the locale '%s' is not defined!", $this->locale)
                );
            }
            $this->localeWords = new Collection($localeWords);
        }

        $localeTransformer = new LocaleTransformer(new LocaleRepository($this->localeWords));
        return $localeTransformer->toWords($number);
    }

    public function setLocaleWords(Collection $localeWords): NumberToWords
    {
        $this->localeWords = $localeWords;
        return $this;
    }

    protected function getFromLocalePackage(): Collection
    {
        $className = sprintf('\NumberToWords\Locale\Packages\%s', ucfirst(strtolower($this->locale)));
        /** @var LocalePackageAbstract $localePackage */
        $localePackage = new $className();
        return $localePackage->getWords();
    }
}
