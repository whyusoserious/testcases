<?php
    //считывание и парсинг json
    require_once '1_createDB/initializeDB.php';
    $jsonPosts = @file_get_contents('https://jsonplaceholder.typicode.com/posts');
    $jsonComments = @file_get_contents('https://jsonplaceholder.typicode.com/comments');

    $dataPosts = json_decode($jsonPosts);
    $dataComments = json_decode($jsonComments);
    
    //создаем массив данных о постах
    $title = array();
    $body = array();
    $userId = array();


     for ($x = 0; $x < count($dataPosts); $x++)
     {
         $userId[] = (int) $dataPosts[$x]->userId;
         $title[] = $dataPosts[$x]->title;
         $body[] = $dataPosts[$x]->body;
     }

    //добавляем значения о постах в бд
    $countComments = 0;
    for ($x = 0; $x < count($dataPosts); $x++)
    {
        $sqlPosts = "INSERT INTO post(userId, title, body) VALUES
                    ('$userId[$x]','$title[$x]','$body[$x]')";
        if ($conn->query($sqlPosts)){
            $countComments++;
        }
        else
            echo $conn->error;
    }
    


    //создаем массив данных о комментариях
    $postId = array();
    $name = array();
    $email = array();
    $body = array();

    for ($x = 0; $x < count($dataComments); $x++)
    {
        $postId[] = (int) $dataComments[$x]->postId;
        $name[] = $dataComments[$x]->name;
        $email[] = $dataComments[$x]->email;
        $body[] = $dataComments[$x]->body;
    }
    
    //добавление данных о комментариях в БД
    $countPosts = 0;
    for ($x = 0; $x < count($dataComments); $x++)
    {
        $sqlComments = "
                        INSERT INTO comment(postId, name, email, body) VALUES
                        ('$postId[$x]','$name[$x]','$email[$x]','$body[$x]')";
                        
        if ($conn->query($sqlComments)){
            $countPosts++;
        }
        else
            echo $conn->error;
    }

     $conn->close();
     echo 'Загружено '.$countPosts." записей и ".$countComments." комментариев";
    
 ?>

 