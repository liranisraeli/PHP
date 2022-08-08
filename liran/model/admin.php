<?php

class Admin extends User {
    private $posts_topic_id;

    public function __construct($posts_topic_id, $name, $email, $active) {
        parent::__construct($name, $email, $active);
        $this->posts_topic_id = $posts_topic_id;
    }

    public function get_posts() {
        $this->database->select("...");
        //db->query("SELECT * FROM posts WHERE topic_id='$this->posts_topic_id'")
    }
}

// $admin = new Admin(...);
// $admin->create_post($post)...