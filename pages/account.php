<?php
require('../classes/conection.php');
require('../classes/users.php');

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['username']) === true && isset($_POST['email']) === true && isset($_POST['password']) === true) {
            $usernameIN = $_POST['username'];
            $emailIN = $_POST['email'];
            $passwordIN = $_POST['password'];
        }
    }


    try {
        $conn = new PDO(
            "mysql:host=$host;dbname=$db;charset=UTF8",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
        $user = User::loadUserById($conn, $id);
        $username = $user->getUsername();
        $email = $user->getEmail();
        $hashPass = $user->getHashPass();

        if (isset($usernameIN) && isset($emailIN) && isset($passwordIN)) {
            $check = User::loadUserByEmail($conn, $emailIN);
            if (!$check) {
                $user->setUsername($usernameIN);
                $user->setEmail($emailIN);
                $user->setHashPass($passwordIN);
                $user->saveToDB($conn);
            } else {
                echo '<div class="echo">Podany email jest już zapisany w bazie danych! Podaj inny lub pozostaw poprzedni!</div>)';
            }
        }

    } catch (PDOException $e) {

        echo $e->getMessage();

    }

} else {
    echo '<div class="echo">Edycja danych użytkownika wymaga ponownego zalogowania!</div>';
}


?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>
<form action="account.php" method="POST">
    <h3>Edycja danych użytkownika<br /></h3>
    Username (zmień/zostaw):<br/>
    <input type="text" name="username" size="50px" value=<?php echo $username; ?>><br/><br />
    Email (zmień/zostaw):<br/>
    <input type="text" name="email" size="50px" value=<?php echo $email; ?>><br/><br />
    Password (podaj nowe/stare): <br/>
    <input type="text" name="password" size="50px"><br/><br />
    <input type="submit" value="Confirm/change"/><br/><br />
    <a href="main.php">Main</a><br/>
    <a href="messbox.php">Messages</a><br/>

</div>
</body>
</html>

