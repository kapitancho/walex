<?php

namespace Walnut\Lib\Walex;

use Generator;
use UnexpectedValueException;

final readonly class Lexer {
    /**
     * @param array<Rule> $rules
     */
    public function __construct(
        private array $rules
    ) {}

    /**
     * @param string $source
     * @return Generator<Token>
     */
    public function getTokensFor(string $source): Generator {
        $sourceLength = strlen($source);
        $currentPosition = new SourcePosition(0, 1, 1);

        $matches = null;
        while($currentPosition->offset < $sourceLength) {
            foreach($this->rules as $rule) {
                if(preg_match(
                    $rule->pattern->value,
                    $source,
                    $matches,
                    0,
                    $currentPosition->offset
                )) {
                    $patternMatch = new PatternMatch(... $matches);
                    $token = new Token($rule, $patternMatch, $currentPosition);
                    if (is_string($rule->tag)) {
                        yield $token;
                    }

                    $matchedLength = strlen($patternMatch->text);
                    $currentPosition = $currentPosition->move($matchedLength);
                    if ($rule->tag === SpecialRuleTag::newLine) {
                        $currentPosition = $currentPosition->goToNextLine();
                    }
                    continue 2;
                }
            }
            throw new UnexpectedValueException(
                sprintf("No rule matches input at position | %s |",
                    $currentPosition)
            );
        }
        yield new Token(
            new Rule(
                new Pattern('.'),
                SpecialRuleTag::eof
            ),
            new PatternMatch(''),
            $currentPosition
        );
    }
}