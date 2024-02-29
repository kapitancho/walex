<?php

use Walnut\Lib\Walex\Lexer;
use Walnut\Lib\Walex\Pattern;
use Walnut\Lib\Walex\Rule;
use Walnut\Lib\Walex\SpecialRuleTag;

require_once __DIR__ . '/vendor/autoload.php';

$lexer = new Lexer([
    new Rule(new Pattern( '(0|(\-?[1-9][0-9]*))\.[0-9]+'), 'real_number'),
    new Rule(new Pattern( '[\+\-\*\/]'), 'arithmetic_op'),
    new Rule(new Pattern('[\n]'), SpecialRuleTag::newLine),
    new Rule(new Pattern('.'), SpecialRuleTag::skip)
]);

foreach($lexer->getTokensFor("3.141 + 42 * \n -5.6 / 7.8") as $token) {
    echo $token, PHP_EOL;
}
