<?php

namespace Walnut\Lib\Walex;

final readonly class PatternMatch {
    /** @var string[] */
    public array $matches;
    public function __construct(
        public string $text,
        string ... $matches
    ) {
        $this->matches = $matches;
    }

    public function __toString(): string {
        return $this->text;
    }
}