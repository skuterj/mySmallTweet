<?php
//dane do polaczenia
require('conection.php');


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
    //zapisywanie uzytkownika do bazy
    public function saveToDB($conn)
    {
        //obiekt zapisywany jest do bazy tylko jeżeli jego id jest równe -1 (nowy uzytkownik)
        if ($this->id == -1) {
            //Saving new user to DB
            $sql = "INSERT INTO users(email, username, hash_pass) VALUES (:email, :username, :pass)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['email' => $this->email, 'username' => $this->username, 'pass' => $this->hashPass]
            );
            if ($result !== false) {
                //Jeżeli udało się nam zapisać obiekt do bazy to przypisujemy mu klucz główny jako id
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $sql = "UPDATE users SET username=:username, email=:email, hash_pass=:hash_pass WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['username' => $this->username, 'email' => $this->email, 'hash_pass' => $this->hashPass, 'id' => $this->id]
            );
            if ($result === true) {
                return true;
            }
        }
        return false;
    }

    //pobieranie danych uzytkownika z bazy po id
    static public function loadUserById($conn, $id)
    {
        $sql = "SELECT * FROM users WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    //pobieranie danych uzytkownika z bazy po email
    static public function loadUserByEmail($conn, $email)
    {
        $sql = "SELECT * FROM users WHERE email=:email";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['email' => $email]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }

    static public function loadUserByUsername($conn, $username)
    {
        $sql = "SELECT * FROM users WHERE username=:username";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['username' => $username]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->username = $row['username'];
            $loadedUser->hashPass = $row['hash_pass'];
            $loadedUser->email = $row['email'];
            return $loadedUser;
        }
        return null;
    }


    //pobieranie wszystkich danych z tablicy users
    static public function loadAllUsers($conn)
    {
        $sql = "SELECT * FROM users";
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->hashPass = $row['hash_pass'];
                $loadedUser->email = $row['email'];
                $ret[] = $loadedUser;
            }
        }
        return $ret;
    }

    //usuwanie usera z bazy danych
    public function delete($conn)
    {
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(['id' => $this->id]);
            if ($result === true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
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
//testowanie metody saveToDB:

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

//testy juz bez echa kazdej z wprowadzanych danych
$test1 = new User();
$test1->setUsername('monika');
$test1->setEmail('monika.nowak@gmail.com');
$test1->setHashPass('smerfetka');
$test1->saveToDB($conn);



$test2 = new User();
$test2->setUsername('józio');
$test2->setEmail('józio@geofizyka.com');
$test2->setHashPass('neutron');
$test2->saveToDB($conn);

*/

/*

//testowanie metody loadUserById:

$test2 = new User();
$id = 1;
$check = $test2->loadUserById($conn, $id);
var_dump($check);

echo $check->getId();
echo '<br>';
echo $check->getUsername();
echo '<br>';
echo $check->getHashPass();
echo '<br>';
echo $check->getEmail();
echo '<br>';


$id = '1';
$email = 'monika.nowak@gmail.com';


echo '<pre>';
print_r(User::loadUserById($conn, $id));
echo '</pre>';



echo '<pre>';
print_r(User::loadUserByEmail($conn, $email));
echo '</pre>';


/*

// pobieranie wszystkich danych z bazy users

$test3 = new User();
$check = $test3->loadAllUsers($conn);
for ($i = 0; $i < count($check); $i++){
    echo '<br>';
    echo $check[$i]->getId();
    echo '<br>';
    echo $check[$i]->getUsername();
    echo '<br>';
    echo $check[$i]->getEmail();
    echo '<br>';
    echo $check[$i]->getHashPass();
    echo '<br>';
}

*/

/*
//testowanie modyfikacji danych

$test = new User();
$id = 3;
$check = $test->loadUserById($conn, $id);
echo $check->getId();
echo '<br>';
echo $check->getUsername();
echo '<br>';
echo $check->getHashPass();
echo '<br>';
echo $check->getEmail();
echo '<br>';
echo $check->setUsername('ada_zmieniona');
echo $check->setHashPass('dzidzia-zmieniona');
echo $check->setEmail('ada.zmieniona@upcpoczta.pl');
$check->saveToDB($conn);
$check = $test->loadUserById($conn, $id);
echo $check->getId();
echo '<br>';
echo $check->getUsername();
echo '<br>';
echo $check->getHashPass();
echo '<br>';
echo $check->getEmail();
echo '<br>';

*/

/*
//testowanie wywalenia usera z bazy

$test2 = new User();
$id = 3;
$check = $test2->loadUserById($conn, $id);

echo $check->getId();
echo '<br>';
echo $check->getUsername();
echo '<br>';
echo $check->getHashPass();
echo '<br>';
echo $check->getEmail();
echo '<br>';

$check->delete($conn);

$check->loadUserById($conn, $id);
echo $check->getId();
echo '<br>';
echo $check->getUsername();
echo '<br>';
echo $check->getHashPass();
echo '<br>';
echo $check->getEmail();
echo '<br>';
*/

$conn = null;
