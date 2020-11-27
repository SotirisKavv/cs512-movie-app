<?php 
    class Cinema {

        private $conn;

        private $db_table = "cinemas";

        public $id;
        public $name;
        public $ownerId;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getCinemas() {
            $sql = "SELECT * FROM " . $this->db_table . ";";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt;
        }

        public function getOwnersCinemas() {
            $sql = "SELECT * FROM " . $this->db_table . 
                    " WHERE owner_id= ? ;"; 

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->ownerId);

            $stmt->execute();

            return $stmt;
        }

        public function createCinema() {
            $sql = "INSERT INTO 
                   ". $this->db_table ."
                    SET
                    name = :name,
                    owner_id = :owner_id ;
                   ";
            
            $stmt = $this->conn->prepare($sql);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->ownerId=htmlspecialchars(strip_tags($this->ownerId));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":owner_id", $this->ownerId);

            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function getCinemaById() {
            $sql = "SELECT * FROM " . $this->db_table . " 
                    WHERE id = ? LIMIT 0,1;";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            
            $this->id = $dataRow['id'];
            $this->name = $dataRow['name'];
            $this->ownerId = $dataRow['owner_id'];
        }
        
        public function updateCinema() {
            $sql = "UPDATE 
                   ". $this->db_table ."
                    SET
                    name = :name,
                    owner_id = :owner_id
                    WHERE
                    id = :id
                    ";
            
            $stmt = $this->conn->prepare($sql);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->ownerId=htmlspecialchars(strip_tags($this->ownerId));
            $this->id=htmlspecialchars(strip_tags($this->id));
            
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":owner_id", $this->ownerId);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function deleteCinema() {
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