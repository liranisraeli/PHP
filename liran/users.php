<?php

//Get request
$ch= curl_init();

$url = 'https://jsonplaceholder.typicode.com/users';

 curl_setopt($ch, CURLOPT_URL, $url);

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

 $res = curl_exec($ch);

    
$jsonplaceholder_users = json_decode($res,true);

    
curl_close($ch);
