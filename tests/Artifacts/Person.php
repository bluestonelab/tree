<?php

namespace Tests\Artifacts;

class Person
{
    public function __construct(
        public int $id,
        public ?int $parentId,
        public string $username
    ) {
    }
}
