<?php
session_start();


require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');


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

        if (isset($_GET['tweetId']) && isset($_GET['authorName']) && isset($_GET['authorId'])) {

            $tweetId = $_GET['tweetId'];
            $authorName = $_GET['authorName'];
            $authorId = $_GET['authorId'];

            $_SESSION['tweetId'] = $tweetId;
            $_SESSION['authorName'] = $authorName;
            $_SESSION['authorId'] = $authorId;

        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['text']) === true) {


            $text = trim($_POST['text']);
            $date = new DateTime();
            $timeEntry = date_format($date, 'Y-m-d H:i:s');
            if (isset($_COOKIE['id'])) {
                $id = $_COOKIE['id'];

                if (empty($text)) {
                    echo '<div class="echo"> Proszę wpisać treść komentarza!</div>';
                    //zabezpieczenie przed wysylaniem pustych tweetow
                    echo '<br>';
                } else {
                    $newComment = new Comment();
                    $newComment->setUserId($id);
                    $tweetId = $_SESSION['tweetId'];
                    $newComment->setTweetId($tweetId);
                    $newComment->setCreationDate($timeEntry);
                    $newComment->setText($text);


                    $newComment->saveToDB($conn);
                    header("Location: clearTweet.php");
                    //zabezpieczenie przed odswiezaniem strony i powtornym wysylaniem tego samego tweeta
                }


            } else {
                echo '<div class="echo">konieczne przelogowanie!!!</div>';
                //else z redirectem do strony logowania - brak cookie
            }
        }
    }

    $tweetId = $_SESSION['tweetId'];
    $authorId = $_SESSION['authorId'];
    $authorName = $_SESSION['authorName'];

    $comments = Comment::loadAllCommentsByTweetId($conn, $tweetId);
    $tweet = Tweet::loadTweetById($conn, $tweetId);
    $users = User::loadAllUsers($conn);


} catch (PDOException $e) {

    echo $e->getMessage();
}


echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tweet</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>


<a href="main.php">Main</a><br/>';

$tweetText = $tweet->getText();
$creationDate = $tweet->getCreationDate();


echo '<br>';
echo '<table>';
echo '<tr>';
echo '<td colspan="2" class="one">Tweet</a></td>';
echo '</tr>';
echo '<tr>';
echo '<td colspan="2" class="two">' . $tweetText . '</td>';
echo '</tr>';
echo '<tr>';
echo '<td class="three">' . '<a href=user.php?' . "tweetId=$tweetId&authorName=$authorName&authorId=$authorId>$authorName</a></td>";
echo '<td class="four">' . $creationDate . '</td>';
echo '</tr>';
echo '</table>';
echo '<br>';


echo '<form action="tweet.php" method="POST">
    <textarea name="text" rows="2" cols="72" maxlength="60"
              placeholder="Wpisz swój komentarz (max 60 znaków)"></textarea><br/>
    <input type="submit" value="Dodaj komentarz"/><br/>
</form>';


echo '<br>';
echo "Komentarze do Tweet'a:";
if ($comments) {
    foreach ($comments as $row) {
        $text = $row->getText();
        $creation_date = $row->getCreationDate();
        $userId = $row->getUserId();
        foreach ($users as $count) {
            $id = $count->getId();
            if ($userId == $id) {
                $userName = $count->getUsername();


                echo '<br>';
                echo '<table>';
                echo '<tr>';
                echo '<td colspan="2" class="two">' . $text . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="three"><a href=user.php?' . "authorName=$userName&tweetId=$tweetId&authorId=$userId>$userName</a></td>";
                echo '<td class="four">' . $creation_date . '</td>';
                echo '</tr>';
                echo '</table>';

            }
        }
    }
} else {
    echo '<br>';
    echo 'napisz pierwszy komentarz do tego Tweeta ;-) !';
}

?>
</div>
</body>
</html>
