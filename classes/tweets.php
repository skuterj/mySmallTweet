<?php
//dane do polaczenia
require('conection.php');


class Tweet
{

    private $id;
    private $userId;
    private $text;
    private $creationDate;


    public function __construct()
    {
        $this->id = -1;
        $this->userId = "";
        $this->text = "";
        $this->creationDate = "";
    }

    //SETTERY

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setText($text)
    {
        $this->text = $text;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    //GETTERY

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    //METODY
    static public function loadTweetById($conn, $id)
    {
        $sql = "SELECT * FROM tweets WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row['id'];
            $loadedTweet->userId = $row['userId'];
            $loadedTweet->text = $row['text'];
            $loadedTweet->creationDate = $row['creationDate'];
            return $loadedTweet;
        }
        return null;
    }

    static public function loadAllTweetsByUserId($conn, $userId)
    {
        $sql = "SELECT * FROM tweets WHERE userId=:userId ORDER BY id DESC";
        $ret = [];
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['userId' => $userId]);
        if ($result === true && $stmt->rowCount() > 0) {
            $rowResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rowResult as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
            }

            return $ret;


        }
    }


    static public function loadAllTweets($conn)
    {
        $sql = "SELECT * FROM tweets ORDER BY id DESC";
        $ret = [];
        $result = $conn->query($sql);
        if ($result !== false && $result->rowCount() != 0) {
            foreach ($result as $row) {
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                $ret[] = $loadedTweet;
            }
        }
        return $ret;
    }

    public function saveToDB($conn)
    {
        //obiekt zapisywany jest do bazy tylko jeżeli jego id jest równe -1 (nowy wpis)
        if ($this->id == -1) {
            //Saving new tweet to DB
            $sql = "INSERT INTO tweets (userId, text, creationDate) VALUES (:userId, :text, :creationDate)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['userId' => $this->userId, 'text' => $this->text, 'creationDate' => $this->creationDate]
            );
            if ($result !== false) {
                //Jeżeli udało się nam zapisać obiekt do bazy to przypisujemy mu klucz główny jako id
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $sql = "UPDATE tweets SET userId=:userId, text=:text, creationDate=:creationDate WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['userId' => $this->userId, 'text' => $this->text, 'creationDate' => $this->creationDate, 'id' => $this->id]
            );
            if ($result === true) {
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
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );


} catch (PDOException $e) {
    echo $e->getMessage();
}

/*
* testy na wpisywanie tweetów

$test = new Tweet();
$test->setUserId('1');
$test->setText('koniec testów');
$test->setCreationDate('2017-04-22');
$test->saveToDB($conn);


testy na wyswietlanie tweeta po id
$id = 22;
echo '<pre>';
print_r (Tweet::loadTweetById($conn, $id));
echo '</pre>';
*/


/*
//testy na wyswietlanie wszystkich tweetów

echo '<pre>';
print_r (Tweet::loadAllTweets($conn));
echo '</pre>';
*/


/*
$user = 1;
echo '<pre>';
print_r (Tweet::loadAllTweetsByUserId($conn,$user));
echo '</pre>';
*/


$conn = null;