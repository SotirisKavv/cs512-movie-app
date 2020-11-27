<?php 
    class Movie {

        private $conn;

        private $db_table = "movies";
        private $db_favourite = "favourites";

        public $id;
        public $title;
        public $releaseYear;
        public $posterLink;
        public $startDate;
        public $endDate;
        public $cinemaId;
        public $cinemaName;
        public $ownerId;
        public $category;
        public $fav;

        public function __construct($db) {
            $this->conn = $db;
        }

        public function getMoviesByCinemaName() {
            $sql = "SELECT DISTINCT 
                ".$this->db_table.".id,
                ".$this->db_table.".title,
                ".$this->db_table.".release_year,
                ".$this->db_table.".poster_link,
                ".$this->db_table.".start_date,
                ".$this->db_table.".end_date,
                cinemas.name as cinema_name,
                ".$this->db_table.".category
                FROM " . $this->db_table .
                " JOIN cinemas ON cinema_id=cinemas.id
                WHERE cinemas.name = ? ;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->cinemaName);
            $stmt->execute();

            return $stmt;
        }

        public function getMoviesByField($searchTerm) {
            $sql = "SELECT DISTINCT
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category
                    FROM " . $this->db_table .
                    " JOIN cinemas ON cinema_id=cinemas.id
                     WHERE category LIKE '%".$searchTerm."%' 
                     OR cinemas.name LIKE '%".$searchTerm."%'
                     OR title LIKE '%".$searchTerm."%';";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }

        public function getTodaysMovies() {
            $sql = "SELECT 
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category
                    FROM " . $this->db_table .
                    " JOIN cinemas ON cinema_id=cinemas.id
                    WHERE start_date<=CURDATE() AND end_date>=CURDATE()";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt;
        }

        public function getMovieOnDate($searchTerm) {
            $sql = "SELECT DISTINCT
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category
                    FROM " . $this->db_table .
                    " JOIN cinemas ON cinema_id=cinemas.id
                    WHERE start_date < ? AND end_date > ? ;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $searchTerm);
            $stmt->bindParam(2, $searchTerm);
            $stmt->execute();

            return $stmt;
        }

        public function getOwnersMovies() {
            $sql = "SELECT DISTINCT
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category
                    FROM ".$this->db_table." 
                    LEFT JOIN cinemas ON ".$this->db_table.".cinema_id=cinemas.id
                    LEFT JOIN users ON cinemas.owner_id=users.id 
                    WHERE cinemas.owner_id= :id ;";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id", $this->ownerId);

            $stmt->execute();

            return $stmt;
        }

        public function createMovie() {
            $sql = "INSERT INTO 
                   ". $this->db_table ."
                    SET
                    title = :title,
                    release_year = :release_year,
                    poster_link = :poster_link,
                    start_date = :start_date,
                    end_date = :end_date,
                    cinema_id = :cinema_id,
                    category = :category
                   ";
            
            $stmt = $this->conn->prepare($sql);

            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->releaseYear=htmlspecialchars(strip_tags($this->releaseYear));
            $this->posterLink=htmlspecialchars(strip_tags($this->posterLink));
            $this->startDate=htmlspecialchars(strip_tags($this->startDate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->cinemaId=htmlspecialchars(strip_tags($this->cinemaId));
            $this->category=htmlspecialchars(strip_tags($this->category));
        
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":release_year", $this->releaseYear);
            $stmt->bindParam(":poster_link", $this->posterLink);
            $stmt->bindParam(":start_date", $this->startDate);
            $stmt->bindParam(":end_date", $this->endDate);
            $stmt->bindParam(":cinema_id", $this->cinemaId);
            $stmt->bindParam(":category", $this->category);

            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function getMovieByTitle() {
            $sql = "SELECT DISTINCT
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category
                    FROM " . $this->db_table .
                    " JOIN cinemas ON cinema_id=cinemas.id
                    WHERE title = ? LIMIT 0,1;";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->title);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $dataRow['id'];
            $this->title = $dataRow['title'];
            $this->releaseYear = $dataRow['release_year'];
            $this->posterLink = $dataRow['poster_link'];
            $this->startDate = $dataRow['start_date'];
            $this->endDate = $dataRow['end_date'];
            $this->cinemaName = $dataRow['cinema_name'];
            $this->category = $dataRow['category'];
        }

        public function getMovieById() {
            $sql = "SELECT DISTINCT 
            ".$this->db_table.".id,
            ".$this->db_table.".title,
            ".$this->db_table.".release_year,
            ".$this->db_table.".poster_link,
            ".$this->db_table.".start_date,
            ".$this->db_table.".end_date,
            cinemas.name AS cinema_name,
            ".$this->db_table.".category,
            CASE
                WHEN ".$this->db_favourite.".movie_id IS NULL THEN 1
                ELSE 0
            END AS fav
            FROM ".$this->db_table." JOIN cinemas ON cinema_id=cinemas.id
            LEFT OUTER JOIN ". $this->db_favourite ."
            ON ".$this->db_table.".id = 
               ".$this->db_favourite.".movie_id
            WHERE ".$this->db_table.".id = ?
            LIMIT 0,1;";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $dataRow['id'];
            $this->title = $dataRow['title'];
            $this->releaseYear = $dataRow['release_year'];
            $this->posterLink = $dataRow['poster_link'];
            $this->startDate = $dataRow['start_date'];
            $this->endDate = $dataRow['end_date'];
            $this->cinemaName = $dataRow['cinema_name'];
            $this->category = $dataRow['category'];
            $this->fav = $dataRow['fav']>0;
        }
        
        public function updateMovie() {
            $sql = "UPDATE 
                   ". $this->db_table ."
                    SET
                    title = :title,
                    release_year = :release_year,
                    poster_link = :poster_link,
                    start_date = :start_date,
                    end_date = :end_date,
                    cinema_id = :cinema_id,
                    category = :category
                    WHERE 
                    id = :id
                   ";
            
            $stmt = $this->conn->prepare($sql);

            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->releaseYear=htmlspecialchars(strip_tags($this->releaseYear));
            $this->posterLink=htmlspecialchars(strip_tags($this->posterLink));
            $this->startDate=htmlspecialchars(strip_tags($this->startDate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->cinemaId=htmlspecialchars(strip_tags($this->cinemaId));
            $this->category=htmlspecialchars(strip_tags($this->category));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":release_year", $this->releaseYear);
            $stmt->bindParam(":poster_link", $this->posterLink);
            $stmt->bindParam(":start_date", $this->startDate);
            $stmt->bindParam(":end_date", $this->endDate);
            $stmt->bindParam(":cinema_id", $this->cinemaId);
            $stmt->bindParam(":category", $this->category);
            $stmt->bindParam(":id", $this->id);

            if($stmt->execute()){
                return true;
             }
             return false;
        }

        public function deleteMovie() {
            $sql = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function addFavourite($userId) {
            $sql = "INSERT INTO ". $this->db_favourite .
                   " SET 
                    user_id = :user_id,
                    movie_id = :movie_id;
                   ";

            $stmt = $this->conn->prepare($sql);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":user_id", $userId);
            $stmt->bindParam(":movie_id", $this->id);

            if($stmt->execute()) {
                return true;
            }
            return false;
        }

        public function deleteFavourite($userId) {
            $sql = "DELETE FROM " . $this->db_favourite . "
                    WHERE movie_id = ? AND user_id = ?;";
            $stmt = $this->conn->prepare($sql);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $userId=htmlspecialchars(strip_tags($userId));
        
            $stmt->bindParam(1, $this->id);
            $stmt->bindParam(2, $userId);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getUsersFavourites($userId) {
            $sql = "SELECT DISTINCT 
                    ".$this->db_table.".id,
                    ".$this->db_table.".title,
                    ".$this->db_table.".release_year,
                    ".$this->db_table.".poster_link,
                    ".$this->db_table.".start_date,
                    ".$this->db_table.".end_date,
                    cinemas.name as cinema_name,
                    ".$this->db_table.".category,
                    COALESCE(".$this->db_favourite.".movie_id) AS fav
                    FROM ".$this->db_table." JOIN cinemas ON cinemas.id=cinema_id 
                    LEFT OUTER JOIN ". $this->db_favourite ."
                    ON ".$this->db_table.".id = 
                       ".$this->db_favourite.".movie_id
                    WHERE ".$this->db_favourite.".user_id = :user_id
                    ";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id", $userId);

            $stmt->execute();
            return $stmt;
        }
    }

?>