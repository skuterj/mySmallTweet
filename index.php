<?php
require('classes/conection.php');
require('classes/users.php');

$email = " ";
$id = " ";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['email']) === true && isset($_POST['password']) === true) {
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
            if ($check) {
                $email = $check->getEmail();
                $password = $check->getHashPass();
                $id = $check->getId();

               setcookie('id', $id, time() + 3600 * 24);


                if (password_verify($passwordIN, $password)) {
                    header("Location: pages/main.php?id=$id");
                } else {
                    echo '<div class="echo">Hasło niezgodne z zapisanym w bazie danych!!!</div>';
                    echo '<br>';
                }
            } else {
                echo '<div class="echo">Zły adres mailowy!!!</div>';
            }

        }

catch
    (PDOException $e) {

        echo $e->getMessage();

    }


    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="pages/css/main.css">
</head>
<body>
<div>
    <h2>MySmallTweet - strona logowania</h2>
<form action="index.php" method="POST">
    Email:<br/>
    <input type="text" name="email" size="50px" value=<?php echo $email; ?>><br/><br/>
    Password: <br/>
    <input type="text" size="50px" name="password"/><br/><br/>
    <input type="submit" size="50px" value="Login"/><br/><br/>
    <a href="pages/register.php">Strona rejestracji</a>
</form>
</div>
</body>
</html>












