<?php


function getUserPosts($user_id) {
    $ch= curl_init();

$url = 'https://jsonplaceholder.typicode.com/posts?userId='.$user_id;

 curl_setopt($ch, CURLOPT_URL, $url);

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

 $res = curl_exec($ch);

curl_close($ch);
    
return json_decode($res,true);

}


/*
function getUserPostsById($user_id){
    $posts = getUserPosts();
    foreach ($posts as $post){
        if($post['user_id'] == $user_id){
            return $post;
        }
    }
    return null;
    
  
    
}
  */