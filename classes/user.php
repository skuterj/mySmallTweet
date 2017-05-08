<?php
//plik z definicjami klas potrzebnymi do projektu
//dane do polaczenia
require('../conection.php');


class User
{
    private $id;
    private $username;
    private $hashPass;
    private $email;

    public function __construct()
    {
        $this->id = -1;
        $this->username = "";
        $this->hashPass = "";
        $this->email = "";
    }

    //SETTERY

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setHashPass($newPass)
    {
        $newHashedPassword =
            password_hash($newPass, PASSWORD_BCRYPT);
        $this->hashPass = $newHashedPassword;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    //GETTERY

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getHashPass()
    {
        return $this->hashPass;
    }

    public function getEmail()
    {
        return $this->email;
    }

    //METODY
    public function saveToDB($conn)
    {
        //obiekt zapisywany jest do bazy tylko jeżeli jego id jest równe -1 (nowy uzytkownik)
        if ($this->id == -1) {
        //Saving new user to DB
            $sql = "INSERT INTO users(email, username, hash_pass) VALUES (:email, :username, :pass)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                [ 'email'=> $this->email, 'username' => $this->username, 'pass' => $this->hashPass ]
            );
            if ($result !== false) {
                //Jeżeli udało się nam zapisać obiekt do bazy to przypisujemy mu klucz główny jako id
                $this->id = $conn->lastInsertId();
                return true;
            }
        }
        return false;
    }


}

//zmienna $conn do testowania metod


try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=UTF8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );


} catch (PDOException $e) {
    echo $e->getMessage();
}



/*
testowanie metody saveToDB:

$test = new User();
$test->setUsername('jerzy');
$test->setEmail('jerzy@interia.pl');
$test->setHashPass('smok');

echo $test->getId();
echo '<br>';
echo $test->getUsername();
echo '<br>';
echo $test->getEmail();
echo '<br>';
echo $test->getHashPass();
echo '<br>';

$test->saveToDB($conn);


$test1 = new User();
$test1->setUsername('monika');
$test1->setEmail('monika.nowak@gmail.com');
$test1->setHashPass('smerfetka');
$test1->saveToDB($conn);

$test2 = new User();
$test2->setUsername('ada');
$test2->setEmail('ada@upcpoczta.pl');
$test2->setHashPass('dzidzia');
$test2->saveToDB($conn);

*/

$conn = null;
