<?php


$dbh = new PDO('mysql:host=localhost;dbname=23242_db', "23242", "zhcyvdtp");






?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method=post action="<?php $_SERVER['PHP_SELF'];?>">
    <input type="text" placeholder="name" name="name"><br>
    <input type="text" placeholder="email" name="email"><br>
    <input type="text" placeholder="comment" name="comment"><br>
    <input type=submit value="Submit" name="submit">
</form>
<h1 style="text-align: center">De scheld woorden zijn |shit|fuck|kanker|flikker|tering|homo|hoer|bitch !</h1>
</body>
</html>
<?php
//check if submitted name exists
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $dbh->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->bindParam(':name',$name);
    $name = $_POST['name'];
    $stmt->execute();

    $pattern = '|shit|fuck|kanker|flikker|tering|homo|hoer|bitch';
    if ($_POST['name'] == '' || $_POST['email'] == '' || $_POST['comment'] == '') {

        $message = 'niet alles is ingevuld';
    } elseif ($stmt->rowCount() > 0) {
        $message = $name . 'Bestaat al';
    } elseif (preg_match('(/'. $pattern .'/i)',strtolower($_POST['name']))  ||
        preg_match('(/'. $pattern .'/i)',strtolower($_POST['email'])) || preg_match('(/'. $pattern .'/i)',strtolower($_POST['comment']))){

        $name = '****';
        $message = $name . 'is een scheld woord';


    }else{
          $stmt = $dbh->prepare("INSERT INTO users (name,email,comment) VALUES (:name,:email,:comment)");
          $stmt->bindParam(":name", $name);
          $stmt->bindParam(":email", $email);
          $stmt->bindParam(":comment", $comment);
            $message = "Thank you";
      // insert one row
          $name = $_POST["name"];
          $email = $_POST["email"];
          $comment = $_POST["comment"];

        $name = strtolower($_POST['name']);
        $email = strtolower($_POST['email']);
        $comment = strtolower($_POST['comment']);
          $stmt->execute();
    }

    echo $message;
  }
        $stmt = $dbh->prepare("SELECT * FROM users");
        $stmt->execute();

        while ($row = $stmt->fetch()) {

            echo $row['name']  ;
            echo $row['email'] ;
            echo $row['comment'] ;

        }


        $sth = null;
        $dbh = null;


?>

