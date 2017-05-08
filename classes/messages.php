<?php
//dane do polaczenia
require('conection.php');


class Message
{
    private $id;
    private $authorId;
    private $receiverId;
    private $written_date;
    private $mess_text;
    private $read_unread;


    public function __construct()
    {
        $this->id = -1;
        $this->authorId = "";
        $this->receiverId = "";
        $this->written_date = "";
        $this->mess_text = "";
        $this->read_unread = false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function getWrittenDate()
    {
        return $this->written_date;
    }

    public function getMessText()
    {
        return $this->mess_text;
    }

    public function getReadUnread()
    {
        return $this->read_unread;
    }


    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }

    public function setWrittenDate($written_date)
    {
        $this->written_date = $written_date;
    }

    public function setMessText($mess_text)
    {
        $this->mess_text = $mess_text;
    }

    public function setReadUnread($read_unread)
    {
        $this->read_unread = $read_unread;
    }


    public function saveToDB($conn)
    {
        if ($this->id == -1) {
            //Saving new user to DB
            $sql = "INSERT INTO messages(authorId, receiverId, written_date, mess_text, read_unread) VALUES (:authorId, :receiverId, :written_date, :mess_text, :read_unread)";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['authorId' => $this->authorId, 'receiverId' => $this->receiverId, 'written_date' => $this->written_date, 'mess_text' => $this->mess_text, 'read_unread' => $this->read_unread]
            );
            if ($result !== false) {
                //Jeżeli udało się nam zapisać obiekt do bazy to przypisujemy mu klucz główny jako id
                $this->id = $conn->lastInsertId();
                return true;
            }
        } else {

            $sql = "UPDATE messages SET authorId=:authorId, receiverId=:receiverId, written_date=:written_date, mess_text=:mess_text, read_unread=:read_unread WHERE id=:id";
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute(
                ['authorId' => $this->authorId, 'receiverId' => $this->receiverId, 'written_date' => $this->written_date, 'mess_text' => $this->mess_text, 'read_unread' => $this->read_unread, 'id' => $this->id]
            );
            if ($result === true) {
                return true;
            }
        }
        return false;
    }

    static public function loadMessageById($conn, $id)
    {
        $sql = "SELECT * FROM messages WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        if ($result === true && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $loadedMessage = new Message();
            $loadedMessage->id = $row['id'];
            $loadedMessage->authorId = $row['authorId'];
            $loadedMessage->receiverId = $row['receiverId'];
            $loadedMessage->written_date = $row['written_date'];
            $loadedMessage->mess_text = $row['mess_text'];
            $loadedMessage->read_unread = $row['read_unread'];

            return $loadedMessage;
        }
        return null;
    }

    static public function loadAllMessagesByAuthorId($conn, $authorId)
    {
        $sql = "SELECT * FROM messages WHERE authorId=:authorId ORDER BY written_date DESC";
        $ret = [];
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['authorId' => $authorId]);
        if ($result === true && $stmt->rowCount() > 0) {
            $rowResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rowResult as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->authorId = $row['authorId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->written_date = $row['written_date'];
                $loadedMessage->mess_text = $row['mess_text'];
                $loadedMessage->read_unread = $row['read_unread'];
                $ret[] = $loadedMessage;
            }

            return $ret;


        }
    }

    static public function loadAllMessagesByReceiverId($conn, $receiverId)
    {
        $sql = "SELECT * FROM messages WHERE receiverId=:receiverId ORDER BY written_date DESC";
        $ret = [];
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute(['receiverId' => $receiverId]);
        if ($result === true && $stmt->rowCount() > 0) {
            $rowResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($rowResult as $row) {
                $loadedMessage = new Message();
                $loadedMessage->id = $row['id'];
                $loadedMessage->authorId = $row['authorId'];
                $loadedMessage->receiverId = $row['receiverId'];
                $loadedMessage->written_date = $row['written_date'];
                $loadedMessage->mess_text = $row['mess_text'];
                $loadedMessage->read_unread = $row['read_unread'];
                $ret[] = $loadedMessage;
            }

            return $ret;


        }
    }


}