<?php

namespace Walnut\Lib\Walex;

final readonly class Token {
    public function __construct(
        public Rule $rule,
        public PatternMatch $patternMatch,
        public SourcePosition $sourcePosition
    ) {}

    public function __toString(): string {
        return sprintf(
            "Token at %s of type %s matching %s",
            $this->sourcePosition,
            $this->rule,
            $this->patternMatch,
        );
    }
}