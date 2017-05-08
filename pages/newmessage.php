<?php
require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');
require('../classes/messages.php');

session_start();


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['authorId'])) {
        $authorId = $_GET['authorId'];
        $_SESSION['authorId'] = $authorId;

    } else {
        echo '<div class="echo">konieczne przelogowanie!!!</div>';
    }

}

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];

} else {
    echo '<div class="echo">konieczne przelogowanie!!!</div>';
}

$authorId = $_SESSION['authorId'];


if ($id == $authorId) {
    echo '<div class="echo">Wysyłanie wiadomości do siebie jest zabronione!</div>';
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['text']) === true) {


            $text = trim($_POST['text']);
            $date = new DateTime();
            $timeEntry = date_format($date, 'Y-m-d H:i:s');
            if (empty($text)) {
                echo '<div class="echo">proszę wpisać treść wiadomości!</div>';
                //zabezpieczenie przed wysylaniem pustych wiadomości
                echo '<br>';
            } else {
                $newMessage = new Message();
                $newMessage->setAuthorId($id);
                $newMessage->setReceiverId($authorId);
                $newMessage->setWrittenDate($timeEntry);
                $newMessage->setMessText($text);

                $newMessage->saveToDB($conn);
                //header("Location: clearNewMessage.php");
                //zabezpieczenie przed odswiezaniem strony i powtornym wysylaniem tego samego tweeta
            }


            //else z redirectem do strony logowania - brak cookie
        }
    }

}


echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Message</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>


<a href="main.php">Main</a><br/>

<form action="newmessage.php" method="POST">
    <textarea name="text" rows="20" cols="72" maxlength="1800"
              placeholder="Wpisz wiadomość (max 1800 znaków)"></textarea><br/>
    <input type="submit" value="Wyślij wiadomość"/><br/>
</form>
</div>
</body>
</html>';