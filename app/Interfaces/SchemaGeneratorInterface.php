<?php

namespace App\Interfaces;

interface SchemaGeneratorInterface
{
    public function generateSchema(): array;

    public function toJson(): string;

    public function toScript(): string;
}
