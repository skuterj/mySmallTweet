<?php
//dane do polaczenia
require('conection.php');

Class Comment
{
    private $id;
    private $userId;
    private $tweetId;
    private $creation_date;
    private $text;

    public function __construct()
    {
        $this->id = -1;
        $this->userId = "";
        $this->tweetId = "";
        $this->creation_date = "";
        $this->text = "";
    }

    //SETTERY
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function setCreationDate($creation_date)
    {
        $this->creation_date = $creation_date;
    }

    public function setText($text)
    {
        $this->text = $text;
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

    public function getTweetId()
    {
        return $this->tweetId;
    }

    public function getCreationDate()
    {
        return $this->creation_date;
    }

    public function getText()
    {
        return $this->text;
    }

    //METODY
    //zapisywanie obiektu do bazy
    public function saveToDB($conn)
    {
        //obiekt zapisywany jest do bazy tylko jeżeli jego id jest równe -1 (nowy komentarz)
        if ($this->id == -1) {
            //Saving new comment to DB
            $sql = "INSERT INTO comments (userId, tweetId, creation_date, text) VALUES (:userId, :tweetId, :creation_date, :text)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['userId' => $this->userId, 'tweetId' => $this->tweetId, 'creation_date' => $this->creation_date, 'text' => $this->text]
            );
            if ($result !== false) {
                //Jeżeli udało się nam zapisać obiekt do bazy to przypisujemy mu klucz główny jako id
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {
            $sql = "UPDATE comments SET userId=:userId, tweetId=:tweetId, creation_date=:creation_date, text:text WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['userId' => $this->userId, 'tweetId' => $this->tweetId, 'creation_date' => $this->creation_date, 'text' => $this->text, 'id' => $this->id]
            );
            if ($result === true) {
                return true;
            }
        }
        return false;
    }

    static public function loadAllCommentsByTweetId($conn, $tweetId)
    {
        $sql = "SELECT * FROM comments WHERE tweetId=:tweetId ORDER BY creation_date DESC";
        $ret = [];
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['tweetId' => $tweetId]);
        if ($result === true && $stmt->rowCount() > 0) {
            $rowResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rowResult as $row) {
                $loadedComment = new Comment();
                $loadedComment->id = $row['id'];
                $loadedComment->userId = $row['userId'];
                $loadedComment->tweetId = $row['tweetId'];
                $loadedComment->creation_date = $row['creation_date'];
                $loadedComment->text = $row['text'];
                $ret[] = $loadedComment;
            }

            return $ret;


        }
    }

    static public function loadCommentById($conn, $id)
    {
        $sql = "SELECT * FROM comments WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedComment = new Comment();
            $loadedComment->id = $row['id'];
            $loadedComment->userId = $row['userId'];
            $loadedComment->tweetId = $row['tweetId'];
            $loadedComment->creation_date = $row['creation_date'];
            $loadedComment->text = $row['text'];
            return $loadedComment;
        }
        return null;
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



/* testy na wpisywanie comments

$test = new Comment();
$date = new DateTime();
$timeEntry = date_format($date, 'Y-m-d H:i:s');
$test->setUserId('2');
$test->setText('komentarz 2 do tweeta 6');
$test->setCreationDate($timeEntry);
$test->setTweetId('6');
$test->saveToDB($conn);


//testy na wyswietlanie komentarzy po tweetId
$tweetId = 6;
echo '<pre>';
print_r (Comment::loadAllCommentsByTweetId($conn, $tweetId));
echo '</pre>';
*/

/*
$id = 13;
echo '<pre>';
print_r (Comment::loadCommentById($conn, $id));
echo '</pre>';
*/


