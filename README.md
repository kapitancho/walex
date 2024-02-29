# Walex
A lightweight lexer, written in PHP

## Installation

To install the latest version, use the following command:

```bash
$ composer require kapitancho/walex
```

## Usage

Walex is the lexer of the Walnut language. Here is an example based on real code:

```php
<?php

use Walnut\Lib\Walex\Lexer;
use Walnut\Lib\Walex\Pattern;
use Walnut\Lib\Walex\Rule;
use Walnut\Lib\Walex\SpecialRuleTag;

$lexer = new Lexer([
    new Rule(new Pattern('(0|(\-?[1-9][0-9]*))\.[0-9]+'), 'real_number'),
    new Rule(new Pattern('[\+\-\*\/]'), 'arithmetic_op'),
    new Rule(new Pattern('[\n]'), SpecialRuleTag::newLine),
    new Rule(new Pattern('.'), SpecialRuleTag::skip)
]);

foreach($lexer->getTokensFor("3.141 + 42 * \n -5.6 / 7.8") as $token) {
    echo $token, PHP_EOL;
}
# Output:
# Token at line: 1, column: 1, offset: 0 of type real_number matching 3.141
# Token at line: 1, column: 7, offset: 6 of type arithmetic_op matching +
# Token at line: 1, column: 12, offset: 11 of type arithmetic_op matching *
# Token at line: 2, column: 2, offset: 15 of type real_number matching -5.6
# Token at line: 2, column: 7, offset: 20 of type arithmetic_op matching /
# Token at line: 2, column: 9, offset: 22 of type real_number matching 7.8
# Token at line: 2, column: 12, offset: 25 of type eof matching
?>
```

