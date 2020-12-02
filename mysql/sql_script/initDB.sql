CREATE DATABASE IF NOT EXISTS moviedb;
USE moviedb;

CREATE TABLE IF NOT EXISTS users (
   id INT NOT NULL auto_increment,
   name VARCHAR(255),
   surname VARCHAR(255),
   username VARCHAR(255),
   password VARCHAR(255),
   email VARCHAR(255),
   role ENUM('ADMIN', 'CINEMAOWNER', 'USER'),
   confirmed BOOLEAN,
   PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS cinemas (
   id INT NOT NULL auto_increment,
   owner_id INT NOT NULL,
   name VARCHAR(255),
   PRIMARY KEY (id),
   FOREIGN KEY (owner_id) REFERENCES users (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS movies (
  id INT NOT NULL auto_increment,
  title VARCHAR(255),
  release_year INT,
  poster_link varchar(255),
  start_date DATE,
  end_date DATE,
  cinema_id INT NOT NULL,
  category VARCHAR(255),
  PRIMARY KEY (id),
  FOREIGN KEY (cinema_id) REFERENCES cinemas (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS favourites (
  user_id INT NOT NULL,
  movie_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
  FOREIGN KEY (movie_id) REFERENCES movies (id) ON DELETE CASCADE
);
