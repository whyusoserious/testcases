<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="<?= $_SERVER['SCRIPT_NAME'] ?>">
        <p>Поиск комментариев по тексту: 
            <input type="text" name="search" value="<?php echo (!empty($_GET['search'])) ? $_GET['search'] : ""?>"> 
            <input type="submit" name = "submit" value="Поиск">
        </p>
        <hr>
    </form>
    <?php
    $server = 'localhost';
    $login = 'mysql';
    $pass = '';
    $dbname="commentDB";
    
    $conn = new mysqli($server, $login, $pass, $dbname);
    if ($conn->connect_error){
        if ($conn->connect_error){
            die("Ошибка подключения: " . $conn->connect_error);
        }
    }
    // var_dump($_REQUEST['search']);
    $input = $_GET['search'];

    if (strlen($input) > 2)
    {
        $sql = "SELECT comment.name, comment.body FROM comment WHERE comment.body LIKE '%$input%'";

        $result = $conn->query($sql);
        //unset($_REQUEST['search']);
        if($result ->num_rows>0)
        {
            while ($row = $result->fetch_assoc()){
                echo "<p>". $row['name']."</p> <br>
                      <p> ". $row['body']."</p> <hr>";
            }
        }
        else
        {
            echo "Комментарии с таким текстом не найдены";
        }
    }
    else
    {
        echo "Введите минимум 3 символа!";
        //unset($_REQUEST['search']);
    }
    
    ?>
</body>
</html>