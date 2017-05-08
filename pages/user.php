<?php

require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];


    if ($_SERVER['REQUEST_METHOD'] === 'GET') {


        if (isset($_GET['authorId']) === true && isset($_GET['authorName']) === true) {
            $authorId = $_GET['authorId'];
            $authorName = $_GET['authorName'];


            try {
                $conn = new PDO(
                    "mysql:host=$host;dbname=$db;charset=UTF8",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );

                $tweets = Tweet::loadAllTweetsByUserId($conn, $authorId);


            } catch (PDOException $e) {

                echo $e->getMessage();
            }


        }
    }
}

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User</title>
    <link rel="stylesheet" href="css/main.css">';
echo '</head>
<body>
<div>';
echo '<br>';
echo "<button onclick=window.location.href=\"newmessage.php?authorId=$authorId\">Napisz do autora tweetów: $authorName</button><br />";
echo '<br>';

//echo "Posty użytkownika: <span>$authorName</span><br>";

foreach ($tweets as $row) {
    $tweetId = $row->getId();
    $text = $row->getText();
    $creationDate = $row->getcreationDate();
    $comment = Comment::loadAllCommentsByTweetId($conn, $tweetId);
    $noTweet = count($comment);
    // $comment = Comment::loadAllCommentsByTweetId($conn, $tweetId)
    echo '<br>';
    echo '<table>';
    echo '<tr>';
    echo '<td colspan="2" class="one"><a href=tweet.php?' . "tweetId=$tweetId&authorName=$authorName&authorId=$authorId>Idź do Tweet'a</a></td>";
    echo '</tr>';
    echo '<tr>';
    echo '<td colspan="2" class="two">' . $text . '</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td class="three">' . "Komentarzy: $noTweet</td>";
    echo '<td class="four">' . $creationDate . '</td>';
    echo '</table>';
    echo '</tr>';


}


echo '
</div>
</body>
</html>'

?>

