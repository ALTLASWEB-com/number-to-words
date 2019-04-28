# NumberToWords

## Installation
  
  Add package to your composer.json
  ```
  {
      "require": {
          "alex-vai/number-to-words": "dev-master"
      }
  }
  ```
## How to use number transformer
  
Using preset locales
```php
use NumberToWords\NumberToWords;

$numberToWords = new NumberToWords($locale = 'ru');
$numberTransformer = $numberToWords->transform(1458);
```
  
Or use your own locale words
```php
use Illuminate\Support\Collection;
use NumberToWords\Locale\LocaleTransformer;
use NumberToWords\NumberToWords;
  
$localeWords = [
    'minus' => 'minus',
    'zero' => 'zero',
    'ten' => [
        ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
        ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'],
    ],
    'teen' => [
        'ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen',
    ],
    'tens' => [
        2 => 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety',
    ],
    'hundreds' => [
        '', 'hundred', 'two hundred', 'three hundred', 'four hundred', 'five hundred', 'six hundred', 'seven hundred', 'eight hundred', 'nine hundreds',
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

$numberToWords = new NumberToWords($locale = 'gb');
$numberToWords->setLocaleWords(new Collection($localeWords));
$numberTransformer = $numberToWords->transform(1458);
```