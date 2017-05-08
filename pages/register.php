<?php
//strona rejestracji
require('../classes/conection.php');
require('../classes/users.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['username']) === true && isset($_POST['email']) === true && isset($_POST['password']) === true) {
        $usernameIN = trim($_POST['username']);
        $emailIN = trim($_POST['email']);
        $passwordIN = trim($_POST['password']);


        try {
            $conn = new PDO(
                "mysql:host=$host;dbname=$db;charset=UTF8",
                $user,
                $pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );

            $check = User::loadUserByEmail($conn, $emailIN);
            if (!$check) {
                $newUser = new User ();
                $newUser->setUsername($usernameIN);
                $newUser->setEmail($emailIN);
                $newUser->setHashPass($passwordIN);
                $newUser->saveToDB($conn);

                $check_id = User::loadUserByEmail($conn, $emailIN);
                $id = $check_id->getId();

                setcookie('id', $id, time() + 3600 * 24);

                header('location: main.php');
            } else {
                echo('<div class="echo">Podany email jest już zapisany w bazie danych! Podaj inny lub zaloguj się na stronie logowania!</div>');
            }

        } catch (PDOException $e) {

            echo $e->getMessage();

        }
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div>
    <form action="register.php" method="POST">
        <h3>Rejestracja nowego użytkownika</h3>
        Username:<br/>
        <input type="text" size="50px" name="username"><br/><br/>
        Email:<br/>
        <input type="text" size="50px" name="email"><br/><br/>
        Password: <br/>
        <input type="text" size="50px" name="password"><br/><br/>
        <input type="submit" value="Register"/><br/><br/>
        <a href="../index.php">Strona logowania</a>

    </form>
</div>
</body>
</html>


