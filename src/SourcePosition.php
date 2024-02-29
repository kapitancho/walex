<?php

namespace Walnut\Lib\Walex;

final readonly class SourcePosition {
    public function __construct(
        public int $offset,
        public int $line,
        public int $column
    ) {}

    public function move(int $offset): self {
        return new self($this->offset + $offset, $this->line, $this->column + $offset);
    }

    public function goToNextLine(): self {
        return new self($this->offset, $this->line + 1, 1);
    }

    public function __toString(): string {
        return sprintf("line: %d, column: %d, offset: %d",
            $this->line, $this->column, $this->offset
        );

    }
}