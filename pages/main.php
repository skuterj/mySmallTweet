<?php
require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');


$id = $_COOKIE['id'];


try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=UTF8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['id']) === true) {
            $id = $_GET['id'];
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['text']) === true) {
            $text = trim($_POST['text']);
            $entryDate = date('Y-m-d');

            if (isset($_COOKIE['id'])) {
                $id = $_COOKIE['id'];



                if (empty($text)) {
                    echo '<div class="echo">Proszę wpisać treść Tweeta!</div>';
                    //zabezpieczenie przed wysylaniem pustych tweetow
                    echo '<br>';
                } else {
                    $newTweet = new Tweet;
                    $newTweet->setUserId($id);
                    $newTweet->setText($text);
                    $newTweet->setCreationDate($entryDate);

                    $newTweet->saveToDB($conn);
                    header("Location: clearMain.php");
                    //zabezpieczenie przed odswiezaniem strony i powtornym wysylaniem tego samego tweeta
                }


            }
        }
    }


    $tweets = Tweet::loadAllTweets($conn);
    $users = User::loadAllUsers($conn);


} catch
(PDOException $e) {

    echo $e->getMessage();
}





echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Main</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>';

echo '<a href="account.php" ></a><a href="account.php" >User account</a>';
echo '<br/>';
echo '<br/>';

echo '
<form action="main.php" method="POST">
    <textarea name="text" rows="2" cols="72" maxlength="140"
              placeholder="Wpisz swojego Tweeta (do 140 znaków)"></textarea><br/>
    <input type="submit" value="Dodaj tweeta"/><br/>
</form>';



foreach ($tweets as $row) {
    $tweetId = $row->getId();
    $text = $row->getText();
    $creationDate = $row->getcreationDate();
    $userId = $row->getUserId();
    foreach ($users as $count) {
        $id = $count->getId();
        if ($userId == $id) {
            $userName = $count->getUsername();

            echo '<br>';
            echo '<table>';
            echo '<tr>';
            echo '<td colspan="2" class="one"><a href=tweet.php?' . "authorName=$userName&tweetId=$tweetId&authorId=$userId>Idź do Tweet'a</a></td>";
            echo '</tr>';
            echo '<tr>';
            echo '<td colspan="2" class="two">' . $text . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="three"><a href=user.php?' . "authorName=$userName&tweetId=$tweetId&authorId=$userId>$userName</a></td>";
            echo '<td class="four">' . $creationDate . '</td>';
            echo '</tr>';
            echo '</table>';

        }
    }
}




echo '</div>
</body>
</html>';













