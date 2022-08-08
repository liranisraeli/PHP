<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Create DB connection
    require_once './database.php';
    $newData = new DataBase("localhost", "root", "", "test");
    echo $newData->connect() . "<br>";

    // Create image file from URL
    $url = 'https://cdn2.vectorstock.com/i/1000x1000/23/81/default-avatar-profile-icon-vector-18942381.jpg';

    // option 1
    // $ch = curl_init($url);
    // $fp = fopen('assets/avatar.jpg', 'wb');
    // curl_setopt($ch, CURLOPT_FILE, $fp);
    // curl_setopt($ch, CURLOPT_HEADER, 0);
    // curl_exec($ch);
    // curl_close($ch);
    // fclose($fp);

    // option 2
    $in = fopen($url, "rb");
    $out = fopen('avatar.jpg', "wb");
    while ($chunk = fread($in, 8192)) {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);

    //check insert
    //users
    /*
    $ins=array('1',"Leanne Graham","Sincere@april.biz",'true');
    echo $newData->insert('users',$ins,'id,name,email,active');
    
    $ins=array('2',"Ervin Howell","Shanna@melissa.tv",'true');
    echo $newData->insert('users',$ins,'id,name,email,active');
    
    $ins=array('3',"Clementine Bauch","Nathan@yesenia.net",'false');
    echo $newData->insert('users',$ins,'id,name,email,active');
    */
    
      //posts
    /*
    $ins=array('2','1',"qui est esse","est rerum tempore vitae\nsequi sint nihil reprehenderit dolor beatae ea dolores neque\nfugiat blanditiis voluptate porro vel nihil molestiae ut reiciendis\nqui aperiam non debitis possimus qui neque nisi nulla","2022-08-01 10:00:01", 'true');
    echo $newData->insert('posts',$ins,'id,user_id,title,body,created_date,active_post');
    
    
    $ins=array('11','2',"et ea vero quia laudantium autem","delectus reiciendis molestiae occaecati non minima eveniet qui voluptatibus\naccusamus in eum beatae sit\nvel qui neque voluptates ut commodi qui incidunt\nut animi commodi","2022-07-31 11:03:01", 'true');
    echo $newData->insert('posts',$ins,'id,user_id,title,body,created_date,active_post');
    
    $ins=array('21','3',"asperiores ea ipsam voluptatibus modi minima quia sint","repellat aliquid praesentium dolorem quo\nsed totam minus non itaque\nnihil labore molestiae sunt dolor eveniet hic recusandae veniam\ntempora et tenetur expedita sunt","2022-07-05 12:05:01", 'true');
    echo $newData->insert('posts',$ins,'id,user_id,title,body,created_date,active_post');
    
    $ins=array('22','3',"dolor sint quo a velit explicabo quia nam","eos qui et ipsum ipsam suscipit aut\nsed omnis non odio\nexpedita earum mollitia molestiae aut atque rem suscipit\nnam impedit esse","2021-09-09 14:00:00", 'true');
    echo $newData->insert('posts',$ins,'id,user_id,title,body,created_date,active_post');
    */
    
     //05 select all the active users + their posts
    /*
    
    echo $newData->select('users, posts',"*","users.id = posts.user_id AND users.active = 'true';");
    
    */
    

    /*
    $ins=array('4',"Liran","liran@april.biz",'false');
    echo $newData->insert('users',$ins,'id,name,email,active');
    */
    
   //check update
    /*
   $upd=array('name'=>'shir','email'=>'shir@gmail.com','active'=>'true');
   echo $newData->update('users',$upd,array('id=4'));
    */
    
    //check delete
    /*
    echo $newData->delete('users', 'id = 4;');
    */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>
