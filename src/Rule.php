<?php

namespace Walnut\Lib\Walex;

final readonly class Rule {
    public function __construct(
        public Pattern $pattern,
        public string|SpecialRuleTag $tag
    ) {}

    public function __toString(): string {
        return is_string($this->tag) ? $this->tag : $this->tag->name;
    }
}