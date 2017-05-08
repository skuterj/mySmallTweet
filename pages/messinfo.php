<?php
require('../classes/conection.php');
require('../classes/users.php');
require('../classes/tweets.php');
require('../classes/comments.php');
require('../classes/messages.php');


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['messId']) === true) {
        $messId = $_GET['messId'];
    } else {
        $messId = false;
    }
    if (isset($_GET['from']) === true) {
        $from = $_GET['from'];
    } else {
        $from = false;
    }
    if (isset($_GET['to']) === true) {
        $to = $_GET['to'];
    } else {
        $to = false;
    }

}

if ($messId && ($from || $to) && isset($_COOKIE['id'])) {


    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$db;charset=UTF8",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );


        $message = Message::loadMessageById($conn, $messId);


    } catch
    (PDOException $e) {

        echo $e->getMessage();
    }


    $writtenDate = $message->getWrittenDate();
    $messText = $message->getMessText();


    $message->setReadUnread(10);
    $message->saveToDB($conn);

    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
        $user = User::loadUserById($conn, $id);
        $username = $user->getUsername();
        If ($from) {
            $info = 'Autor: ' . $from . ', odbiorca: ' . $username;
        } else {
            $info = 'Odbiorca: ' . $to . ', autor: ' . $username;
        }


        echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Message Info</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>';
        echo '<a href="main.php">Main</a><br/>';
        echo '<br>';
        echo '<a href="account.php" ></a><a href="account.php" >User account</a>';
        echo '<br>';

        echo '<br>';
        echo '<table>';
        echo '<tr>';
        echo '<td colspan="2" class="one">Tekst wiadomości:</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="2" class="two">' . $messText . '</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td class="three">' . $info . '</td>';
        echo '<td class="four">' . $writtenDate . '</td>';
        echo '</tr>';
        echo '</table>';


    } else {
        echo 'konieczne powtóne logowanie!!!';
    }
}