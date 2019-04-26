<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 26.04.2019
 * Time: 23:06
 */

namespace NumberToWords;

use NumberToWords\Exceptions\LocaleWordsUndefinedException;
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

    public function __construct(string $locale)
    {
        $this->locale = $locale;
        $this->localeWords = new Collection();
    }

    /**
     * @param $number
     * @return string
     * @throws LocaleWordsUndefinedException
     */
    public function transform($number): string
    {
        if ($this->localeWords->isEmpty()) {
            if (!$localeWords = $this->getFromLocalePackage()) {
                throw new LocaleWordsUndefinedException(
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
