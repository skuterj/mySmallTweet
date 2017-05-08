<?php
require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');
require('../classes/messages.php');

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


    $messOut = Message::loadAllMessagesByAuthorId($conn, $id);
    $messIn = Message::loadAllMessagesByReceiverId($conn, $id);
    $users = User::loadAllUsers($conn);


} catch
(PDOException $e) {

    echo $e->getMessage();
}


echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Messages</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>';
echo '<a href="main.php">Main</a><br/>';
echo '<br>';
echo '<a href="account.php" ></a><a href="account.php" >User account</a>';
echo '<br>';

echo '<h2>Skrzynka odbiorcza</h2>';


if ($messIn) {
    foreach ($messIn as $row) {
        $messOutId = $row->getId();
        $authorId = $row->getAuthorId();
        $writtenDate = $row->getWrittenDate();

        if (strlen($messText = substr($row->getMessText(), 0, 30)) > 29) {
            $messText = substr($row->getMessText(), 0, 30) . '... (ciąg dalszy wiadomości po otwarciu linku)';
        } else {
            $messText = substr($row->getMessText(), 0, 30);
        }


        $readUnread = $row->getReadUnread();
        if ($readUnread > 0) {
            $status = 'przeczytana';
        } else {
            $status = 'NOWA';
        }

        foreach ($users as $count) {
            $id = $count->getId();
            if ($authorId == $id) {
                $authorName = $count->getUsername();

                echo '<br>';
                echo '<table>';
                echo '<tr>';
                echo '<td colspan="2" class="one"><a href=messinfo.php?' . "messId=$messOutId&from=$authorName>Idź do wiadomości ($status)</a></td>";
                //echo '<td colspan="2" class="one">Idź do wiadomości (' . $status . ')</a></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="2" class="two">' . $messText . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="three">Od: ' . $authorName . '</td>';
                echo '<td class="four">' . $writtenDate . '</td>';
                echo '</tr>';
                echo '</table>';

            }
        }
    }
} else {
    echo '<br>';
    echo '<div class="echo">w skrzynce odbiorczej nie ma żadnych wiadomości</div>';
    echo '<br>';
}
echo '<h2>Skrzynka nadawcza</h2>';


if ($messOut) {
    foreach ($messOut as $row) {
        $messInId = $row->getId();
        $receiverId = $row->getReceiverId();
        $writtenDate = $row->getWrittenDate();

        if (strlen($messText = substr($row->getMessText(), 0, 30)) > 29) {
            $messText = substr($row->getMessText(), 0, 30) . '...(ciąg dalszy wiadomości po otwarciu linku)';
        } else {
            $messText = substr($row->getMessText(), 0, 30);
        }

        $readUnread = $row->getReadUnread();
        if ($readUnread > 0) {
            $status = 'przeczytana';
        } else {
            $status = 'NOWA';
        }


        foreach ($users as $count) {
            $id = $count->getId();
            if ($receiverId == $id) {
                $authorName = $count->getUsername();

                echo '<br>';
                echo '<table>';
                echo '<tr>';
                echo '<td colspan="2" class="one"><a href=messinfo.php?' . "messId=$messInId&to=$authorName>Idź do wiadomości ($status)</a></td>";
                //echo '<td colspan="2" class="one">Idź do wiadomości (' . $status . ')</a></td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td colspan="2" class="two">' . $messText . '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td class="three">Do: ' . $authorName . '</td>';
                echo '<td class="four">' . $writtenDate . '</td>';
                echo '</tr>';
                echo '</table>';

            }
        }
    }
} else {
    echo '<br>';
    echo '<div class="echo">w skrzynce nadawczej nie ma żadnych wiadomości</div>';
    echo '<br>';
}


echo '</div>
</body>
</html>';


