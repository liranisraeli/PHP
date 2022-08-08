<?php

class Master extends User {

    public function __construct($name, $email, $active) {
        parent::__construct($name, $email, $active)
    }

    public function get_posts() {
        $this->database->select('posts', '*');
    }
}