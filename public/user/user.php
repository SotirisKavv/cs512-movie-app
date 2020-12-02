<?php
    class User {

        private $conn;

        private $db_table = "users";

        public $id;
        public $name;
        public $surname;
        public $username;
        public $password;
        public $email;
        public $role;
        public $confirmed;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getUsers() {
            $sql = "SELECT * FROM " . $this->db_table. ";";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return  $stmt;
        }

        public function createUser() {
            $sql = "INSERT INTO
                   ". $this->db_table ."
                    SET
                    name = :name,
                    surname = :surname,
                    username = :username,
                    password = :password,
                    email = :email,
                    role = :role,
                    confirmed = :confirmed
                   ";

            // echo $sql;

            $stmt = $this->conn->prepare($sql);
            // 
            // echo print_r($this);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->role=htmlspecialchars(strip_tags($this->role));
            $this->confirmed=htmlspecialchars(strip_tags($this->confirmed));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":confirmed", $this->confirmed);

            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function getUserByUsrname() {
            $sql = "SELECT * FROM " . $this->db_table . "
                    WHERE username = ? LIMIT 0,1;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->username);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->surname = $dataRow['surname'];
            $this->username = $dataRow['username'];
            $this->password = $dataRow['password'];
            $this->email = $dataRow['email'];
            $this->role = $dataRow['role'];
            $this->confirmed = $dataRow['confirmed'];
        }

        public function getUserById() {
            $sql = "SELECT * FROM " . $this->db_table . "
                    WHERE id = ? LIMIT 0,1;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->surname = $dataRow['surname'];
            $this->username = $dataRow['username'];
            $this->password = $dataRow['password'];
            $this->email = $dataRow['email'];
            $this->role = $dataRow['role'];
            $this->confirmed = $dataRow['confirmed'];
        }

        public function updateUser() {
            $sql = "UPDATE
                   ". $this->db_table ."
                    SET
                    name = :name,
                    surname = :surname,
                    username = :username,
                    password = :password,
                    email = :email,
                    role = :role,
                    confirmed = :confirmed
                    WHERE
                    id = :id
                    ";

            $stmt = $this->conn->prepare($sql);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->surname=htmlspecialchars(strip_tags($this->surname));
            $this->username=htmlspecialchars(strip_tags($this->username));
            $this->password=htmlspecialchars(strip_tags($this->password));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->role=htmlspecialchars(strip_tags($this->role));
            $this->confirmed=htmlspecialchars(strip_tags($this->confirmed));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":surname", $this->surname);
            $stmt->bindParam(":username", $this->username);
            $stmt->bindParam(":password", $this->password);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":role", $this->role);
            $stmt->bindParam(":confirmed", $this->confirmed);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function deleteUser() {
            $sql = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sql);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if($stmt->execute()){
                return true;
            }
            return false;
        }
    }

?>
