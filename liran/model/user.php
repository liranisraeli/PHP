<?php

class User {
    // Properites
    private $id;
    private $name;
    private $email;
    private $active;

    protected $database;

    function __construct($database, $name, $email, $active) {
        $this->database = $database;
        $this->name = $name;
        $this->email = $email;
        $this->active = $active;
    }

    function __destruct() {
        echo 'bye bye';
    }

    function get_id() {
        return $this->id;
    }

    // Methods
    function set_name($name) {
        if (!empty($name)) {
            $this->name = $name;
        }
    }

    function create_post($post) {
        $this->database->insert('posts', [$this->id, $post->get_title()...]);
    }

    function get_posts() {
        // db->query('SELECT * FROM posts WHERE user_id='$this->id'')
    }

    function delete_post($post_id) {
        if (isset($post_id) && !empty($post_id)) {
            $query = $db->query("SELECT * FROM posts WHERE post_id = '$post_id'");
            switch(get_class($this)) {
                case 'User':
                    $query.=" AND user_id = '$this->id'"
                    break;

                case 'Admin':
                    $query.=" AND topic_id = '$this->posts_topic_id'"
                    break;

                default:
                case 'Master':
                    break;
            }
            $result => $query->mysqli_fetch();

            if ($result->num_rows() > 0) {
                $this->delete_post_by_id($post_id);
            }
            else {
                echo "Error! post with id: '$post_id' doesn\'t exist!";
                die();
            }
        }
        else {
            echo "Error! post_id is required";
            die();
        }
    }

    function delete_post_by_id($post_id) {
        $query = $db->query("DELETE FROM posts WHERE post_id = '$post_id'");
        $result => $query->mysqli_fetch();
        if ($result) {
            echo 'post has beed deleted!';
        }
        else {
            echo 'post coudln\'t be deleted';
        }
        die();
    }
}