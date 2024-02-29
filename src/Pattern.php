<?php

namespace Walnut\Lib\Walex;

use InvalidArgumentException;

final readonly class Pattern {

    public string $value;
    public function __construct(
        string $value
    ) {
        $this->value = "/$value/As";
        if (@preg_match($this->value, null) === false) {
            throw new InvalidArgumentException(
                sprintf("The pattern | %s | is not valid.", $value)
            );
        }
    }

    //public function matches
}