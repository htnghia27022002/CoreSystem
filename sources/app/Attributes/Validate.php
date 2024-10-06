<?php

namespace App\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Validate {

    public function __construct(
        public array $rules = [],
        public array $messages = [],
        public array $attributes = []
    ) {
    }
}