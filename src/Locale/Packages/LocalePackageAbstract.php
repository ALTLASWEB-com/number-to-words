<?php
/**
 * Created by PhpStorm.
 * User: V.A.I
 * Date: 27.04.2019
 * Time: 1:43
 */

namespace NumberToWords\Locale\Packages;


use Illuminate\Support\Collection;

abstract class LocalePackageAbstract
{
    abstract public function getWords(): Collection;
}