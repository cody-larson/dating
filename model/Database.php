<?php

/*

CREATE TABLE member (
member_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
fname VARCHAR(50),
lname VARCHAR(50),
age INT(3),
gender VARCHAR(10),
phone VARCHAR(15),
email VARCHAR(256),
state VARCHAR(50),
seeking VARCHAR(10),
bio TEXT,
premium tinyint(1),
image VARCHAR(256)
);

CREATE TABLE interest (
interest_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
interest VARCHAR(256),
type VARCHAR(50)
);

CREATE TABLE member_interest (
member_id INT NOT NULL,
interest_id INT NOT NULL,
FOREIGN KEY(member_id) references member(member_id),
FOREIGN KEY(interest_id) references interest(interest_id)
);

*/

//Connect to the database
require '/home/clarsong/config.php';

class Database
{
    public function connect()
    {
        //Connect to DB
        try{ //Instantiate a database object
            $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo'Connected to database!';
            return $dbh;
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function createIndoorInterests() {
        $dbh = $this->connect();
        $sql = "SELECT interest_id, interest FROM interest WHERE type='indoor'";
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $interests = $statement->fetchAll();
        return $interests;
    }

    public function createOutdoorInterests() {
        $dbh = $this->connect();
        $sql = "SELECT interest_id, interest FROM interest WHERE type='outdoor'";
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $interests = $statement->fetchAll();
        return $interests;
    }

    public function getInterest($id) {
        $dbh = $this->connect();
        $sql = "SELECT interest FROM interest WHERE interest_id=:id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $interest = $statement->fetch();
        return $interest;
    }

    public function insertMember($first, $last, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image)
    {
        $dbh = $this->connect();
        $sql = "INSERT INTO member (fname, lname, age, gender, phone, email, state, seeking, bio, premium, image) VALUES (:first, :last, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image)";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':first', $first, PDO::PARAM_STR);
        $statement->bindParam(':last', $last, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_INT);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_INT);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->execute();
        $memid = $dbh->lastInsertId();
        return $memid;
    }

    public function insertInterests($memid, $intid) {
        $dbh = $this->connect();
        $sql = "INSERT INTO member_interest (member_id, interest_id) VALUES (:memid, :intid) ";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':memid', $memid, PDO::PARAM_INT);
        $statement->bindParam(':intid', $intid, PDO::PARAM_INT);
        $statement->execute();
    }


    public function getMembers()
    {
        $dbh = $this->connect();
        $sql = "SELECT * FROM member ORDER BY lname";
        $statement = $dbh->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getMember($id)
    {
        $dbh = $this->connect();
        $sql = "SELECT * FROM member WHERE member_id = :id";
        $statement = $dbh->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}