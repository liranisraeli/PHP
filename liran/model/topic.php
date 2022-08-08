<?php

class Topic {
    private $id; // PK AI
    private $name; // Unique name

    public function __construct($name) {
        $this->name = $name;
    }
}

// 1  'DJ'
// 2  'Rabbi'
// 3  'Drinks' 