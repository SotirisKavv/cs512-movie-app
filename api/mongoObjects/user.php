<?php
    class User {

        private $conn;

        private $db_name = "moviedb";
        private $collection = "users";


        public function __construct($db) {
            $this->conn = $db;
        }

        public function getUsers() {

          $filter = [];
          $option = [];
          $read = new MongoDB\Driver\Query($filter, $option);

          $result = $this->conn->executeQuery("$db_name.$collection", $read);

          return $result;
        }

        public function createUser($data) {
          //data is in array format
          //no more data manipulation is required
          $mongo = new MongoDB\Driver\BulkWrite();
          $mongo->insert($data);
          $result = $this->conn->executeBulkWrite("$db_name.$collection", $mongo);

          return $result;

        }

        public function updateUser($id) {
          //data is in json format, so no more data manipulation is required
          $update = new MongoDB\Driver\BulkWrite();
          $update->update(
	           ['_id' => new MongoDB\BSON\ObjectId($id)],
             ['$set' => $set_values],
             ['multi' => false, 'upsert' => false]
          );
          $result = $conn->executeBulkWrite("$dbname.$collection", $update);

          return $result;

        }

        public function getUserByUsrname() {
            $sql = "SELECT * FROM " . $this->db_table . "
                    WHERE username = ? LIMIT 0,1;";


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

        // public function updateUser() {
        //     $sql = "UPDATE
        //            ". $this->db_table ."
        //             SET
        //             name = :name,
        //             surname = :surname,
        //             username = :username,
        //             password = :password,
        //             email = :email,
        //             role = :role,
        //             confirmed = :confirmed
        //             WHERE
        //             id = :id
        //             ";
        //
        //     $stmt = $this->conn->prepare($sql);
        //
        //     $this->name=htmlspecialchars(strip_tags($this->name));
        //     $this->surname=htmlspecialchars(strip_tags($this->surname));
        //     $this->username=htmlspecialchars(strip_tags($this->username));
        //     $this->password=htmlspecialchars(strip_tags($this->password));
        //     $this->email=htmlspecialchars(strip_tags($this->email));
        //     $this->role=htmlspecialchars(strip_tags($this->role));
        //     $this->confirmed=htmlspecialchars(strip_tags($this->confirmed));
        //     $this->id=htmlspecialchars(strip_tags($this->id));
        //
        //     $stmt->bindParam(":name", $this->name);
        //     $stmt->bindParam(":surname", $this->surname);
        //     $stmt->bindParam(":username", $this->username);
        //     $stmt->bindParam(":password", $this->password);
        //     $stmt->bindParam(":email", $this->email);
        //     $stmt->bindParam(":role", $this->role);
        //     $stmt->bindParam(":confirmed", $this->confirmed);
        //     $stmt->bindParam(":id", $this->id);
        //
        //     if($stmt->execute()){
        //         return true;
        //      }
        //      return false;
        // }
        //
        // public function deleteUser() {
        //     $sql = "DELETE FROM " . $this->db_table . " WHERE id = ?";
        //     $stmt = $this->conn->prepare($sql);
        //
        //     $this->id=htmlspecialchars(strip_tags($this->id));
        //
        //     $stmt->bindParam(1, $this->id);
        //
        //     if($stmt->execute()){
        //         return true;
        //     }
        //     return false;
        // }
    }

?>
