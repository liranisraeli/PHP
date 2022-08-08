<?php

class Post {
    private $id; // PK
    private $user_id; // FK ==> users
    private $topic_id;
    private $title;
    private $description;
    private $created_at;
    private $active;

    public function __construct($id, $user_id, $topic_id, $title, $description, $created_at, $active) {
        $this->id = $id;
        ...
    }

    function get_id() {
        return $this->id;
    }
}