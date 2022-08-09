<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Include cURL
    require_once './posts.php';

    // Create DB connection
    require_once './database.php';
    $database = new DataBase("localhost", "root", "", "test");
    echo $database->connect();

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
    
     //05 select all the active users where active = 'true'
    $users = $database->select('users',"*","users.active = 'true';");
    

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

   //06
    
    $user_last_post_by_birthDate = $database->select('users,posts',"*","posts.user_id = users.id AND (MONTH(users.birthDate) = MONTH(CURRENT_DATE()) AND YEAR(users.birthDate) = YEAR(CURRENT_DATE()))","posts.created_date DESC LIMIT 1;");

    $posts_grouped_by_date_hour = $database->select('posts','DATE(posts.created_date) as post_date, HOUR(posts.created_date) as post_time, COUNT(*) as count', null, null, 'DATE(posts.created_date), HOUR(posts.created_date);');
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <style>
    table {
        border-collapse: collapse;
        width: 100%;
        }
        
        td, th {
            border: 1px solid;
            text-align: left;
        }
        
        .user-row {
            background-color: #dedede;
        }
    </style>
</head>

<body>
    
    <p>Post by user that has birthday this month:</p>
    <pre><code>id: <?= $user_last_post_by_birthDate[0]['id']; ?><br>title: <?= $user_last_post_by_birthDate[0]['title']; ?><br>body: <?= $user_last_post_by_birthDate[0]['body']; ?></code></pre>
    <br>
    
    <!-- GET GROUPED POSTS BY DATE-HOUR -->
    <!--
    SQL: SELECT DATE(posts.created_date) as post_date, HOUR(posts.created_date) as post_time, COUNT(*) as count FROM posts GROUP BY DATE(posts.created_date), HOUR(posts.created_date);
    -->
    <p>Posts grouped by same date & hour:</p>
    <table>
        <thead>
            <tr>
                <th>Date:</th>
                <th>Hour:</th>
                <th>Count:</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($posts_grouped_by_date_hour as $key=>$row) {
                echo '<tr>';
                    echo '<td>'.$row['post_date'].'</td>';
                    echo '<td>'.$row['post_time'].'</td>';
                    echo '<td>'.$row['count'].'</td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    <br><br>

    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            //print_r($users);
            
            //print_r($jsonplaceholder_users);
            
            foreach($users as $key=>$user){
                    echo '<tr class="user-row">';
                        echo '<td>'.$user['id'].'</td>';
                        echo '<td><img src="./avatar.jpg" style="width: 30px;"></td>';
                        echo '<td>'.$user['name'].'</td>';
                        echo '<td>'.$user['email'].'</td>';
                        echo '<td>'.$user['active'].'</td>';
                    echo '</tr>';
           
                    $user_posts = getUserPosts($user['id']);
                    //$user_posts = getUserPostsById($user['id']);
                
                   
                        foreach($user_posts as $key=>$post) {
                             echo '<tr>';
                         echo '<td colspan="5">';
                            echo '<pre><code>id: '.$post['id'].'<br>title: '.$post['title'].'<br>body: '.$post['body'].'</code></pre>';
                        echo '</td>';
                    echo '</tr>';   
                        }
                
                }
            ?>
        </tbody>
    </table>
    
    <script>
    </script>

</body>

</html>
